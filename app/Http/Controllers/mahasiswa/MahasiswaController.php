<?php

namespace App\Http\Controllers\mahasiswa;

use App\Models\Kota;
use App\Models\Berkas;
use App\Models\Jurusan;
use App\Models\Provinsi;
use App\Models\Mahasiswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::where('mhs_NIM', '=', Auth::user()->reff)->get()->first();
        $berkas = Berkas::where('berkas_NIM', Auth::user()->reff)->get()->first();
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
        return view("mahasiswa.mahasiswa.show", compact('data', 'mahasiswa', 'title', 'lamars', 'berkas', 'progress'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $idprof =
            DB::select("SELECT * 
                FROM mahasiswas AS m
                JOIN kotas AS k ON m.mhs_kota = k.name
                JOIN provinsis AS p ON k.province_id = p.id
                WHERE m.id = $mahasiswa->id");

        if ($idprof == []) {
            $idprof[0] = (object)[
                'province_id' => 11
            ];
        }

        // dd($idprof[0]);
        $data = [
            "title" => "Edit Data",
            'page' => 'Form Edit data Mahasiswa',
            'jurusans' => Jurusan::All(),
            "provinsis" => Provinsi::all(),
            "idprof" => $idprof,
            "kotas" => Kota::where("province_id", $idprof[0]->province_id)->get(),
            'pos' => 'Edit',
            "mahasiswa" => Mahasiswa::where("id", $mahasiswa->id)->first(),
            'berkas' => Berkas::where('berkas_NIM', Auth::user()->reff)->get()->first()
        ];
        // dd($data["berkas"]);
        return view("mahasiswa.mahasiswa.form", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $requestmhs = $request->all();
        $requestberkas = $request->all();
        $nimterakhir = substr($mahasiswa->mhs_NIM, -3);
        if ($request->file("foto")) {
            $fileName = time() . $nimterakhir . "F-" . Str::random(6) . '.' . $request->file("foto")->extension();
            $result = $request->file("foto")->move(public_path('uploads/berkas/foto'), $fileName);
            $requestberkas['berkas_foto'] = "uploads/berkas/foto/" . $fileName;
            $requestmhs['mhs_foto'] = "uploads/berkas/foto/" . $fileName;
        } else {
            $requestberkas['berkas_foto'] = $request->input("old_foto");
            $requestmhs['mhs_foto'] = $request->input("old_foto");
        }

        if ($request->file("berkas_cv")) {
            $fileName = time() . $nimterakhir . "C-" . Str::random(6) . '.' . $request->file("berkas_cv")->extension();
            $result2 = $request->file("berkas_cv")->move(public_path('uploads/berkas/cv'), $fileName);
            $requestberkas['berkas_cv'] = "uploads/berkas/cv/" . $fileName;
        } else {
            $requestberkas['berkas_cv'] = $request->input("old_cv");
        }

        if ($request->file("berkas_skck")) {
            $fileName = time() . $nimterakhir . "S-" . Str::random(6) . '.' . $request->file("berkas_skck")->extension();
            $result3 = $request->file("berkas_skck")->move(public_path('uploads/berkas/skck'), $fileName);
            $requestberkas['berkas_skck'] = "uploads/berkas/skck/" . $fileName;
        } else {
            $requestberkas['berkas_skck'] = $request->input("old_skck");
        }

        if ($request->file("berkas_kk")) {
            $fileName = time() . $nimterakhir . "K-" . Str::random(6) . '.' . $request->file("berkas_kk")->extension();
            $result4 = $request->file("berkas_kk")->move(public_path('uploads/berkas/kk'), $fileName);
            $requestberkas['berkas_kk'] = "uploads/berkas/kk/" . $fileName;
        } else {
            $requestberkas['berkas_kk'] = $request->input("old_kk");
        }

        if ($request->file("berkas_ijazah")) {
            $fileName = time() . $nimterakhir . "I-" . Str::random(6) . '.' . $request->file("berkas_ijazah")->extension();
            $result5 = $request->file("berkas_ijazah")->move(public_path('uploads/berkas/ijazah'), $fileName);
            $requestberkas['berkas_ijazah'] = "uploads/berkas/ijazah/" . $fileName;
        } else {
            $requestberkas['berkas_ijazah'] = $request->input("old_ijazah");
        }
        if ($request->file("berkas_ktp")) {
            $fileName = time() . $nimterakhir . "KT-" . Str::random(6) . '.' . $request->file("berkas_ktp")->extension();
            $result5 = $request->file("berkas_ktp")->move(public_path('uploads/berkas/ktp'), $fileName);
            $requestberkas['berkas_ktp'] = "uploads/berkas/ktp/" . $fileName;
        } else {
            $requestberkas['berkas_ktp'] = $request->input("old_ktp");
        }


        $requestberkas["id"] = $request->id_berkas;
        // dd(compact('requestmhs', 'requestberkas'));
        $berkas = Berkas::where('berkas_NIM', Auth::user()->reff)->get()->first();


        $mahasiswa->fill($requestmhs);
        $mahasiswa->save();
        $berkas->fill($requestberkas);
        $berkas->save();
        $mess = [
            "type" => "success",
            "text" => "Anda Berhasil Mengedit Berkas."
        ];
        return redirect('home/mahasiswa')->with('notification', $mess);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $notif = [
            "type" => "success",
            "text" => "Data Berhasil Dihapus !"
        ];
        $mahasiswa->delete();
        return redirect('mahasiswa')->with('notification', $notif);
    }
}
