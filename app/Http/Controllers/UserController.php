<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $view = 'user.';
    protected $route = '/user/';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = (object)[
            'index' => $this->route,
            'add' => $this->route . 'create',
        ];
        $users = user::all();
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
        user::create($request->all());
        return redirect($this->route);
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        return view($this->view . 'show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $user)
    {
        $routes = (object)[
            'index' => $this->route,
            'save' => $this->route . $user->id,
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
    public function update(Request $request, user $user)
    {
        $user->fill($request->all());
        $user->save();
        return redirect($this->route);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $user)
    {
        $user->delete();
        return redirect($this->route);
    }
}
