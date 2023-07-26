<?php

namespace App\Http\Controllers\admin;

use App\Models\Lamar;
use App\Models\Loker;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\JenisLoker;
use App\Models\Perusahaan;

class LamarController extends Controller
{
    protected $view = 'admin.lamar.';
    protected $route = '/lamar/';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = (object)[
            'index' => $this->route,
            'add' => $this->route . 'create',
        ];

        $lamars =  DB::table('lokers')
            ->join('perusahaans', 'lokers.loker_id_perusahaan', '=', 'perusahaans.id')
            ->join('jenis_lokers', 'lokers.loker_id_jnsloker', '=', 'jenis_lokers.id')
            ->select(
                'jenis_lokers.jenis_loker_nm',
                'perusahaans.perusahaan_foto',
                'perusahaans.perusahaan_nm',
                'perusahaans.perusahaan_kota',
                'lokers.*',
                DB::raw('(SELECT COUNT(*) FROM lamars WHERE lamars.lamar_id_loker = lokers.id AND (lamars.lamar_status = 0 OR lamars.lamar_status = 5 OR lamars.lamar_status = 6)) AS jumlah_pelamar'),
                DB::raw('(SELECT COUNT(*) FROM lamars WHERE lamars.lamar_id_loker = lokers.id AND lamars.lamar_status = 0) AS jumlah_request')
            )
            ->get();
        // dd($lokers);

