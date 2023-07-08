<?php

namespace App\Http\Controllers\mahasiswa;

use App\Models\User;
use App\Models\Loker;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Perusahaan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    protected $route = 'update.mahasiswa';
    protected $view = 'mahasiswa.home';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Auth::user());
        $mahasiswa = Mahasiswa::where('mhs_NIM', Auth::user()->reff)
            ->join('jurusans', 'mahasiswas.mhs_kd_jurusan', '=', 'jurusans.jurusan_kd')
            ->select('mahasiswas.*', 'jurusans.jurusan_nm')
            ->get()
            ->first();
        // dd($mahasiswa);
        $perusahaans = Perusahaan::all();
        $lokerjur = loker::where('loker_kd_jurusan', 'LIKE', '%' . $mahasiswa->mhs_kd_jurusan . "%")->get();
        $lokers = Loker::where('loker_kd_jurusan', 'LIKE', '%' . $mahasiswa->mhs_kd_jurusan . "%")
            ->where('loker_status', '=', 1)
            ->Limit(5)
            ->get();
        foreach ($lokers as $key => $loker) {
            $lokers[$key]->jurusans = Jurusan::whereIn('jurusan_kd', explode(',', $lokers[$key]->loker_kd_jurusan))->get();
        }

        // dd($lokers);

        $lamars = DB::table('lamars')
            ->join('lokers', 'lamars.lamar_id_loker', '=', 'lokers.id')
            ->join('mahasiswas', 'lamars.lamar_NIM', '=', 'mahasiswas.mhs_NIM')
            ->join('perusahaans', 'lokers.loker_id_perusahaan', '=', 'perusahaans.id')
            ->join('jurusans', 'mahasiswas.mhs_kd_jurusan', '=', 'jurusans.jurusan_kd')
            ->select('lamars.*', 'lokers.loker_nm', 'perusahaans.perusahaan_nm', 'jurusans.jurusan_nm', 'mahasiswas.mhs_nm')
            ->where('lamars.lamar_NIM', '=', Auth::user()->reff)
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
        return view($this->view, compact('lokerjur', 'data', 'title', 'mahasiswa', 'perusahaans', 'lokers', 'lokeract', 'mhsact', 'lamars'));
    }

    public function profilku()
    {
        $user = User::find(Auth::id());
        $routes = (object)[
            'save' => $this->route,
        ];
        $data = (object)[
            "title" => "Dashboard",
            'page' => 'Dashboard Account',
        ];
        return view("mahasiswa.profilku", compact('data', 'routes', 'user'));
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());
        if ($request->file("foto")) {
            $fileName = time() . $user->id . "PP-NoAL-" . Str::random(6) . '.' . $request->file("foto")->extension();
            $result = $request->file("foto")->move(public_path('uploads/profile/foto'), $fileName);
            $foto = "uploads/profile/foto/" . $fileName;
        } else {
            $foto = $request->input("old_foto");
        }
        if ($request->input('password') == $request->input('confirmpassword')) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->foto = $foto;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }
            // dd($request);
            $user->save();

            $mess = [
                "type" => "success",
                "text" => "Profil berhasil diperbarui.!"
            ];

            return redirect()->route('edit.mahasiswa')->with($mess);
        }
        $mess = [
            "type" => "danger",
            "text" => "Failed , Profil gagal diperbarui."
        ];

        return redirect()->route('edit.mahasiswa')->with($mess);
    }
}
