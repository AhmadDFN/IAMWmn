<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $view = 'dashboard.';
    protected $route = '/dashboard/';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = (object)[
            'index' => $this->route,
            'add' => $this->route . 'create',
        ];
        $users = Mahasiswa::all();
        $data = (object)[
            "title" => "User",
            'page' => 'User Account',
        ];
        $title = $data->title;
        return view($this->view . 'data', compact('users', 'routes', 'data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $routes = (object)[
            'index' => $this->route,
            'save' => $this->route,
            'is_update' => false,
        ];
        $data = (object)[
            "title" => "User",
            'page' => 'User Account',
        ];
        $title = $data->title;
        return view($this->view . 'form', compact('routes', 'data', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        mahasiswa::create($request->all());
        return redirect($this->route);
    }

    /**
     * Display the specified resource.
     */
    public function show(mahasiswa $mahasiswa)
    {
        return view($this->view . 'show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(mahasiswa $mahasiswa)
    {
        $routes = (object)[
            'index' => $this->route,
            'save' => $this->route . $mahasiswa->id,
            'is_update' => true,
        ];
        $data = (object)[
            "title" => "User",
            'page' => 'User Account',
        ];
        $title = $data->title;
        return view($this->view . 'form', compact('user', 'routes', 'data', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, mahasiswa $mahasiswa)
    {
        $mahasiswa->fill($request->all());
        $mahasiswa->save();
        return redirect($this->route);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect($this->route);
    }
}
