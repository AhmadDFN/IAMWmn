<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Exception;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            "title" => "DataPerusahaan",
            'page' => 'DataPerusahaan Alumni Wearnes Madiun',
            "perusahaans" => Perusahaan::All()
        ];
        return view('perusahaan.data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($req)
    {
        $data = [
            "title" => "Perusahaan",
            'page' => 'Form Data Perusahaan',
            "Perusahaan" => Perusahaan::find($req->id),
        ];

        return view("perusahaan.form", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        // Validasi
        $req->validate(
            [
                "perusahaan_nm" => "required|max:50",
                // "mn_cat_id" => "required",
                // "mn_harga" => "required|numeric",
                // "mn_satuan" => "required|max:20",
                // "mn_stok" => "required",
                // "mn_kitc_id" => "required",
                // "foto"   => "mimes:jpg,jpeg,png|max:8024"
            ],
            [
                "perusahaan_nm.required" => "Nama Wajib diisi !",
                "perusahaan_nm.max" => "Nama maximal 50 Karaker !",
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

        // Proses Simpan
        try {
            // Save
            Perusahaan::updateOrCreate(
                [
                    "id" => $req->input("id")
                ],
                [
                    "perusahaan_nm" => $req->input("perusahaan_nm"),
                    "perusahaan_alamat" => $req->input("perusahaan_alamat"),
                    "perusahaan_kota" => $req->input("perusahaan_kota"),
                    "perusahaan_notelp" => $req->input("perusahaan_notelp"),
                    "perusahaan_email" => $req->input("perusahaan_email"),
                    "perusahaan_website" => $req->input("perusahaan_website"),
                    "perusahaan_cp_nama" => $req->input("perusahaan_cp_nama"),
                    "perusahaan_cp_notelp" => $req->input("perusahaan_cp_notelp"),
                ]
            );

            // Notif 
            $notif = [
                "type" => "success",
                "text" => "Data Berhasil Disimpan !"
            ];
        } catch (Exception $err) {
            $notif = [
                "type" => "success",
                "text" => "Data Gagal Disimpan !" . $err->getMessage()
            ];
        }

        return redirect('perusahaan')->with($notif);
    }

    /**
     * Display the specified resource.
     */
    public function show(Perusahaan $req)
    {
        $data = [
            "title" => perusahaan::find($req->perusahaan_nm),
            'page' => "Profil perusahaan " . perusahaan::find($req->perusahaan_nm),
            'perusahaan' => perusahaan::find($req->id),
        ];

        return view("perusahaan.single", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Perusahaan $perusahaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Perusahaan $perusahaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Perusahaan $id)
    {
        try {
            // Save
            Perusahaan::where("id", $id)->delete();

            // Notif 
            $notif = [
                "type" => "success",
                "text" => "Data Berhasil Dihapus !"
            ];
        } catch (Exception $err) {
            $notif = [
                "type" => "success",
                "text" => "Data Gagal Dihapus !" . $err->getMessage()
            ];
        }

        return redirect('perusahaan')->with($notif);
    }
}
