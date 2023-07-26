<?php

namespace App\Http\Controllers\mahasiswa;

use App\Models\Lamar;
use App\Models\loker;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\JenisLoker;
use App\Models\Perusahaan;
use App\Helpers\getDateNow;
use Illuminate\Http\Request;
use App\Helpers\CodeGenerator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Berkas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LokerController extends Controller
{
    protected $view = 'mahasiswa.loker.';
    protected $route = 'home/loker/';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = (object)[
            'index' => $this->route,
            'add' => $this->route . 'create',
        ];
        $lokers = Loker::all();
        $jurusans  = Jurusan::all();

        foreach ($lokers as $key => $loker) {
            $lokers[$key]->jurusans = Jurusan::whereIn('jurusan_kd', explode(',', $lokers[$key]->loker_kd_jurusan))->get();
        }

        $data = (object)[
            "title" => "Loker",
            'page' => 'Loker Account',
        ];
        $title = $data->title;
        return view($this->view . 'data', compact('lokers', 'jurusans', 'routes', 'data', 'title'));
    }

    public function lokerku()
    {
        $mahasiswa = Mahasiswa::where('mhs_NIM', Auth::user()->reff)->get()->first();
        $routes = (object)[
            'index' => $this->route,
        ];
        $jalan = $mahasiswa;

        $lokers = DB::table('lokers')
            ->leftJoin('lamars', 'lokers.id', '=', 'lamars.lamar_id_loker')
            ->where('lokers.loker_kd_jurusan', 'LIKE', '%' . $mahasiswa->mhs_kd_jurusan . '%')
            ->where(function ($query) use ($mahasiswa) {
                $query->where('lamars.lamar_NIM', $mahasiswa->mhs_NIM)
                    ->orWhereNull('lamars.lamar_NIM')
                    ->orWhere('lamars.lamar_NIM', '');
            })
            ->groupBy('lokers.id', 'lokers.loker_kd', 'lokers.loker_nm', 'lokers.loker_ket', 'lokers.loker_exp', 'lokers.loker_kd_jurusan', 'lokers.loker_status', 'lokers.loker_id_perusahaan', 'lokers.loker_id_jnsloker', 'lokers.created_at', 'lokers.updated_at', 'lamars.lamar_NIM')
            ->select(DB::raw('MAX(lamars.lamar_kd) as lamar_kd'), 'lamars.lamar_NIM', 'lokers.*')
            ->orderBy('lamars.lamar_kd', 'desc')
            ->get();
        // dd($lokers);
        $jurusans  = Jurusan::all();


        foreach ($lokers as $key => $loker) {
            $lokers[$key]->jurusans = Jurusan::whereIn('jurusan_kd', explode(',', $lokers[$key]->loker_kd_jurusan))->get();
        }

        // dd($lokers);
        $data = (object)[
            "title" => "Lokerku",
            'page' => 'Loker Account',
        ];
        $title = $data->title;
        return view($this->view . 'dataku', compact('lokers', 'jurusans', 'routes', 'data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $routes = (object)[
            'index' => $this->route,
            'save' => $this->route,
            // 'is_update' => false,
        ];
        $data = (object)[
            "title" => "Loker",
            'page' => 'Loker Account',
        ];
        $jurusans = Jurusan::all();
        $perusahaans = Perusahaan::all();
        $jenislokers = JenisLoker::all();
        $code = CodeGenerator::generateUniqueCode();
        $title = $data->title;
        return view($this->view . 'form', compact('routes', 'data', 'title', 'code', 'jurusans', 'perusahaans', 'jenislokers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mergedOptions = implode(',', $request->input('loker_kd_jurusan'));

        $requestData = $request->all();
        $requestData["loker_kd_jurusan"] = $mergedOptions;

        $validator = Validator::make($requestData, [
            'loker_kd_jurusan' => 'required|unique:lokers',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // dd($requestData);
        loker::create($requestData);
        $mess = [
            "type" => "success",
            "text" => "Anda Berhasil Membuat Lowongan."
        ];
        return redirect($this->route)->with('notification', $mess);
    }

    /**
     * Display the specified resource.
     */
    public function show(loker $loker)
    {
        $data = (object)[
            'title' => $loker->loker_nm,
            'page' => "Profil loker " . $loker->loker_nm,
            'loker' => loker::find($loker->id),
        ];
        $perusahaan = Perusahaan::where('id', $loker->loker_id_perusahaan)->get()->first();
        $lamars = Lamar::where('lamar_id_loker', $loker->id)->get();
        $mahasiswa = Mahasiswa::where('mhs_NIM', Auth::user()->reff)->get()->first();
        $loker->jurusans = explode(",", $loker->loker_kd_jurusan);
        $result = in_array($mahasiswa->mhs_kd_jurusan, $loker->jurusans);

        $loker->jurusans = Jurusan::whereIn('jurusan_kd', explode(',', $loker->loker_kd_jurusan))->get();


        // dd($loker);

        if ($result) {
            $title = "Lokerku";
        } else {
            $title = "Loker";
        }
        // dd($title);
        return view($this->view . 'show', compact('loker', 'data', 'title', 'perusahaan', 'lamars'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(loker $loker)
    {
        $routes = (object)[
            'index' => $this->route,
            'save' => $this->route . $loker->id,
            'is_update' => true,
        ];
        $data = (object)[
            "title" => "Loker",
            'page' => 'Loker Account',
        ];
        $title = $data->title;
        $jurusans = Jurusan::all();
        $perusahaans = Perusahaan::all();
        $jenislokers = JenisLoker::all();
        return view($this->view . 'form', compact('loker', 'routes', 'data', 'title', 'jurusans', 'perusahaans', 'jenislokers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, loker $loker)
    {
        $loker->fill($request->all());
        $loker->save();
        $mess = [
            "type" => "success",
            "text" => "Anda Berhasil Mengupdate Lowongan."
        ];
        return redirect($this->route)->with('notification', $mess);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(loker $loker)
    {
        // dd($loker);
        $loker->delete();
        DB::table('lamars')->where('lamar_id_loker', '=', $loker->id)->delete();
        $mess = [
            "type" => "success",
            "text" => "Anda Berhasil Menghapus Lowongan."
        ];
        return redirect($this->route)->with('notification', $mess);
    }

    public function lamarkerja(loker $loker)
    {
        $berkas = Berkas::Where('berkas_NIM', Auth::User()->reff)->get()->first();
        $progress = 0;
        if ($berkas->berkas_kk !== null) {
            $progress++;
        }
        if ($berkas->berkas_skck !== null) {
            $progress++;
        }
        if ($berkas->berkas_cv !== null) {
            $progress++;
        }
        if ($berkas->berkas_foto !== null) {
            $progress++;
        }
        if ($berkas->berkas_ijazah !== null) {
            $progress++;
        }
        if ($berkas->berkas_ktp !== null) {
            $progress++;
        }
        $berkas->progress = $progress;
        // dd($berkas);
        if ($berkas->progress == 6) {
            $code = CodeGenerator::generateUniqueCode();
            $requestData = [
                "lamar_kd" => $code,
                'lamar_nm' => $loker->loker_nm,
                'lamar_NIM' => @Auth::user()->reff,
                'lamar_id_loker' => $loker->id,
                "lamar_tgl_daftar" => getDateNow::getDateNow("Y/m/d"),
            ];
            // dd($requestData);
            Lamar::create($requestData);
            $mess = [
                "type" => "success",
                "text" => "Anda Berhasil Melamar."
            ];
            return redirect('home/lokerku/')->with('notification', $mess);
        } else {
            $mess = [
                "type" => "danger",
                "text" => "Maaf, Lengkapi berkas anda dulu."
            ];
            return back()->with('notification', $mess);
        }
    }
}
