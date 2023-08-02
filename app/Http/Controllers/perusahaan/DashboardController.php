<?php

namespace App\Http\Controllers\perusahaan;

use App\Models\User;
use App\Models\Loker;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Perusahaan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Lamar;
use Database\Seeders\LamarSeeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    protected $route = 'update.perusahaan';
    protected $view = 'perusahaan.home';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perusahaan = Perusahaan::where('id', Auth::user()->reff)->get()->first();
        $lokers = Loker::where("loker_id_perusahaan", @$perusahaan->id)->get();
        foreach ($lokers as $key => $loker) {
            @$lokers[$key]->pelamar = Lamar::where('lamar_id_loker', @$lokers[$key]->id)
                ->where("lamars.lamar_id_loker", $loker->id)
                ->where('lamars.lamar_status', '!=', 0)
                ->where('lamars.lamar_status', '!=', 6)
                ->get();
            @$lokers[$key]->pelamar->count() > 0 ? @$lokers[$key]->pelamar[0]->mahasiswa = Mahasiswa::where("mhs_NIM", @$lokers[$key]->pelamar[0]->lamar_NIM)->get()->first() : "";
            // @$lokers[$key]->pelamar[0]->mahasiswa = @$lokers[$key]->pelamar->count() == 0 ? NULL : Mahasiswa::where("mhs_NIM", @$lokers[$key]->pelamar[0]->lamar_NIM)->get()->first();
        }
        $jurusans  = Jurusan::all();

        foreach ($lokers as $key => $loker) {
            @$lokers[$key]->jurusans = Jurusan::whereIn('jurusan_kd', explode(',', @$lokers[$key]->loker_kd_jurusan))->get();
        }

        $lamars = DB::table('lokers')
            ->select('lokers.*', DB::raw('COUNT(lamars.id) as jumlah_pelamar'))
            ->leftJoin('lamars', 'lokers.id', '=', 'lamars.lamar_id_loker')
            ->where('lamars.lamar_status', '!=', 0)
            ->where('lamars.lamar_status', '!=', 6)
            ->where('lokers.loker_id_perusahaan', Auth::user()->reff)
            ->groupBy('lokers.loker_id_perusahaan')
            ->get()
            ->first();

        $lamars->lamar = DB::table('lokers')
            ->join('lamars', 'lokers.id', '=', 'lamars.lamar_id_loker')
            ->join('perusahaans', 'lokers.loker_id_perusahaan', '=', 'perusahaans.id')
            ->join('mahasiswas', 'lamars.lamar_NIM', '=', 'mahasiswas.mhs_NIM')
            ->select('lamars.*', 'perusahaans.id as id_perusahaan', 'perusahaans.perusahaan_nm', 'mahasiswas.mhs_nm', 'mahasiswas.mhs_NIM', 'mahasiswas.id as mhs_id')
            ->where('perusahaans.id', '=', $perusahaan->id)
            ->where('lamars.lamar_status', '!=', 0)
            ->where('lamars.lamar_status', '!=', 6)
            ->orderBy('lamars.updated_at', 'asc')
            ->get();

        // dd([
        //     'result' => $lamars,
        //     'lokers' => $lokers,
        //     'lokers pelamar' => @$lokers[1]->pelamar->count(),
        // ]);

        $data = (object)[
            "title" => "Dashboard",
            'page' => 'Dashboard Account',
        ];

        $title = $data->title;
        // dd($dash1);
        // dd(Auth::user());
        return view($this->view, compact('data', 'title', 'perusahaan', 'lamars', 'lokers'));
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
        return view("perusahaan.profilku", compact('data', 'routes', 'user'));
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

            return redirect()->route('edit.perusahaan')->with($mess);
        }
        $mess = [
            "type" => "danger",
            "text" => "Failed , Profil gagal diperbarui."
        ];

        return redirect()->route('edit.perusahaan')->with($mess);
    }
}
