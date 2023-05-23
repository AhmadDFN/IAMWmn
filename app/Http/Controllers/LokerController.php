<?php

namespace App\Http\Controllers;

use App\Models\JenisLoker;
use App\Models\Jurusan;
use App\Models\Loker;
use Exception;
use Illuminate\Http\Request;

class LokerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            "title" => "Data Loker",
            'page' => 'Data Loker Alumni Wearnes Madiun',
            "lokers" => Loker::All()
        ];
        return view('loker.data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($req)
    {
        $data = [
            "title" => "Lowongan Kerja",
            'page' => 'Form Data Lowongan Kerja',
            "dtJurusan" => Jurusan::All(),
            'jenisloker' => JenisLoker::All(),
            "loker" => Loker::find($req->id),
        ];

        return view("loker.form", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        try {
            // Save
            Loker::updateOrCreate(
                [
                    "id" => $req->input("id")
                ],
                [
                    "loker_kd" => $req->input("loker_kd"),
                    "loker_nm" => $req->input("loker_nm"),
                    "loker_ket" => $req->input("loker_ket"),
                    "loker_exp" => $req->input("loker_exp"),
                    "loker_kd_jurusan" => $req->input("loker_kd_jurusan"),
                    "loker_status" => $req->input("loker_status"),
                    "loker_id_perusahaan" => $req->input("loker_id_perusahaan"),
                    "loker_id_jnsloker" => $req->input("loker_id_jnsloker"),
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

        return redirect('loker')->with($notif);
    }

    /**
     * Display the specified resource.
     */
    public function show(Loker $req)
    {
        $data = [
            "title" => loker::find($req->id),
            'page' => "Profil loker " . loker::find($req->id),
            'loker' => loker::find($req->mhs_NIM),
        ];

        return view("loker.single", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loker $loker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loker $loker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loker $id)
    {
        try {
            // Save
            Loker::where("id", $id)->delete();

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
