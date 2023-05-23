<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Exception;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            "title" => "Data Jurusan",
            'page' => 'Data Jurusan Alumni Wearnes Madiun',
            "jurusans" => Jurusan::All()
        ];
        return view('jurusan.data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($req)
    {
        $data = [
            "title" => "Jurusan",
            'page' => 'Form Data Jurusan',
            "jurusan" => Jurusan::find($req->id),
        ];

        return view("jurusan.form", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        // Proses Simpan
        try {
            // Save
            Jurusan::updateOrCreate(
                [
                    "id" => $req->input("id")
                ],
                [
                    "jurusan_kd" => $req->input("jurusan_kd"),
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

        return redirect('mahasiswa')->with($notif);
    }

    /**
     * Display the specified resource.
     */
    public function show(Jurusan $req)
    {
        $data = [
            "title" => jurusan::find($req->jurusan_nm),
            'page' => "Profil Jurusan " . jurusan::find($req->jurusan_nm),
            'jurusan' => jurusan::find($req->id),
        ];

        return view("jurusan.single", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurusan $jurusan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurusan $id)
    {
        try {
            // Save
            Jurusan::where("id", $id)->delete();

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

        return redirect('jurusan')->with($notif);
    }
}
