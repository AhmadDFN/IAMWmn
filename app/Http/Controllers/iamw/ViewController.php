<?php

namespace App\Http\Controllers\iamw;

use DateTime;
use App\Models\Jurusan;
use App\Helpers\getDateNow;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    protected $view = 'iamw.';
    protected $route = '/iamw/';
    public function index()
    {
        $tempat = asset('img/iamw/bg_1.jpg');
        // dd($tempat);
        $routes = (object)[
            'index' => $this->route,
            'add' => $this->route . 'create',
        ];
        $lokers = DB::table('lokers')
            ->join('perusahaans', 'lokers.loker_id_perusahaan', '=', 'perusahaans.id')
            ->join('jenis_lokers', 'lokers.loker_id_jnsloker', '=', 'jenis_lokers.id')
            ->select('lokers.*', 'perusahaans.perusahaan_nm', 'jenis_lokers.jenis_loker_nm')
            ->orderBy('lokers.id', 'desc')
            // ->limit('5')
            ->get();
        foreach ($lokers as $key => $loker) {
            $lokers[$key]->jurusans = Jurusan::whereIn('jurusan_kd', explode(',', $lokers[$key]->loker_kd_jurusan))->get();
        }
        $datenow  = new DateTime(getDateNow::getDateNow());
        foreach ($lokers as $key => $loker) {
            $dateend = new DateTime($lokers[$key]->loker_exp);
            $lokers[$key]->loker_exp_new = $dateend;
        }
        switch (@Auth::user()->role) {
            case "SuperAdmin":
                $dashboard = "admin";
                break;
            case "Admin":
                $dashboard = "admin";
                break;
            case "Perusahaan":
                $dashboard = "perusahaan";
                break;
            case "Mahasiswa":
                $dashboard = "home";
                break;
            default:
                $dashboard = "home";
                break;
        }

        $data = (object)[
            "title" => "IAMW",
            'page' => 'IAMW',
        ];
        // dd($lokers);
        $title = $data->title;
        return view($this->view . 'index', compact('lokers', 'routes', 'data', 'title', 'datenow', 'dashboard'));
    }
}
