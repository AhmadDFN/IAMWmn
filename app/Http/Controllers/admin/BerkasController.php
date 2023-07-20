<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\Berkas;
use App\Models\Mahasiswa;
use Illuminate\Support\Str;
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
        $nimterakhir = substr($mahasiswa->mhs_NIM, -3);
        if ($request->file("berkas_foto")) {
            $fileName = time() . $nimterakhir . "F-" . Str::random(6) . '.' . $request->file("berkas_foto")->extension();
            $result1 = $request->file("berkas_foto")->move(public_path('uploads/berkas/foto'), $fileName);
            $berkas_foto = "uploads/berkas/foto/" . $fileName;
        } else {
            $berkas_foto = $request->input("old_foto");
        }

        if ($request->file("berkas_cv")) {
            $fileName = time() . $nimterakhir . "C-" . Str::random(6) . '.' . $request->file("berkas_cv")->extension();
            $result2 = $request->file("berkas_cv")->move(public_path('uploads/berkas/cv'), $fileName);
            $berkas_cv = "uploads/berkas/cv/" . $fileName;
        } else {
            $berkas_cv = $request->input("old_cv");
        }

        if ($request->file("berkas_skck")) {
            $fileName = time() . $nimterakhir . "S-" . Str::random(6) . '.' . $request->file("berkas_skck")->extension();
            $result3 = $request->file("berkas_skck")->move(public_path('uploads/berkas/skck'), $fileName);
            $berkas_skck = "uploads/berkas/skck/" . $fileName;
        } else {
            $berkas_skck = $request->input("old_skck");
        }

        if ($request->file("berkas_kk")) {
            $fileName = time() . $nimterakhir . "K-" . Str::random(6) . '.' . $request->file("berkas_kk")->extension();
            $result4 = $request->file("berkas_kk")->move(public_path('uploads/berkas/kk'), $fileName);
            $berkas_kk = "uploads/berkas/kk/" . $fileName;
        } else {
            $berkas_kk = $request->input("old_kk");
        }

        if ($request->file("berkas_ijazah")) {
            $fileName = time() . $nimterakhir . "I-" . Str::random(6) . '.' . $request->file("berkas_ijazah")->extension();
            $result5 = $request->file("berkas_ijazah")->move(public_path('uploads/berkas/ijazah'), $fileName);
            $berkas_ijazah = "uploads/berkas/ijazah/" . $fileName;
        } else {
            $berkas_ijazah = $request->input("old_ijazah");
        }
        if ($request->file("berkas_ktp")) {
            $fileName = time() . $nimterakhir . "KT-" . Str::random(6) . '.' . $request->file("berkas_ktp")->extension();
            $result5 = $request->file("berkas_ktp")->move(public_path('uploads/berkas/ktp'), $fileName);
            $berkas_ktp = "uploads/berkas/ktp/" . $fileName;
        } else {
            $berkas_ktp = $request->input("old_ktp");
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
                    "berkas_ktp" => $berkas_ktp,
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
    public function show(Mahasiswa $mahasiswa, Berkas $berka)
    {
        $data = (object)[
            'title' => $mahasiswa->mhs_nm . " Berkas",
            'page' => "Berkas " . $mahasiswa->mhs_nm,
        ];
        $berkas = $berka;
        $progress = 0;
        if ($berkas->berkas_kk !== null) {
            $progress++;
        }
        if ($berkas->berkas_skck !== null) {
            $progress++;
        }
        if ($berkas->berkas_cv !== null) {
            $progress++;
        }
        if ($berkas->berkas_foto !== null) {
            $progress++;
        }
        if ($berkas->berkas_ijazah !== null) {
            $progress++;
        }
        if ($berkas->berkas_ktp !== null) {
            $progress++;
        }
        $title = "Berkas";
        return view($this->view . 'show', compact('berkas', 'data', 'title', 'mahasiswa', 'progress'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa, Berkas $berka)
    {
        $data = [
            "title" => "Berkas",
            'page' => 'Data Berkas Alumni Bopi Madiun',
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

    /**
     * Remove the specified resource from storage.
     */
    public function BerkasNew(Mahasiswa $mahasiswa)
    {
        $notif = [
            "type" => "success",
            "text" => "Data Berhasil Dihapus !"
        ];
        $faker = fake('id_ID');

        $kirim = [
            "berkas_kd" => $faker->isbn13(),
            "berkas_NIM" => $mahasiswa->mhs_NIM,
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s"),
        ];

        // dd($kirim);

        Berkas::create($kirim);
        return redirect($this->route($mahasiswa))->with($notif);
    }
}
