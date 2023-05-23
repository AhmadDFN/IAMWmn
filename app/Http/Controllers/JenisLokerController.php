<?php

namespace App\Http\Controllers;

use App\Models\JenisLoker;
use Exception;
use Illuminate\Http\Request;

class JenisLokerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            "title" => "Data Jenis Loker",
            'page' => 'Data Jenis Loker Alumni Wearnes Madiun',
            "jenislokers" => JenisLoker::All()
        ];
        return view('jenisloker.data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($req)
    {
        $data = [
            "title" => "Jenis Loker",
            'page' => 'Form Data Jenis Loker',
            "jenisloker" => JenisLoker::find($req->id),
        ];
        return view("jenisloker.form", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        // Proses Simpan
        try {
            // Save
            JenisLoker::updateOrCreate(
                [
                    "id" => $req->input("id")
                ],
                [
                    "jurusan_nm" => $req->input("jurusan_nm"),
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

        return redirect('jenisloker')->with($notif);
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisLoker $req)
    {
        $data = [
            "title" => jenisloker::find($req->jenisloker_nm),
            'page' => "Profil Jenis Loker " . jenisloker::find($req->jenisloker_nm),
            'jenisloker' => jenisloker::find($req->id),
        ];

        return view("jenisloker.single", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisLoker $jenisLoker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisLoker $jenisLoker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisLoker $id)
    {
        try {
            // Save
            JenisLoker::where("id", $id)->delete();

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

        return redirect('jenisloker')->with($notif);
    }
}
