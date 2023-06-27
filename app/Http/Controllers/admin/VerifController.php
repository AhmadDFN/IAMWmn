<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;

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

        Mahasiswa::where("id", $mahasiswa->id)->update([
            "mhs_status" => 2
        ]);
        User::where("reff", $mahasiswa->mhs_NIM)->update([
            "status" => 1,
            "email_verified_at" => date("Y-m-d h:i:s"),
        ]);

        return back();
    }
}
