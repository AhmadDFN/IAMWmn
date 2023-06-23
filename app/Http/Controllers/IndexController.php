<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Mahasiswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    protected $routes;
    protected function getRoutes()
    {
        return (object)[
            'home' => (object)[
                'view' => 'home',
                'route' => '/',
            ],
            'login' => (object)[
                'view' => 'auth.login',
                'route' => 'auth/login/',
            ],
            'register' => (object)[
                'view' => 'auth.register',
                'route' => 'auth/register/',
            ],
            'mahasiswa_akun' => (object)[
                'view' => 'akun',
                'route' => 'akun/',
            ],
            'admin_akun' => (object)[
                'view' => 'admin.akun',
                'route' => 'admin/akun/',
            ],
            'superadmin_akun' => (object)[
                'view' => 'superadmin.akun',
                'route' => 'superadmin/akun/',
            ],
            'perusahaan_akun' => (object)[
                'view' => 'perusahaan.akun',
                'route' => 'perusahaan/akun/',
            ],
            'mahasiswa_home' => (object)[
                'view' => 'mahasiswa.home',
                'route' => 'home/',
            ],
            'admin_home' => (object)[
                'view' => 'admin.home',
                'route' => 'admin/'
            ],
            'perusahaan_home' => (object)[
                'view' => 'perusahaan.home',
                'route' => 'perusahaan/'
            ],
            'about' => (object)[
                'view' => 'about',
                'route' => 'about/',
            ],
        ];
    }

    public function __construct()
    {
        $this->routes = $this->getRoutes();
    }

    /**
     * Display a welcome page.
     */
    public function show_login()
    {
        if (Auth::check()) {
            return redirect($this->routes->home->route);
        }
        return view($this->routes->login->view);
    }

    /**
     * Show the form for login an account.
     */
    public function showLogin()
    {
        $routes = (object)[
            'login' => '/login',
        ];
        return view($this->routes->login->view, compact('routes'));
    }

    /**
     * Login to an account.
     */
    public function login(Request $request)
    {
        // dd($request);
        $logged = false;

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $logged = true;
        } elseif (Auth::attempt(['reff' => $request->email, 'password' => $request->password])) {
            $logged = true;
        } else {
            $logged = false;
        }

        if ($logged) {
            $request->session()->regenerate();

            switch (Auth::user()->role) {
                case "SuperAdmin":
                    return redirect()->intended($this->routes->admin_home->route);
                    break;
                case "Admin":
                    return redirect()->intended($this->routes->admin_home->route);
                    break;
                case "Perusahaan":
                    return redirect()->intended($this->routes->perusahaan_home->route);
                    break;
                case "Mahasiswa":
                    return redirect()->intended($this->routes->mahasiswa_home->route);
                    break;
                default:
                    return redirect()->intended($this->routes->home->route);
                    break;
            }
        } else {
            $mess = [
                "type" => "danger",
                "text" => "Maaf username atau password salah !"
            ];

            return back()->with($mess);
        }
    }

    /**
     * Register an account.
     */
    public function show_register()
    {
        // return view("auth.register");
        $routes = (object)[
            'register' => '/register',
        ];
        return view($this->routes->register->view, compact('routes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        $mess = "";
        $hasil = Mahasiswa::where('mhs_email', '=', $request->mhs_email)
            ->where('mhs_NIM', '=', $request->mhs_NIM)
            ->where('mhs_tanggal_lahir', '=', $request->mhs_tanggal_lahir)
            ->where('mhs_status', '=', 1)
            ->get();

        $hasildd = $request;
        // dd($hasil[0]->mhs_nm);
        // dd($hasildd);
        // dd($request->mhs_NIM);

        if ($hasil->count() > 0) {
            try {
                // Save
                DB::table('users')->insert([
                    "name" => $hasil[0]->mhs_nm,
                    "reff" => $hasil[0]->mhs_NIM,
                    "email" => $hasil[0]->mhs_email,
                    "password" => Hash::make($hasil[0]->mhs_tanggal_lahir),
                    "role" => "Mahasiswa",
                    "Status" => 0,
                    "remember_token" => Str::random(10),
                    "created_at" => date("Y-m-d h:i:s"),
                    "updated_at" => date("Y-m-d h:i:s")
                ]);
                $mess = [
                    "type" => "success",
                    "text" => "Registrasi berhasil , silahkan login !"
                ];
            } catch (Exception $err) {
                $mess = [
                    "type" => "danger",
                    "text" => $err . "  -  " . "Registrasi gagal !"
                ];
            }

            return redirect()->route('home')->with($mess);
        } else {
            // Jika hasil tidak ditemukan, lempar exception
            $mess = [
                "type" => "danger",
                "text" => "NIM Belum Terdaftar !"
            ];
        }

        return redirect($this->routes->login->route)->with($mess);
    }

    /**
     * Log out from account logged.
     */
    public function logout()
    {
        Auth::logout();
        return redirect($this->routes->home->route);
    }
}
