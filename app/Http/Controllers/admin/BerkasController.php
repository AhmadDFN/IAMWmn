<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\Berkas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BerkasController extends Controller
{
    protected $view = 'admin.mahasiswa.berkas.';
    protected function route(Mahasiswa $mahasiswa)
    {
        return '/mahasiswa/' . $mahasiswa->id . '/berkas/';
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Mahasiswa $mahasiswa)
    {
        $data = [
            "title" => "Berkas",
            'page' => 'Data Berkas' . " " . $mahasiswa->mhs_nm,
            "berkas" => Berkas::where('berkas_NIM', $mahasiswa->mhs_NIM)->get(),
            'index' => $this->route($mahasiswa),
            'add' => $this->route($mahasiswa) . 'create',
        ];
        // dd($mahasiswa);

        return view($this->view . "data", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Mahasiswa $mahasiswa)
    {
        $data = [
            "title" => "Berkas",
            'page' => 'Form Data Berkas',
            "mahasiswas" => Mahasiswa::All(),
            'index' => $this->route($mahasiswa),
            'save' => $this->route($mahasiswa),
            'is_update' => false,
        ];

        return view($this->view . "form", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Mahasiswa $mahasiswa)
    {
        // dd($mahasiswa);
        // dd($request);
        if ($request->file("berkas_foto")) {
            $fileName = time() . $mahasiswa->mhs_NIM . '.' . $request->file("berkas_foto")->extension();
            $result1 = $request->file("berkas_foto")->move(public_path('uploads/berkas/foto'), $fileName);
            $berkas_foto = "uploads/berkas/foto/" . $fileName;
        } else {
            $berkas_foto = $request->input("old_foto");
        }

        if ($request->file("berkas_cv")) {
            $fileName = time() . $mahasiswa->mhs_NIM . '.' . $request->file("berkas_cv")->extension();
            $result2 = $request->file("berkas_cv")->move(public_path('uploads/berkas/cv'), $fileName);
            $berkas_cv = "uploads/berkas/cv/" . $fileName;
        } else {
            $berkas_cv = $request->input("old_cv");
        }

        if ($request->file("berkas_skck")) {
            $fileName = time() . $mahasiswa->mhs_NIM . '.' . $request->file("berkas_skck")->extension();
            $result3 = $request->file("berkas_skck")->move(public_path('uploads/berkas/skck'), $fileName);
            $berkas_skck = "uploads/berkas/skck/" . $fileName;
        } else {
            $berkas_skck = $request->input("old_skck");
        }

        if ($request->file("berkas_kk")) {
            $fileName = time() . $mahasiswa->mhs_NIM . '.' . $request->file("berkas_kk")->extension();
            $result4 = $request->file("berkas_kk")->move(public_path('uploads/berkas/kk'), $fileName);
            $berkas_kk = "uploads/berkas/kk/" . $fileName;
        } else {
            $berkas_kk = $request->input("old_kk");
        }

        if ($request->file("berkas_ijazah")) {
            $fileName = time() . $mahasiswa->mhs_NIM . '.' . $request->file("berkas_ijazah")->extension();
            $result5 = $request->file("berkas_ijazah")->move(public_path('uploads/berkas/ijazah'), $fileName);
            $berkas_ijazah = "uploads/berkas/ijazah/" . $fileName;
        } else {
            $berkas_ijazah = $request->input("old_ijazah");
        }

        try {
            // Save
            Berkas::updateOrCreate(
                [
                    "id" => $request->input("id")
                ],
                [
                    "berkas_kd" => $request->input("berkas_kd"),
                    "berkas_skck" => $berkas_skck,
                    "berkas_kk" => $berkas_kk,
                    "berkas_cv" => $berkas_cv,
                    "berkas_ijazah" => $berkas_ijazah,
                    "berkas_NIM" => $request->input("berkas_NIM"),
                    "berkas_foto" => $berkas_foto,
                ]
            );

            if ($request->input("id")) {
                DB::table('mahasiswas')
                    ->where('mhs_NIM', $request->input("berkas_NIM"))
                    ->update(['mhs_foto' => $berkas_foto]);
            };

            // Notif 
            $notif = [
                "type" => "success",
                "text" => "Data Berhasil Disimpan !"
            ];
            // dd($notif);
        } catch (Exception $err) {
            $notif = [
                "type" => "danger",
                "text" => "Data Gagal Disimpan !" . $err->getMessage()
            ];
            dd($notif);
        }

        return redirect($this->route($mahasiswa))->with($notif);
    }

    /**
     * Display the specified resource.
     */
    public function show(Berkas $berkas)
    {
        $data = [
            "title" => berkas::find($berkas->berkas_nm),
            'page' => "Profil Berkas " . berkas::find($berkas->berkas_nm),
            'berkas' => berkas::find($berkas->id),
        ];

        return view($this->view . "single", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa, Berkas $berka)
    {
        $data = [
            "title" => "Berkas",
            'page' => 'Data Berkas Alumni Wearnes Madiun',
            "berkas" => $berka,
            'index' => $this->route($mahasiswa),
            'save' => $this->route($mahasiswa),
            'is_update' => true,
        ];
        // dd($berka);

        return view($this->view . "form", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berkas $berkas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa, Berkas $berkas)
    {
        $notif = [
            "type" => "success",
            "text" => "Data Berhasil Dihapus !"
        ];
        $berkas->delete();
        return redirect($this->route($mahasiswa))->with($notif);
    }
}