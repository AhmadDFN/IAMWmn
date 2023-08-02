<?php

namespace App\Http\Controllers\perusahaan;

use App\Models\Lamar;
use App\Models\Loker;
use App\Models\Berkas;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\JenisLoker;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LamarController extends Controller
{
    protected $view = 'perusahaan.lamar.';
    protected $route = '/perusahaan/lamar/';

    public function histori()
    {
        $routes = (object)[
            'index' => $this->route,
            'add' => $this->route . 'create',
        ];
        $lamars = DB::table('lamars')
            ->join('lokers', 'lamars.lamar_id_loker', '=', 'lokers.id')
            ->join('mahasiswas', 'lamars.lamar_NIM', '=', 'mahasiswas.mhs_NIM')
            ->join('perusahaans', 'lokers.loker_id_perusahaan', '=', 'perusahaans.id')
            ->join('jurusans', 'mahasiswas.mhs_kd_jurusan', '=', 'jurusans.jurusan_kd')
            ->where('perusahaans.id', Auth::user()->reff)
            ->select('lamars.*', 'lokers.loker_nm', 'perusahaans.perusahaan_nm', 'jurusans.jurusan_nm', 'mahasiswas.mhs_nm')
            ->orderBy('lamars.id', 'desc')
            ->get();
        $data = (object)[
            "title" => "Histori Lamaran",
            'page' => 'Lamar History',
        ];
        // dd($lamars);
        $title = $data->title;
        return view($this->view . 'record', compact('lamars', 'routes', 'data', 'title'));
    }


    function update_status(Lamar $lamar, $lamar_status)
    {
        $request = [
            'lamar_status' => $lamar_status
        ];
        $lamar->fill($request);
        $lamar->save();
        $mess = [
            "type" => "success",
            "text" => "Status Diupdate."
        ];
        return back()->with('notification', $mess);
    }

    function update_all($id_loker, $status)
    {
        // dd(['idloker' => $id_loker, 'status' => $status]);
        Lamar::where('lamar_id_loker', $id_loker)->update(['lamar_status' => $status]);
        $mess = [
            "type" => "success",
            "text" => "Status Diupdate."
        ];
        return back()->with('notification', $mess);
    }

    public function indexPerusahaan()
    {
        $routes = (object)[
            'index' => $this->route,
            'add' => $this->route . 'create',
        ];

        $lamars =  DB::table('lokers')
            ->join('perusahaans', 'lokers.loker_id_perusahaan', '=', 'perusahaans.id')
            ->join('jenis_lokers', 'lokers.loker_id_jnsloker', '=', 'jenis_lokers.id')
            ->where('perusahaans.id', Auth::user()->reff)
            ->select('jenis_lokers.jenis_loker_nm', 'perusahaans.perusahaan_foto', 'perusahaans.perusahaan_nm', 'perusahaans.perusahaan_kota', 'lokers.*', DB::raw('(SELECT COUNT(*) FROM lamars WHERE lamars.lamar_id_loker = lokers.id AND lamars.lamar_status != 0 AND lamars.lamar_status != 6) AS jumlah_pelamar'))
            ->get();

        $data = (object)[
            "title" => "Lamar Perusahaan",
            'page' => 'Lamar Perusahaan',
        ];
        // dd($lamars);
        $title = $data->title;
        return view($this->view . 'perusahaan.data', compact('lamars', 'routes', 'data', 'title'));
    }

    function detail_lowonganPerusahaan(Loker $loker, Request $req)
    {
        $routes = (object)[
            'index' => $this->route,
            'add' => $this->route . 'create',
        ];
        $data = (object)[
            "title" => "Lamar Perusahaan",
            'page' => 'Lamar Perusahaan',
        ];
        $perusahaan = Perusahaan::where('id', $loker->loker_id_perusahaan)->get()->first();
        $title = $data->title;

        if ($req->status) {
            $lamars = DB::table("lamars")
                ->join("mahasiswas", "lamars.lamar_NIM", "=", "mahasiswas.mhs_NIM")
                ->join("berkas", "mahasiswas.mhs_NIM", "=", "berkas.berkas_NIM")
                ->select("lamars.*", "mahasiswas.mhs_nm", "berkas.id as id_berkas", "mahasiswas.id as id_mahasiswa")
                ->where("lamars.lamar_id_loker", $loker->id)
                ->where('lamars.lamar_status', '=', $req->status)
                ->get();
        } else {
            $lamars = DB::table("lamars")
                ->join("mahasiswas", "lamars.lamar_NIM", "=", "mahasiswas.mhs_NIM")
                ->join("berkas", "mahasiswas.mhs_NIM", "=", "berkas.berkas_NIM")
                ->select("lamars.*", "mahasiswas.mhs_nm", "berkas.id as id_berkas", "mahasiswas.id as id_mahasiswa")
                ->where("lamars.lamar_id_loker", $loker->id)
                ->where('lamars.lamar_status', '!=', 0)
                ->where('lamars.lamar_status', '!=', 6)
                ->get();
        }

        $loker->jurusans = Jurusan::whereIn('jurusan_kd', explode(',', $loker->loker_kd_jurusan))->get();
        $loker->jenisloker = JenisLoker::where('id', $loker->loker_id_jnsloker)->get()->first();
        return view($this->view . 'perusahaan.detail', compact('lamars', 'perusahaan', 'routes', 'data', 'title', 'loker'));
    }

    public function pemberkasan(Mahasiswa $mahasiswa)
    {
        $berkas = Berkas::where('berkas_NIM', $mahasiswa->mhs_NIM)->get()->first();
        $progress = 0;
        if ($berkas->berkas_kk !== null) {
            $progress++;
        }
        if ($berkas->berkas_skck !== null) {
            $progress++;
        }
        if ($berkas->berkas_cv !== null) {
            $progress++;
        }
        if ($berkas->berkas_foto !== null) {
            $progress++;
        }
        if ($berkas->berkas_ijazah !== null) {
            $progress++;
        }
        if ($berkas->berkas_ktp !== null) {
            $progress++;
        }
        // dd($progress);
        $data = (object)[
            "title" => $mahasiswa->mhs_nm,
            'page' => "Profil Mahasiswa " . $mahasiswa->mhs_nm,
        ];
        $lamars =  DB::table('lamars')
            ->join('lokers', 'lamars.lamar_id_loker', '=', 'lokers.id')
            ->join('perusahaans', 'lokers.loker_id_perusahaan', '=', 'perusahaans.id')
            ->select('lamars.*', 'lokers.loker_nm', 'perusahaans.perusahaan_nm')
            ->where('lamars.lamar_NIM', "=", $mahasiswa->mhs_NIM)
            ->limit(3)
            ->get();
        $title = "Mahasiswa";
        $berkas = Berkas::where("berkas_NIM", $mahasiswa->mhs_NIM)->get()->first();
        return view("perusahaan.showberkas", compact('data', 'mahasiswa', 'title', 'lamars', 'berkas', 'progress'));
    }
}
