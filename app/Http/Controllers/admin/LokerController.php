<?php

namespace App\Http\Controllers\admin;

use App\Models\loker;
use App\Models\Jurusan;
use App\Models\JenisLoker;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Helpers\CodeGenerator;
use App\Helpers\getDateNow;
use Database\Seeders\LokerSeeder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Lamar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LokerController extends Controller
{
    protected $view = 'admin.loker.';
    protected $route = '/loker/';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = (object)[
            'index' => $this->route,
            'add' => $this->route . 'create',
        ];
        $lokers = Loker::all();
        $jurusans  = Jurusan::all();

        foreach ($lokers as $key => $loker) {
            $lokers[$key]->jurusans = Jurusan::whereIn('jurusan_kd', explode(',', $lokers[$key]->loker_kd_jurusan))->get();
        }

        // dd($lokers[0]->jurusans);

        // foreach ($lokers as $key => $loker) {
        //     $lokers[$key]->loker_kd_jurusan = explode(',', $loker->loker_kd_jurusan);
        // }
        // $lokers->map(function ($loker) {
        //     $loker->loker_kd_jurusan = rand(1, 5);
        //     return $loker;
        // });

        // $lokerganti = explode(",", $lokers[0]->loker_kd_jurusan);
        // $lokers[0]->loker_kd_jurusan = $lokerganti;

        // foreach ($lokers[0]->loker_kd_jurusan as $item) {
        // };

        // $lokers->map(function ($loker) {
        //     $joinedJurusan = collect($loker->loker_kd_jurusan)->map(function ($jurusan_kd) {
        //         return Jurusan::select('jurusan_kd', 'jurusan_nm')->where('jurusan_kd', $jurusan_kd)->first();;
        //     });

        //     $loker->joined_jurusan = $joinedJurusan;

        //     return $loker;
        // });

        // $result = collect($lokers[0]->joined_jurusan)->map(function ($item) {
        //     return $item['jurusan_nm'];
        // })->all();

        // $lokers[0]->joined_jurusan = $result;

        // $balikinjur = implode(",", $lokers[0]->loker_kd_jurusan);
        // $lokers[0]->loker_kd_jurusan = $balikinjur;

        // $namajur = implode(",", $lokers[0]->joined_jurusan);
        // $lokers[0]->joined_jurusan = $namajur;

        // dd($lokers[0]->joined_jurusan);

        $data = (object)[
            "title" => "Loker",
            'page' => 'Loker Account',
        ];
        $title = $data->title;
        return view($this->view . 'data', compact('lokers', 'jurusans', 'routes', 'data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $routes = (object)[
            'index' => $this->route,
            'save' => $this->route,
            // 'is_update' => false,
        ];
        $data = (object)[
            "title" => "Loker",
            'page' => 'Loker Account',
        ];
        $jurusans = Jurusan::all();
        $perusahaans = Perusahaan::all();
        $jenislokers = JenisLoker::all();
        $code = CodeGenerator::generateUniqueCode();
        $title = $data->title;
        return view($this->view . 'form', compact('routes', 'data', 'title', 'code', 'jurusans', 'perusahaans', 'jenislokers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mergedOptions = implode(',', $request->input('loker_kd_jurusan'));

        $requestData = $request->all();
        $requestData["loker_kd_jurusan"] = $mergedOptions;


        $validator = Validator::make($requestData, [
            'loker_kd_jurusan' => 'required|unique:lokers',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // dd($requestData1);
        loker::create($requestData);
        return redirect($this->route);
    }

    /**
     * Display the specified resource.
     */
    public function show(loker $loker)
    {
        $data = (object)[
            'title' => $loker->loker_nm,
            'page' => "Profil loker " . $loker->loker_nm,
            'loker' => loker::find($loker->id),
        ];
        $perusahaan = Perusahaan::where('id', $loker->loker_id_perusahaan)->get()->first();
        $lamars = Lamar::where('lamar_id_loker', $loker->id)
            ->join('mahasiswas', 'lamars.lamar_NIM', '=', 'mahasiswas.mhs_NIM')
            ->select("mahasiswas.mhs_nm", "lamars.*")
            ->get();
        $title = "Loker";
        return view($this->view . 'show', compact('loker', 'data', 'title', 'perusahaan', 'lamars'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(loker $loker)
    {
        $routes = (object)[
            'index' => $this->route,
            'save' => $this->route . $loker->id,
            'is_update' => true,
        ];
        $data = (object)[
            "title" => "Loker",
            'page' => 'Loker Account',
        ];
        $title = $data->title;
        $jurusans = Jurusan::all();
        $perusahaans = Perusahaan::all();
        $jenislokers = JenisLoker::all();
        return view($this->view . 'form', compact('loker', 'routes', 'data', 'title', 'jurusans', 'perusahaans', 'jenislokers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, loker $loker)
    {
        $loker->fill($request->all());
        $loker->save();
        return redirect($this->route);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(loker $loker)
    {
        // dd($loker);
        $loker->delete();
        DB::table('lamars')->where('lamar_id_loker', '=', $loker->id)->delete();
        return redirect($this->route);
    }
}
