<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login()
    {
        // Jika sudah login akan langsung ke Dashboard
        if (Auth::check()) {
            return redirect("/");
        }

        return view('auth.login');
    }

    function cek_login(Request $request)
    {
        // Validasi
        $request->validate(
            [
                "email" => "required",
                "password" => "required"
            ],
            [
                "email.required" => "Maaf email harus diisi !",
                "password.required" => "Maaf password harus diisi !"
            ]
        );

        // Cek Login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect('/'); // Dashboard
        }

        // Jika user dan password salah maka Kembali ke form Login
        $mess = [
            "type" => "danger",
            "text" => "Maaf username atau password salah !"
        ];

        return back()->with($mess);
    }

    function registrasi()
    {
        return view("auth.register");
    }

    function save_registrasi(Request $request)
    {
        // Validasi
        // $req->validate(
        //     [
        //         "name" => "required|max:50",
        //         "email" => "required",
        //         "password" => "required|min:8"
        //     ],
        //     [
        //         "name.required" => "Maaf Nama harus diisi !",
        //         "name.max" => "Maaf nama maximal 50 karakter",
        //         "email.required" => "Maaf email harus diisi !",
        //         "password.required" => "Maaf password harus diisi !",
        //         "password.min" => "Password minimal 8 karakter"
        //     ]
        // );

        try {
            // Save
            User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "role" => "Mahasiswa",
                "status" => 1,
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
                "text" => "Registrasi gagal !"
            ];
        }

        return redirect("auth/login")->with($mess);
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('auth/login');
    }
}
