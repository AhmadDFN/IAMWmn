<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\Kota;
use App\Models\Jurusan;
use App\Models\Provinsi;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Loker;

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

        return view('admin.perusahaan.data', $data);
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

        return view("admin.perusahaan.form", $data);
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
        $data = (object)[
            'title' => $perusahaan->perusahaan_nm,
            'page' => "Profil perusahaan " . $perusahaan->perusahaan_nm,
        ];
        $title = "Perusahaan";
        $lokers = Loker::where("loker_id_perusahaan", $perusahaan->id)->get();
        // dd($lokers);
        return view("admin.perusahaan.show", compact('data', 'perusahaan', 'title', 'lokers'));
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

        return view("admin.perusahaan.form", $data);
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
