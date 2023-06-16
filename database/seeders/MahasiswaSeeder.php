<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Database\Factories\MahasiswaFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 999; $i++) {
            $faker = fake('id_ID');
            $th_masuk = $faker->randomElement(["2020", "2021", "2022", "2023"]);
            $kd_jurusan = $faker->randomElement(["310", "320", "330", "340", "350", "360"]);
            $n = $i;
            if ($i < 10) {
                $n = "00" . $i;
            } else if ($i < 100) {
                $n = "0" . $i;
            } else {
                $n = $i;
            }
            Mahasiswa::Factory()
                ->count(1)
                ->create([
                    "mhs_NIM" => $th_masuk . $kd_jurusan . $n,
                    "mhs_th_masuk" => $th_masuk,
                    "mhs_th_lulus" => $th_masuk + 1,
                    "mhs_kd_jurusan" => $kd_jurusan,
                ]);
        }
    }
}
