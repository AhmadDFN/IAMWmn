<?php

namespace App\Http\Controllers\perusahaan;

use App\Models\loker;
use App\Models\Jurusan;
use App\Models\JenisLoker;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Helpers\CodeGenerator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Lamar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LokerController extends Controller
{
    protected $view = 'perusahaan.loker.';
    protected $route = '/perusahaan/loker/';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = (object)[
            'index' => $this->route,
            'add' => $this->route . 'create',
        ];

        $lokers =  DB::table('lokers')
            ->join('perusahaans', 'lokers.loker_id_perusahaan', '=', 'perusahaans.id')
            ->where('perusahaans.id', Auth::user()->reff)
            ->select('lokers.*', 'perusahaans.perusahaan_foto', 'perusahaans.perusahaan_nm', 'perusahaans.perusahaan_kota')
            ->get();

        $jurusans  = Jurusan::all();

        foreach ($lokers as $key => $loker) {
            $lokers[$key]->jurusans = Jurusan::whereIn('jurusan_kd', explode(',', $lokers[$key]->loker_kd_jurusan))->get();
        }

        $data = (object)[
            "title" => "Loker",
            'page' => 'Loker Account',
        ];
        $title = $data->title;
        // dd($lokers);
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

        // dd($requestData);
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
        // dd($lamars);
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
