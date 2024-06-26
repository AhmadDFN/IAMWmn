<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\Kota;
use App\Models\Jurusan;
use App\Models\Provinsi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Berkas;
use App\Models\Lamar;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            "title" => "Mahasiswa",
            'page' => 'Mahasiswa ALUMNI WEC',
            "mahasiswas" => Mahasiswa::All()
        ];
        return view('admin.mahasiswa.data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            "title" => "Mahasiswa",
            'page' => 'Form Input data Mahasiswa',
            "jurusans" => Jurusan::All(),
            "kotas" => Kota::all(),
            "provinsis" => Provinsi::all(),
            'pos' => 'New',
        ];
        return view("admin.mahasiswa.form", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        // Validasi
        // $request->validate(
        //     [
        // "mhs_NIM" => "required|unique:mahasiswas,mhs_NIM," . $req->input("mhs_NIM") . "|max:10",
        // "mhs_nm" => "required|max:50",
        // "mn_cat_id" => "required",
        // "mn_harga" => "required|numeric",
        // "mn_satuan" => "required|max:20",
        // "mn_stok" => "required",
        // "mn_kitc_id" => "required",
        // "foto"   => "mimes:jpg,jpeg,png|max:8024"
        // ],
        // [
        // "mhs_NIM.required" => "Kode Menu Wajib diisi !",
        // "mhs_NIM.unique" => "Kode Sudah digunakan",
        // "mhs_NIM.max" => "Kode maximal 10 Karakter",
        // "mhs_nm.required" => "Nama Wajib diisi !",
        // "mhs_nm.max" => "Nama maximal 50 Karaker !",
        // "mn_harga.max" => "Harga wajib diisi !",
        // "mn_harga.numeri" => "Harga harus berupa angka",
        // "mn_satuan.required" => "Satuan wajib diisi !",
        // "mn_satuan.max" => "Satuan maimal 20 karakter !",
        // "mn_stok.required" => "Stok wajib diisi !",
        // "mn_kitc_id.required" => "Dapur wajib diisi !",
        // "foto.mimes" => "Foto harus .jpg, .jpeg atau png !",
        // "foto.max" => "Foto maximal ukuran 1 MB !",
        // ]
        // );

        // Proses Upload
        // dd($request);

        if ($request->file("mhs_foto")) {
            $fileName = time() . $request->input("mhs_NIM") . '.' . $request->file("mhs_foto")->extension();
            $result = $request->file("mhs_foto")->move(public_path('uploads/berkas/foto'), $fileName);
            $mhs_foto = "uploads/berkas/foto/" . $fileName;
        } else {
            $mhs_foto = $request->input("old_foto");
        }

        // Proses Simpan
        try {
            // Save
            Mahasiswa::updateOrCreate(
                [
                    "id" => $request->input("id")
                ],
                [
                    "mhs_NIM" => $request->input("mhs_NIM"),
                    "mhs_nm" => $request->input("mhs_nm"),
                    "mhs_email" => $request->input("mhs_email"),
                    "mhs_jk" => $request->input("mhs_jk"),
                    "mhs_notelp" => $request->input("mhs_notelp"),
                    "mhs_th_masuk" => $request->input("mhs_th_masuk"),
                    "mhs_th_lulus" => $request->input("mhs_th_masuk") + 1,
                    "mhs_kota_lahir" => $request->input("mhs_kota"),
                    "mhs_tanggal_lahir" => $request->input("mhs_tanggal_lahir"),
                    "mhs_alamat" => $request->input("mhs_kota"),
                    "mhs_kota" => $request->input("mhs_kota"),
                    // "mhs_tb" => @$request->input("mhs_tb"),
                    // "mhs_bb" => @$request->input("mhs_bb"),
                    "mhs_kd_jurusan" => $request->input("mhs_kd_jurusan"),
                    "mhs_id_user" => $request->input("mhs_id_user"),
                    "mhs_foto" => $mhs_foto,
                ]
            );

            if (!$request->input("id")) {
                // dd($request->input("id"));
                $faker = fake('id_ID');

                $kirim = [
                    "berkas_kd" => $faker->isbn13(),
                    "berkas_NIM" => $request->input("mhs_NIM"),
                    "created_at" => date("Y-m-d h:i:s"),
                    "updated_at" => date("Y-m-d h:i:s"),
                ];
                Berkas::create($kirim);
            };

            if ($request->input("id")) {
                DB::table('berkas')
                    ->where('berkas_NIM', $request->input("mhs_NIM"))
                    ->update(['berkas_foto' => $mhs_foto]);
            };

            // dd('kesimpen');
            // Notif 
            $notif = [
                "type" => "success",
                "text" => "Data Berhasil Disimpan !"
            ];
            // dd($notif);
        } catch (Exception $err) {
            dd($err);
            $notif = [
                "type" => "danger",
                "text" => "Data Gagal Disimpan !" . $err->getMessage()
            ];
            // dd($notif);
        }

        // dd($request);

        return redirect()->route('mahasiswa.index')->with($notif);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
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
        return view("admin.mahasiswa.show", compact('data', 'mahasiswa', 'title', 'lamars', 'berkas'));
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
            "title" => "Mahasiswa",
            'page' => 'Form Edit data Mahasiswa',
            'jurusans' => Jurusan::All(),
            "provinsis" => Provinsi::all(),
            "idprof" => $idprof,
            "kotas" => Kota::where("province_id", $idprof[0]->province_id)->get(),
            'pos' => 'Edit',
            "mahasiswa" => Mahasiswa::where("id", $mahasiswa->id)->first()
        ];

        return view("admin.mahasiswa.form", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        // try {
        //     // Save
        //     Mahasiswa::where("id", $id)->delete();

        //     // Notif 
        //     $notif = [
        //         "type" => "success",
        //         "text" => "Data Berhasil Dihapus !"
        //     ];
        // } catch (Exception $err) {
        //     $notif = [
        //         "type" => "danger",
        //         "text" => "Data Gagal Dihapus !" . $err->getMessage()
        //     ];
        // }

        $notif = [
            "type" => "success",
            "text" => "Data Berhasil Dihapus !"
        ];
        $mahasiswa->delete();
        return redirect('mahasiswa')->with($notif);
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
        return view("admin.mahasiswa.showberkas", compact('data', 'mahasiswa', 'title', 'lamars', 'berkas', 'progress'));
    }
}
