<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Mahasiswa;
use Exception;
use Illuminate\Http\Request;

class BerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            "title" => "Data Berkas",
            'page' => 'Data Berkas Alumni Wearnes Madiun',
            "berkas" => Berkas::All()
        ];
        return view('berkas.data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($req)
    {
        $data = [
            "title" => "Berkas",
            'page' => 'Form Data Berkas',
            "dtJurusan" => Mahasiswa::All(),
            "berkas" => Berkas::find($req->id),
        ];

        return view("berkas.form", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        if ($req->file("berkas_foto")) {
            $fileName = time() . '.' . $req->file("berkas_foto")->extension();
            $result = $req->file("foto")->move(public_path('uploads/berkas/foto'), $fileName);
            $berkas_foto = "uploads/berkas/foto" . $fileName;
        } else {
            $berkas_foto = $req->input("old_foto");
        }

        if ($req->file("berkas_cv")) {
            $fileName = time() . '.' . $req->file("berkas_cv")->extension();
            $result = $req->file("cv")->move(public_path('uploads/berkas/cv'), $fileName);
            $berkas_cv = "uploads/berkas/cv" . $fileName;
        } else {
            $berkas_cv = $req->input("old_cv");
        }

        if ($req->file("berkas_skck")) {
            $fileName = time() . '.' . $req->file("berkas_skck")->extension();
            $result = $req->file("skck")->move(public_path('uploads/berkas/skck'), $fileName);
            $berkas_skck = "uploads/berkas/skck" . $fileName;
        } else {
            $berkas_skck = $req->input("old_skck");
        }

        if ($req->file("berkas_kk")) {
            $fileName = time() . '.' . $req->file("berkas_kk")->extension();
            $result = $req->file("kk")->move(public_path('uploads/berkas/kk'), $fileName);
            $berkas_kk = "uploads/berkas/kk" . $fileName;
        } else {
            $berkas_kk = $req->input("old_kk");
        }

        if ($req->file("berkas_ijazah")) {
            $fileName = time() . '.' . $req->file("berkas_ijazah")->extension();
            $result = $req->file("ijazah")->move(public_path('uploads/berkas/ijazah'), $fileName);
            $berkas_ijazah = "uploads/berkas/ijazah" . $fileName;
        } else {
            $berkas_ijazah = $req->input("old_ijazah");
        }

        try {
            // Save
            Berkas::updateOrCreate(
                [
                    "id" => $req->input("id")
                ],
                [
                    "berkas_kd" => $req->input("berkas_kd"),
                    "berkas_skck" => $berkas_skck,
                    "berkas_kk" => $berkas_kk,
                    "berkas_cv" => $berkas_cv,
                    "berkas_ijazah" => $berkas_ijazah,
                    "berkas_NIM" => $req->input("berkas_NIM"),
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

        return redirect('berkas')->with($notif);
    }

    /**
     * Display the specified resource.
     */
    public function show(Berkas $req)
    {
        $data = [
            "title" => berkas::find($req->berkas_nm),
            'page' => "Profil Berkas " . berkas::find($req->berkas_nm),
            'berkas' => berkas::find($req->id),
        ];

        return view("berkas.single", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berkas $berkas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berkas $berkas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berkas $id)
    {
        try {
            // Save
            Berkas::where("id", $id)->delete();

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

        return redirect('berkas')->with($notif);
    }
}
