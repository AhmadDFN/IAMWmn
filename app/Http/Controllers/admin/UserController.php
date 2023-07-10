<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $view = 'admin.user.';
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
        if (@Auth::user()->role == "SuperAdmin") {
            $users = user::all();
        } else {
            $exceptNames = ['Admin', 'SuperAdmin'];
            $users = DB::table('users')
                ->whereNotIn('role', $exceptNames)
                ->orderBy('role', 'asc')
                ->get();
        }
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
            // 'is_update' => false,
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
        $mahasiswa = "";
        $perusahaan = "";
        $data = (object)[
            'title' => $user->name,
            'page' => "Profil user " . $user->name,
        ];
        $title = "User";

        if ($user->role == "Mahasiswa") {
            $mahasiswa = DB::table('users')
                ->join('mahasiswas', 'users.reff', '=', 'mahasiswas.mhs_NIM')
                ->select('users.*', 'mahasiswas.*')
                ->where('mahasiswas.mhs_nim', '=', $user->reff)
                ->get()->first();
            $mahasiswa->password = null;
            $mahasiswa->remember_token = null;
        }

        if ($user->role == "Perusahaan") {
            $perusahaan = DB::table('users')
                ->select('users.*',  'perusahaans.id as id_perusahaan', 'perusahaans.*')
                ->join('perusahaans', 'users.reff', '=', 'perusahaans.id')
                ->where('perusahaans.id', '=', $user->reff)
                ->get()
                ->first();
            // dd($perusahaan);
            $perusahaan->password = null;
            $perusahaan->remember_token = null;
        }
        // dd($mahasiswa);
        return view($this->view . 'show', compact('user', 'data', 'title', 'mahasiswa', 'perusahaan'));
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
