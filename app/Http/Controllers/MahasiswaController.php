<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Mahasiswa;
use Exception;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            "title" => "Data Mahasiswa",
            'page' => 'Data Mahasiswa Alumni Wearnes Madiun',
            "mahasiswas" => Mahasiswa::All()
        ];
        return view('mahasiswa.data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($req)
    {
        $data = [
            "title" => "Mahasiswa",
            'page' => 'Form Data Mahasiswa',
            "dtJurusan" => Jurusan::All(),
            "mahasiswa" => Mahasiswa::find($req->mhs_NIM),
        ];

        return view("mahasiswa.form", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        // Validasi
        $req->validate(
            [
                "mhs_NIM" => "required|unique:mahasiswas,mhs_NIM," . $req->input("mhs_NIM") . "|max:10",
                "mhs_nm" => "required|max:50",
                // "mn_cat_id" => "required",
                // "mn_harga" => "required|numeric",
                // "mn_satuan" => "required|max:20",
                // "mn_stok" => "required",
                // "mn_kitc_id" => "required",
                // "foto"   => "mimes:jpg,jpeg,png|max:8024"
            ],
            [
                "mhs_NIM.required" => "Kode Menu Wajib diisi !",
                "mhs_NIM.unique" => "Kode Sudah digunakan",
                "mhs_NIM.max" => "Kode maximal 10 Karakter",
                "mhs_nm.required" => "Nama Wajib diisi !",
                "mhs_nm.max" => "Nama maximal 50 Karaker !",
                // "mn_harga.max" => "Harga wajib diisi !",
                // "mn_harga.numeri" => "Harga harus berupa angka",
                // "mn_satuan.required" => "Satuan wajib diisi !",
                // "mn_satuan.max" => "Satuan maimal 20 karakter !",
                // "mn_stok.required" => "Stok wajib diisi !",
                // "mn_kitc_id.required" => "Dapur wajib diisi !",
                // "foto.mimes" => "Foto harus .jpg, .jpeg atau png !",
                // "foto.max" => "Foto maximal ukuran 1 MB !",
            ]
        );

        // Proses Upload
        // dd($req->file("foto"));

        if ($req->file("mhs_foto")) {
            $fileName = time() . '.' . $req->file("mhs_foto")->extension();
            $result = $req->file("foto")->move(public_path('uploads/menu'), $fileName);
            $mhs_foto = "uploads/menu/" . $fileName;
        } else {
            $mhs_foto = $req->input("old_foto");
        }



        // Proses Simpan
        try {
            // Save
            Mahasiswa::updateOrCreate(
                [
                    "id" => $req->input("id")
                ],
                [
                    "mhs_NIM" => $req->input("mhs_NIM"),
                    "mhs_nm" => $req->input("mhs_nm"),
                    "mhs_email" => $req->input("mhs_email"),
                    "mhs_jk" => $req->input("mhs_jk"),
                    "mhs_notelp" => $req->input("mhs_notelp"),
                    "mhs_th_masuk" => $req->input("mhs_th_masuk"),
                    "mhs_th_lulus" => $req->input("mhs_th_lulus"),
                    "mhs_kota_lahir" => $req->input("mhs_kota_lahir"),
                    "mhs_tanggal_lahir" => $req->input("mhs_tanggal_lahir"),
                    "mhs_alamat" => $req->input("mhs_alamat"),
                    "mhs_kota" => $req->input("mhs_kota"),
                    "mhs_tb" => $req->input("mhs_tb"),
                    "mhs_bb" => $req->input("mhs_bb"),
                    "mhs_kd_jurusan" => $req->input("mhs_kd_jurusan"),
                    "mhs_id_user" => $req->input("mhs_id_user"),
                    "mhs_foto" => $mhs_foto,
                ]
            );

            // Notif 
            $notif = [
                "type" => "success",
                "text" => "Data Berhasil Disimpan !"
            ];
        } catch (Exception $err) {
            $notif = [
                "type" => "danger",
                "text" => "Data Gagal Disimpan !" . $err->getMessage()
            ];
        }

        return redirect('mahasiswa')->with($notif);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $req)
    {
        $data = [
            "title" => Mahasiswa::find($req->mhs_nm),
            'page' => "Profil Mahasiswa " . Mahasiswa::find($req->mhs_nm),
            'mahasiswa' => Mahasiswa::find($req->mhs_NIM),
        ];

        return view("mahasiswa.single", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //
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
    public function destroy($mhs_NIM)
    {
        try {
            // Save
            Mahasiswa::where("mhs_NIM", $mhs_NIM)->delete();

            // Notif 
            $notif = [
                "type" => "success",
                "text" => "Data Berhasil Dihapus !"
            ];
        } catch (Exception $err) {
            $notif = [
                "type" => "danger",
                "text" => "Data Gagal Dihapus !" . $err->getMessage()
            ];
        }

        return redirect('mahasiswa')->with($notif);
    }
}
