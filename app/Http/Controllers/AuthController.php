<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login()
    {
        // Jika sudah login akan langsung ke Dashboard
        if (Auth::check()) {
            return redirect("/dashboard");
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
            return redirect('/dashboard'); // Dashboard
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
                // User::create([
                //     "name" => $hasil[0]->mhs_nm,
                //     "reff" => $hasil[0]->mhs_NIM,
                //     "email" => $hasil[0]->mhs_email,
                //     "password" => Hash::make($hasil[0]->mhs_tanggal_lahir),
                //     "role" => "Mahasiswa",
                //     "status" => 0,
                //     "remember_token" => Str::random(10),
                //     "created_at" => date("Y-m-d h:i:s"),
                //     "updated_at" => date("Y-m-d h:i:s")
                // ]);
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

            return redirect()->route('home')->with($mess);
        } else {
            // Jika hasil tidak ditemukan, lempar exception
            $mess = [
                "type" => "danger",
                "text" => "NIM Belum Terdaftar !"
            ];
        }


        return redirect("auth/login")->with($mess);
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
