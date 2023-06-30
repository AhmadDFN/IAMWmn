<?php

namespace App\Http\Controllers\mahasiswa;

use Exception;
use App\Models\Lamar;
use App\Models\Loker;
use App\Models\Jurusan;
use App\Models\JenisLoker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JenisLokerController extends Controller
{
    protected $view = 'mahasiswa.jenisloker.';
    protected $route = 'home/jenisloker/';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = (object)[
            'index' => $this->route,
            'add' => $this->route . 'create',
        ];
        $jenislokers = JenisLoker::all();
        $data = (object)[
            "title" => "Jenis Loker",
            'page' => 'Jenis Loker Account',
        ];
        $title = $data->title;
        return view($this->view . 'data', compact('jenislokers', 'routes', 'data', 'title'));
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
            "title" => "Jenis Loker",
            'page' => 'Jenis Loker Account',
        ];
        $title = $data->title;
        return view($this->view . 'form', compact('routes', 'data', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        JenisLoker::create($request->all());
        return redirect($this->route);
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisLoker $jenisloker)
    {
        $data = (object)[
            'title' => $jenisloker->jenisloker_nm,
            'page' => "Profil jenisloker " . $jenisloker->jenisloker_nm,
        ];
        $lokers = Loker::where("loker_id_jnsloker", $jenisloker->id)->get();
        $jurusans  = Jurusan::all();

        foreach ($lokers as $key => $loker) {
            $lokers[$key]->jurusans = Jurusan::whereIn('jurusan_kd', explode(',', $lokers[$key]->loker_kd_jurusan))->get();
        }
        $title = "Jenis Loker";
        return view($this->view . 'show', compact('jenisloker', 'data', 'title', 'lokers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jenisloker $jenisloker)
    {
        $routes = (object)[
            'index' => $this->route,
            'save' => $this->route . $jenisloker->id,
            'is_update' => true,
        ];
        $data = (object)[
            "title" => "Jenis Loker",
            'page' => 'Jenis Loker Account',
        ];
        $title = $data->title;
        return view($this->view . 'form', compact('jenisloker', 'routes', 'data', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, jenisloker $jenisloker)
    {
        $jenisloker->fill($request->all());
        $jenisloker->save();
        return redirect($this->route);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jenisloker $jenisloker)
    {
        $jenisloker->delete();
        return redirect($this->route);
    }
}
