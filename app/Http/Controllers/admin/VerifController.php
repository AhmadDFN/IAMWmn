<?php

namespace App\Http\Controllers\admin;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\sendPass;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Mail\VerificationCode;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class VerifController extends Controller
{
    protected $view = 'admin.verif.';
    protected $route = '/verif/';
    function index()
    {
        // Query Data Transaksi
        $mahasiswas =
            // Mahasiswa::orderBy("mhs_status", "asc")->paginate(5);
            DB::table("mahasiswas")
            ->leftjoin('users', 'mahasiswas.mhs_NIM', '=', 'users.reff')
            ->select('mahasiswas.*', 'users.reff', 'users.status')
            ->orderByRaw("
                        CASE
                            WHEN status = 0 THEN 0
                            WHEN status IS NULL THEN 2
                            ELSE 1
                        END, status ASC
                        ")
            ->orderBy("mhs_status", "asc")
            ->orderBy("mhs_th_lulus", "desc")
            ->orderBy("id", "asc")
            ->paginate(10);
        // dd($mahasiswas);
        $routes = (object)[
            'index' => $this->route,
        ];
        $data = (object)[
            "title" => "Verif",
            'page' => 'Daftar User',
        ];
        $title = $data->title;

        return view($this->view . "index", compact('mahasiswas', 'data', 'title', 'routes'));
    }

    function update_status(Mahasiswa $mahasiswa)
    {
        $user = User::where('reff', $mahasiswa->mhs_NIM);

        Mahasiswa::where("id", $mahasiswa->id)->update([
            "mhs_status" => 2
        ]);
        User::where("reff", $mahasiswa->mhs_NIM)->update([
            "status" => 1,
            "email_verified_at" => date("Y-m-d h:i:s"),
        ]);

        return back();
    }

    function email_update(Mahasiswa $mahasiswa, $token)
    {
        $user = User::where('reff', $mahasiswa->mhs_NIM)->get()->first();
        // dd($user);
        if ($user->remember_token == $token) {
            Mahasiswa::where("id", $mahasiswa->id)->update([
                "mhs_status" => 2
            ]);
            User::where("reff", $mahasiswa->mhs_NIM)->update([
                "status" => 1,
                "email_verified_at" => date("Y-m-d h:i:s"),
            ]);
            $single = collect($mahasiswa);
            $single["pass"] = str_replace("-", "", Carbon::createFromFormat('Y-m-d', $mahasiswa->mhs_tanggal_lahir)->locale('id')->isoFormat('DMMYYYY'));
            $single["jurusan"] = Jurusan::where('jurusan_kd', $mahasiswa->mhs_kd_jurusan)->first();
            try {
                Mail::to($mahasiswa->mhs_email)->send(new sendPass($single));
                $mess = "Berhasil Kekirim";
                // dd("Berhasil");
            } catch (Exception $err) {
                $mess = "Gagal Terkirim" . " " . $err;
                // dd($th);
            }
        } else {
            $mess = "Token SALAH!!!";
        }

        return redirect("/")->with('notification', $mess);
    }

    function send_email(Mahasiswa $mahasiswa, $token, $reff)
    {

        $single = collect($mahasiswa);
        $single["token"] = $token;
        $single["reff"] = $reff;
        $single["jurusan"] = Jurusan::where('jurusan_kd', $mahasiswa->mhs_kd_jurusan)->first();
        // $single["pass"] = str_replace("-", "", Carbon::createFromFormat('Y-m-d', $mahasiswa->mhs_tanggal_lahir)->locale('id')->isoFormat('DMMYYYY'));
        // dd([
        //     "mahasiswa" => $mahasiswa,
        //     "single" => $single,
        //     "token" => $token,
        //     "reff" => $reff,
        // ]);

        try {
            Mail::to($mahasiswa->mhs_email)->send(new VerificationCode($single));
            $mess = "Berhasil Kekirim";
            // dd("Berhasil");
        } catch (Exception $err) {
            $mess = "Gagal Terkirim" . " " . $err;
            // dd($th);
        }

        return redirect("/")->with('notification', $mess);
    }

    function test_email(Mahasiswa $mahasiswa)
    {

        $single = collect($mahasiswa);
        try {
            Mail::to($mahasiswa->mhs_email)->send(new sendPass($single));
            $mess = "Berhasil Kekirim";
            // dd("Berhasil");
        } catch (Exception $err) {
            $mess = "Gagal Terkirim" . " " . $err;
            // dd($th);
        }

        return redirect("/")->with('notification', $mess);
    }
}
