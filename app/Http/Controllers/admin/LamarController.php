<?php

namespace App\Http\Controllers\admin;

use App\Models\Lamar;
use App\Models\Loker;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
        // $lamars =  DB::table('lokers')
        //     ->join('perusahaans', 'lokers.loker_id_perusahaan', '=', 'perusahaans.id')
        //     ->join('lamars', 'lokers.id', '=', 'lamars.lamar_id_loker')
        //     ->select('lokers.*', 'perusahaans.*')
        //     ->get();

        $lamars =  DB::table('lokers')
            ->join('perusahaans', 'lokers.loker_id_perusahaan', '=', 'perusahaans.id')
            ->join('jenis_lokers', 'lokers.loker_id_jnsloker', '=', 'jenis_lokers.id')
            ->select('jenis_lokers.jenis_loker_nm', 'perusahaans.perusahaan_foto', 'perusahaans.perusahaan_nm', 'perusahaans.perusahaan_kota', 'lokers.*', DB::raw('(SELECT COUNT(*) FROM lamars WHERE lamars.lamar_id_loker = lokers.id) AS jumlah_pelamar'))
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
            "title" => "Lamar",
            'page' => 'Lamar Account',
        ];
        // dd($lamars);
        $title = $data->title;
        return view($this->view . 'data', compact('lamars', 'routes', 'data', 'title'));
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
        return redirect($this->route);
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
        return redirect($this->route);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(lamar $lamar)
    {
        $lamar->delete();
        return redirect($this->route);
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

    function detail_lowongan(Loker $loker)
    {
        $routes = (object)[
            'index' => $this->route,
            'add' => $this->route . 'create',
        ];
        $data = (object)[
            "title" => "Lamar",
            'page' => 'Lamar',
        ];
        $perusahaan = Perusahaan::where('id', $loker->loker_id_perusahaan)->get()->first();
        $title = $data->title;
        $lamars = DB::table("lamars")
            ->join("mahasiswas", "lamars.lamar_NIM", "=", "mahasiswas.mhs_NIM")
            ->join("berkas", "mahasiswas.mhs_NIM", "=", "berkas.berkas_NIM")
            ->select("lamars.*", "mahasiswas.mhs_nm", "berkas.id as id_berkas", "mahasiswas.id as id_mahasiswa")
            ->where("lamars.lamar_id_loker", $loker->id)
            ->get();
        // dd($data);
        return view($this->view . 'detail', compact('lamars', 'perusahaan', 'routes', 'data', 'title', 'loker'));
    }

    function detail_lowongan2(Loker $loker)
    {
        $data = [
            "rsLowongan" => $loker,
            "dtLamar" => DB::table("lamar")
                ->join("mahasiswas", "lamar.lamar_NIM", "=", "mahasiswas.mhs_NIM")
                ->join("berkas", "mahasiswas.mhs_NIM", "=", "berkas.berkas_NIM")
                ->select("lamar.*", "mahasiswas.name", "berkas.id as id_berkas", "mahasiswas.id as id_mahasiswa")
                ->where("lamar.id_lowongan", $loker->id)
                ->get(),
            "title" => "Lamar",
            "page" => "Lamar",
        ];

        return view("lamar.detail", $data);
    }

    function update_status(Lamar $lamar, Request $request)
    {
        $lamar->fill($request->all());
        $lamar->save();

        return back();
    }
}
