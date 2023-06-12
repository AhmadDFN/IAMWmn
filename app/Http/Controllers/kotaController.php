<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\regencie;
use Illuminate\Http\Request;

class kotaController extends Controller
{
    public function getKotaByProvinsi(Request $request)
    {
        $provinsiId = $request->id_prov;

        $kotaList = Kota::where('province_id', $provinsiId)->get();

        $kota = "";

        foreach ($kotaList as $k) {
            $kota .= "<option value='" . $k->name . "'>" . $k->name . "</option>";
        }

        //return response()->json($kotaList);
        return $kota;
    }
}
