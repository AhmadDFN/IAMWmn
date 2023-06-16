<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Jurusan;
use App\Models\Kota;
use App\Models\Perusahaan;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            "title" => "Perusahaan",
            'page' => 'DataPerusahaan Colabs Wearnes Madiun',
            "perusahaans" => Perusahaan::All()
        ];

        return view('perusahaan.data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            "title" => "Perusahaan",
            'page' => 'Form Data Perusahaan',
            "jurusans" => Jurusan::All(),
            "kotas" => Kota::all(),
            "provinsis" => Provinsi::all(),
        ];

        return view("perusahaan.form", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        perusahaan::create($request->all());
        return redirect()->route('perusahaan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Perusahaan $perusahaan)
    {
        $data = [
            "title" => perusahaan::find($perusahaan->perusahaan_nm),
            'page' => "Profil perusahaan " . perusahaan::find($perusahaan->perusahaan_nm),
            'perusahaan' => perusahaan::find($perusahaan->id),
        ];
        return view("perusahaan.sigle", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Perusahaan $perusahaan)
    {
        $idprof =
            DB::select("SELECT * 
            FROM perusahaans AS m
            JOIN kotas AS k ON m.perusahaan_kota = k.name
            JOIN provinsis AS p ON k.province_id = p.id
            WHERE m.id = $perusahaan->id");

        if ($idprof == []) {
            $idprof[0] = (object)[
                'province_id' => 11
            ];
        }

        $data = [
            "title" => "Perusahaan",
            'page' => 'Form Data Perusahaan',
            "perusahaan" => $perusahaan,
            "idprof" => $idprof,
            "kotas" => Kota::where("province_id", $idprof[0]->province_id)->get(),
            "provinsis" => Provinsi::all(),
        ];
        // dd($data->kotas[0]);

        return view("perusahaan.form", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Perusahaan $perusahaan)
    {
        $perusahaan->fill(($request->all()));
        $perusahaan->save();

        return redirect()->route('perusahaan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Perusahaan $perusahaan)
    {
        $perusahaan->delete();
        return redirect()->route('perusahaan.index');
    }
}
