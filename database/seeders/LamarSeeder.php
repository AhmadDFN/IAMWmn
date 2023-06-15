<?php

namespace Database\Seeders;

use App\Models\Lamar;
use App\Models\Loker;
use App\Models\Mahasiswa;
use App\Models\Perusahaan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswas = Mahasiswa::all();
        $lokers = Loker::all();
        foreach ($mahasiswas as $mahasiswa) {
            $randomno = rand(1, 5);
            if ($randomno != 1) {
                foreach ($lokers as $loker) {
                    $randomper = rand(1, 4);
                    // if ($mahasiswa->mhs_kd_jurusan == $loker->loker_kd_jurusan) {
                    if (strpos($mahasiswa->mhs_kd_jurusan, $loker->loker_kd_jurusan) !== false) {
                        if ($randomper != 1) {
                            Lamar::factory()
                                ->count(1)
                                ->create([
                                    'lamar_nm' => $loker->loker_nm,
                                    'lamar_NIM' => $mahasiswa->mhs_NIM,
                                    'lamar_id_loker' => $loker->id
                                ]);
                        }
                    }
                }
            }
        };
    }
}
