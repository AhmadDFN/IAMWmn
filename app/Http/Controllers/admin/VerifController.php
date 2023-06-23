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
            ->orderBy("mhs_status", "asc")
            ->orderBy("mhs_th_lulus", "desc")
            ->orderBy("id", "asc")
            ->paginate(10);
        // dd($mahasiswas->lastPage());
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

    function update_status(Request $request, Mahasiswa $mahasiswa)
    {
        dd($mahasiswa);
        Mahasiswa::where("id", $request->id)->update([
            "status" => $request->status
        ]);

        return back();
    }
}
