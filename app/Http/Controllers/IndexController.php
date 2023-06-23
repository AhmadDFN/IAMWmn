<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                'view' => 'login',
                'route' => 'login/',
            ],
            'register' => (object)[
                'view' => 'register',
                'route' => 'register/',
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
            'superadmin_home' => (object)[
                'view' => 'superadmin.home',
                'route' => 'superadmin/'
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
    public function index()
    {
        if (Auth::check()) {
            return view($this->routes->user_home->view);
        }
        return view($this->routes->home->view);
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
        $logged = false;

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $logged = true;
        } elseif (Auth::attempt(['nim' => $request->email, 'password' => $request->password])) {
            $logged = true;
        } else {
        }

        if ($logged) {
            $request->session()->regenerate();

            switch (Auth::user()->role) {
                case "SuperAdmin":
                    return redirect()->intended($this->routes->superadmin_home->route);
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
            return back()->with('Gagal', 'NIM / Email dan Password salah.');
        }
    }

    /**
     * Register an account.
     */
    public function showRegister()
    {
        $routes = (object)[
            'register' => '/register',
        ];
        return view($this->routes->register->view, compact('register'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        //
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
