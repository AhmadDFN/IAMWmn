<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JurusanController extends Controller
{
    protected $index = 'jurusan.index';
    protected $route = 'jurusan.';
    protected $view = 'admin.jurusan.';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            "title" => "Jurusan",
            'page' => 'Data Jurusan Wearnes Madiun',
            "jurusans" => Jurusan::All(),
            'add' => $this->route . "create",
            'index' => $this->route,
        ];
        return view($this->view . "data", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            "title" => "Jurusan",
            'page' => 'Form Data Jurusan',
            'save' => $this->route . "store",
            'index' => $this->route,
            // 'is_update' => false,
        ];

        return view($this->view . "form", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Jurusan::create($request->all());
        return redirect()->route($this->index);
    }

    /**
     * Display the specified resource.
     */
    public function show(Jurusan $jurusan)
    {
        $data = [
            "title" => jurusan::find($jurusan->jurusan_nm),
            'page' => "Profil Jurusan " . jurusan::find($jurusan->jurusan_nm),
            'jurusan' => jurusan::find($jurusan->id),
        ];

        return view($this->view . "single", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurusan $jurusan)
    {
        $data = [
            "title" => "Jurusan",
            'page' => 'Form Data Jurusan',
            'jurusan' => $jurusan,
            'save' => $this->route . "update",
            'index' => $this->route,
            'is_update' => true,
        ];
        return view($this->view . "form", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        $jurusan->fill($request->all());
        $jurusan->save();
        return redirect()->route($this->index);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->route($this->index);
    }
}