        $data = (object)[
            "title" => "Lamar",
            'page' => 'Lamar Admin',
        ];
        // dd($lamars);
        $title = $data->title;
        return view($this->view . 'admin.data', compact('lamars', 'routes', 'data', 'title'));
    }

    function detail_lowongan(Loker $loker)
    {
        $routes = (object)[
            'index' => $this->route,
            'add' => $this->route . 'create',
        ];
        $data = (object)[
            "title" => "Lamar",
            'page' => 'Lamar Admin',
        ];
        $perusahaan = Perusahaan::where('id', $loker->loker_id_perusahaan)->get()->first();
        $title = $data->title;
        $lamars = DB::table("lamars")
            ->join("mahasiswas", "lamars.lamar_NIM", "=", "mahasiswas.mhs_NIM")
            ->join("berkas", "mahasiswas.mhs_NIM", "=", "berkas.berkas_NIM")
            ->join("lokers", "lamars.lamar_id_loker", "=", "lokers.id") // Adding the join with the lokers table
            ->select("lamars.*", "mahasiswas.mhs_nm", "berkas.id as id_berkas", "mahasiswas.id as id_mahasiswa")
            ->where("lamars.lamar_id_loker", $loker->id)
            ->where(function ($query) {
                $query->where("lamars.lamar_status", "=", 0)
                    ->orWhere("lamars.lamar_status", "=", 5)
                    ->orWhere("lamars.lamar_status", "=", 6);
            })
            ->get();

        // dd($lamars);

        $loker->jurusans = Jurusan::whereIn('jurusan_kd', explode(',', $loker->loker_kd_jurusan))->get();

        $loker->jenisloker = JenisLoker::where('id', $loker->loker_id_jnsloker)->get()->first();
        // dd($loker->jenisloker->jenis_loker_nm);
        return view($this->view . 'admin.detail', compact('lamars', 'perusahaan', 'routes', 'data', 'title', 'loker'));
    }

    function detail_lowongan_accept(Loker $loker)
    {
        $lamar = Lamar::where('lamar_id_loker', $loker->id)->where('lamar_status', 0);
        // dd($lamar->count() > 0);
        if ($lamar->count() > 0) {
            if ($lamar) {
                // Update the lamar_status column
                $lamar->update([
                    'lamar_status' => 5,
                ]);
            } else {
                $mess = [
                    "type" => "danger",
                    "text" => "Tidak Ada Lamaran."
                ];
                return back()->with('notification', $mess);
            }
            $mess = [
                "type" => "success",
                "text" => "Status Diupdate."
            ];
            return back()->with('notification', $mess);
        } else {
            $mess = [
                "type" => "danger",
                "text" => "Data Tidak ada yang terupdate."
            ];
            return back()->with('notification', $mess);
        }
    }

    function detail_lowongan_denied(Loker $loker)
    {
        $lamar = Lamar::where('lamar_id_loker', $loker->id)->where('lamar_status', 0);
        // dd($lamar->count() > 0);
        if ($lamar->count() > 0) {
            if ($lamar) {
                // Update the lamar_status column
                $lamar->update([
                    'lamar_status' => 6,
                ]);
            } else {
                $mess = [
                    "type" => "danger",
                    "text" => "Tidak Ada Lamaran."
                ];
                return back()->with('notification', $mess);
            }
            $mess = [
                "type" => "success",
                "text" => "Status Diupdate."
            ];
            return back()->with('notification', $mess);
        } else {
            $mess = [
                "type" => "danger",
                "text" => "Data Tidak ada yang terupdate."
            ];
            return back()->with('notification', $mess);
        }
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
            "title" => "Lamar",
            'page' => 'Lamar Account',
        ];
        $title = $data->title;
        return view($this->view . 'form', compact('routes', 'data', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        lamar::create($request->all());
        $mess = [
            "type" => "success",
            "text" => "Berhasil Dibuat."
        ];
        return redirect($this->route)->with('notification', $mess);
    }

    /**
     * Display the specified resource.
     */
    public function show(lamar $lamar)
    {
        $mahasiswa = Mahasiswa::where('mhs_NIM', $lamar->lamar_NIM)->get()->first();
        $data = (object)[
            'title' => $lamar->lamar_nm,
            'page' => "Profil lamar " . $lamar->lamar_nm,
        ];
        $title = "Lamar";
        return view($this->view . 'show', compact('lamar', 'data', 'title', 'mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lamar $lamar)
    {
        $routes = (object)[
            'index' => $this->route,
            'save' => $this->route . $lamar->id,
            'is_update' => true,
        ];
        $data = (object)[
            "title" => "Lamar",
            'page' => 'Lamar Account',
        ];
        $title = $data->title;
        return view($this->view . 'form', compact('lamar', 'routes', 'data', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, lamar $lamar)
    {
        $lamar->fill($request->all());
        $lamar->save();
        $mess = [
            "type" => "success",
            "text" => "Berhasil Diperbarui."
        ];
        return redirect($this->route)->with('notification', $mess);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(lamar $lamar)
    {
        $lamar->delete();
        $mess = [
            "type" => "success",
            "text" => "Berhasil Dihapus."
        ];
        return redirect($this->route)->with('notification', $mess);
    }

    public function histori()
    {
        $routes = (object)[
            'index' => $this->route,
            'add' => $this->route . 'create',
        ];
        $lamars = DB::table('lamars')
            ->join('lokers', 'lamars.lamar_id_loker', '=', 'lokers.id')
            ->join('mahasiswas', 'lamars.lamar_NIM', '=', 'mahasiswas.mhs_NIM')
            ->join('perusahaans', 'lokers.loker_id_perusahaan', '=', 'perusahaans.id')
            ->join('jurusans', 'mahasiswas.mhs_kd_jurusan', '=', 'jurusans.jurusan_kd')
            ->select('lamars.*', 'lokers.loker_nm', 'perusahaans.perusahaan_nm', 'jurusans.jurusan_nm', 'mahasiswas.mhs_nm')
            ->orderBy('lamars.id', 'desc')
            ->get();
        $data = (object)[
            "title" => "Histori Lamaran",
            'page' => 'Lamar History',
        ];
        // dd($lamars);
        $title = $data->title;
        return view($this->view . 'record', compact('lamars', 'routes', 'data', 'title'));
    }


    function update_status(Lamar $lamar, $lamar_status)
    {
        $request = [
            'lamar_status' => $lamar_status
        ];
        $lamar->fill($request);
        $lamar->save();
        $mess = [
            "type" => "success",
            "text" => "Status Diupdate."
        ];
        return back()->with('notification', $mess);
    }

    function update_all($id_loker, $status)
    {
        // dd(['idloker' => $id_loker, 'status' => $status]);
        Lamar::where('lamar_id_loker', $id_loker)->update(['lamar_status' => $status]);
        $mess = [
            "type" => "success",
            "text" => "Status Diupdate."
        ];
        return back()->with('notification', $mess);
    }

    public function indexPerusahaan()
    {
        $routes = (object)[
            'index' => $this->route,
            'add' => $this->route . 'create',
        ];
        // $lamars =  DB::table('lokers')
        //     ->join('perusahaans', 'lokers.loker_id_perusahaan', '=', 'perusahaans.id')
        //     ->join('lamars', 'lokers.id', '=', 'lamars.lamar_id_loker')
        //     ->select('lokers.*', 'perusahaans.*')
        //     ->get();

        $lamars =  DB::table('lokers')
            ->join('perusahaans', 'lokers.loker_id_perusahaan', '=', 'perusahaans.id')
            ->join('jenis_lokers', 'lokers.loker_id_jnsloker', '=', 'jenis_lokers.id')
            ->select('jenis_lokers.jenis_loker_nm', 'perusahaans.perusahaan_foto', 'perusahaans.perusahaan_nm', 'perusahaans.perusahaan_kota', 'lokers.*', DB::raw('(SELECT COUNT(*) FROM lamars WHERE lamars.lamar_id_loker = lokers.id AND lamars.lamar_status != 0 AND lamars.lamar_status != 6) AS jumlah_pelamar'))
            ->get();
        // dd($lokers);
        // Output the results
        // foreach ($lokers as $loker) {
        //     echo $loker->id . ' - ' . $loker->nama . ' - Jumlah Pelamar: ' . $loker->jumlah_pelamar . '<br>';
        // }
        // dd($lokers);
        // $jurusans  = Jurusan::all();

        // foreach ($lamars as $key => $loker) {
        //     $lamars[$key]->jurusans = Jurusan::whereIn('jurusan_kd', explode(',', $lamars[$key]->loker_kd_jurusan))->get();
        // }
        $data = (object)[
            "title" => "Lamar Perusahaan",
            'page' => 'Lamar Perusahaan',
        ];
        // dd($lamars);
        $title = $data->title;
        return view($this->view . 'perusahaan.data', compact('lamars', 'routes', 'data', 'title'));
    }

    function detail_lowonganPerusahaan(Loker $loker, Request $req)
    {
        $routes = (object)[
            'index' => $this->route,
            'add' => $this->route . 'create',
        ];
        $data = (object)[
            "title" => "Lamar Perusahaan",
            'page' => 'Lamar Perusahaan',
        ];
        $perusahaan = Perusahaan::where('id', $loker->loker_id_perusahaan)->get()->first();
        $title = $data->title;

        if ($req->status) {
            $lamars = DB::table("lamars")
                ->join("mahasiswas", "lamars.lamar_NIM", "=", "mahasiswas.mhs_NIM")
                ->join("berkas", "mahasiswas.mhs_NIM", "=", "berkas.berkas_NIM")
                ->select("lamars.*", "mahasiswas.mhs_nm", "berkas.id as id_berkas", "mahasiswas.id as id_mahasiswa")
                ->where("lamars.lamar_id_loker", $loker->id)
                ->where('lamars.lamar_status', '=', $req->status)
                ->get();
        } else {
            $lamars = DB::table("lamars")
                ->join("mahasiswas", "lamars.lamar_NIM", "=", "mahasiswas.mhs_NIM")
                ->join("berkas", "mahasiswas.mhs_NIM", "=", "berkas.berkas_NIM")
                ->select("lamars.*", "mahasiswas.mhs_nm", "berkas.id as id_berkas", "mahasiswas.id as id_mahasiswa")
                ->where("lamars.lamar_id_loker", $loker->id)
                ->where('lamars.lamar_status', '!=', 0)
                ->where('lamars.lamar_status', '!=', 6)
                ->get();
        }

        // dd($lamars);

        $loker->jurusans = Jurusan::whereIn('jurusan_kd', explode(',', $loker->loker_kd_jurusan))->get();

        $loker->jenisloker = JenisLoker::where('id', $loker->loker_id_jnsloker)->get()->first();
        // dd($loker->jenisloker->jenis_loker_nm);
        return view($this->view . 'perusahaan.detail', compact('lamars', 'perusahaan', 'routes', 'data', 'title', 'loker'));
    }
}
