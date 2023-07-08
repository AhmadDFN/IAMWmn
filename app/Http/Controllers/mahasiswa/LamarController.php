<?php

namespace App\Http\Controllers\mahasiswa;

use App\Helpers\getDateNow;
use Exception;
use App\Models\Lamar;
use App\Models\Loker;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LamarController extends Controller
{
    protected $view = 'mahasiswa.lamar.';
    protected $route = 'home/lamar/';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = (object)[
            'index' => $this->route,
            'add' => $this->route . 'create',
        ];
        $lamars = DB::table('lamars')
            ->join('lokers', 'lamars.lamar_id_loker', '=', 'lokers.id')
            ->join('perusahaans', 'lokers.loker_id_perusahaan', '=', 'perusahaans.id')
            ->select('lamars.*', 'lokers.loker_nm', 'perusahaans.perusahaan_nm')
            ->where('lamar_NIM', Auth::user()->reff)
            ->get();
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
        $loker = Loker::where('id', $lamar->lamar_id_loker)->get()->first();
        $perusahaan = Perusahaan::where('id', $loker->loker_id_perusahaan)->get()->first();
        $mahasiswa = Mahasiswa::where('mhs_NIM', $lamar->lamar_NIM)->get()->first();
        $loker->jurusans = Jurusan::whereIn('jurusan_kd', explode(',', $loker->loker_kd_jurusan))->get();
        $datenow = getDateNow::getDateNow();
        // dd($loker);
        $data = (object)[
            'title' => $lamar->lamar_nm,
            'page' => "Profil lamar " . $lamar->lamar_nm,
        ];
        $title = "Lamar";
        return view($this->view . 'show', compact('lamar', 'data', 'title', 'mahasiswa', 'loker'));
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
}
