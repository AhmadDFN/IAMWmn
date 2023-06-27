<?php

namespace App\Http\Controllers\mahasiswa;

use App\Models\User;
use App\Models\Loker;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    // protected $view = 'layDashboard';
    // protected $view = 'admin.user.';
    protected $route = 'update.mahasiswa';
    protected $view = 'mahasiswa.home';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $mahasiswas = Mahasiswa::all();
        $perusahaans = Perusahaan::all();
        $lokers = DB::table('lokers')
            ->orderBy('lokers.id', 'desc')
            ->limit(5)
            ->get();
        foreach ($lokers as $key => $loker) {
            $lokers[$key]->jurusans = Jurusan::whereIn('jurusan_kd', explode(',', $lokers[$key]->loker_kd_jurusan))->get();
        }
        $lamars = DB::table('lamars')
            ->join('lokers', 'lamars.lamar_id_loker', '=', 'lokers.id')
            ->join('mahasiswas', 'lamars.lamar_NIM', '=', 'mahasiswas.mhs_NIM')
            ->join('perusahaans', 'lokers.loker_id_perusahaan', '=', 'perusahaans.id')
            ->join('jurusans', 'mahasiswas.mhs_kd_jurusan', '=', 'jurusans.jurusan_kd')
            ->select('lamars.*', 'lokers.loker_nm', 'perusahaans.perusahaan_nm', 'jurusans.jurusan_nm', 'mahasiswas.mhs_nm')
            ->orderBy('lamars.id', 'desc')
            ->limit(5)
            ->get();

        // dd($lamars);
        $lokeract = Loker::where('loker_status', 1)->get();
        $mhsact = Mahasiswa::where('mhs_th_masuk', date("Y"))->get();
        // dd($mhsact);
        // $monthInc = DB::select("SELECT SUM(trans_gtotal) AS gtotal FROM transactions WHERE YEAR(trans_tgl) = YEAR(NOW()) AND MONTH(trans_tgl) = MONTH(NOW())");
        // $yearInc = DB::select("SELECT SUM(trans_gtotal) AS gtotal FROM transactions WHERE YEAR(trans_tgl) = YEAR(NOW())");

        $data = (object)[
            "title" => "Dashboard",
            'page' => 'Dashboard Account',
        ];

        $title = $data->title;
        // dd($dash1);
        // dd(Auth::user());
        return view($this->view, compact('data', 'title', 'users', 'mahasiswas', 'perusahaans', 'lokers', 'lokeract', 'mhsact', 'lamars'));
    }

    public function profilku()
    {
        $user = Auth::user();
        $routes = (object)[
            'save' => $this->route,
        ];
        $data = (object)[
            "title" => "Dashboard",
            'page' => 'Dashboard Account',
        ];
        return view("admin.profilku", compact('data', 'routes', 'user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if ($request->input('password') == $request->input('confirmpassword')) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }
            // dd($request);
            // $user->save();

            $mess = [
                "type" => "success",
                "text" => "Profil berhasil diperbarui.!"
            ];

            return redirect()->route('edit.admin')->with($mess);
        }
        $mess = [
            "type" => "danger",
            "text" => "Failed , Profil gagal diperbarui."
        ];

        return redirect()->route('edit.admin')->with($mess);
    }
}
