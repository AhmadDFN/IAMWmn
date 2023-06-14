<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
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
        // $monthInc = DB::select("SELECT SUM(trans_gtotal) AS gtotal FROM transactions WHERE YEAR(trans_tgl) = YEAR(NOW()) AND MONTH(trans_tgl) = MONTH(NOW())");
        // $yearInc = DB::select("SELECT SUM(trans_gtotal) AS gtotal FROM transactions WHERE YEAR(trans_tgl) = YEAR(NOW())");

        $data = (object)[
            "title" => "Dashboard",
            'page' => 'Dashboard Account',
        ];

        $title = $data->title;
        // dd($dash1);
        return view($this->view, compact('data', 'title', 'users'));
    }
}
