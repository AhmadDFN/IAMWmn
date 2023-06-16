<?php

namespace App\Http\Controllers;

use App\Models\Lamar;
use App\Models\Loker;
use App\Models\Mahasiswa;
use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // protected $view = 'layDashboard';
    protected $view = 'dashboard';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $mahasiswas = Mahasiswa::all();
        $perusahaans = Perusahaan::all();
        $lokers = Loker::all();

        $lamaract = Loker::where('loker_status' , 1)->get()->first();

        // $monthInc = DB::select("SELECT SUM(trans_gtotal) AS gtotal FROM transactions WHERE YEAR(trans_tgl) = YEAR(NOW()) AND MONTH(trans_tgl) = MONTH(NOW())");
        // $yearInc = DB::select("SELECT SUM(trans_gtotal) AS gtotal FROM transactions WHERE YEAR(trans_tgl) = YEAR(NOW())");

        $data = (object)[
            "title" => "Dashboard",
            'page' => 'Dashboard Account',
        ];

        $title = $data->title;
        // dd($dash1);
        return view($this->view, compact('data', 'title', 'users' ,'mahasiswas','perusahaans','lokers','lamaract'));
    }
}
