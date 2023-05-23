<?php

namespace App\Http\Controllers;

use App\Models\Lamar;
use App\Models\Loker;
use App\Models\Mahasiswa;
use Exception;
use Illuminate\Http\Request;

class LamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            "title" => "Data Lamar",
            'page' => 'Data Lamar Alumni Wearnes Madiun',
            "lamars" => Lamar::All()
        ];
        return view('lamar.data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($req)
    {
        $data = [
            "title" => "Lamar",
            'page' => 'Form Data Lamar',
            "dtMahasiswa" => Mahasiswa::All(),
            "dtLoker" => Loker::All(),
            "lamar" => Lamar::find($req->id),
        ];

        return view("lamar.form", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        // Proses Simpan
        try {
            // Save
            Mahasiswa::updateOrCreate(
                [
                    "id" => $req->input("id")
                ],
                [
                    "lamar_kd" => $req->input("lamar_kd"),
                    "lamar_nm" => $req->input("lamar_nm"),
                    "lamar_NIM" => $req->input("lamar_NIM"),
                    "lamar_id_loker" => $req->input("lamar_id_loker"),
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
    public function show(Lamar $req)
    {
        $data = [
            "title" => lamar::find($req->lamar_nm),
            'page' => "Profil Lamaran Pekerjaan " . lamar::find($req->lamar_nm),
            'lamar' => lamar::find($req->id),
        ];

        return view("lamar.single", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lamar $lamar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lamar $lamar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lamar $id)
    {
        try {
            // Save
            Lamar::where("id", $id)->delete();

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

        return redirect('lamar')->with($notif);
    }
}
