<?php

namespace App\Http\Controllers;

use App\Models\loker;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Helpers\CodeGenerator;
use App\Models\JenisLoker;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Validator;

class LokerController extends Controller
{
    protected $view = 'loker.';
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
        $lokers = loker::all();
        $data = (object)[
            "title" => "Loker",
            'page' => 'Loker Account',
        ];
        $title = $data->title;
        return view($this->view . 'data', compact('lokers', 'routes', 'data', 'title'));
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
        $mergedOptions = implode(' ', $request->input('loker_kd_jurusan'));

        $requestData = $request->all();
        $requestData["loker_kd_jurusan"] = $mergedOptions;

        $validator = Validator::make($requestData, [
            'loker_kd_jurusan' => 'required|unique:lokers',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        loker::create($requestData);
        return redirect($this->route);
    }

    /**
     * Display the specified resource.
     */
    public function show(loker $loker)
    {
        return view($this->view . 'show', compact('loker'));
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
        $loker->delete();
        return redirect($this->route);
    }
}
