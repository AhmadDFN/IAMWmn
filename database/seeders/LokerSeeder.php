<?php

namespace Database\Seeders;

use App\Models\Loker;
use App\Models\Perusahaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LokerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perusahaans = Perusahaan::all();
        foreach ($perusahaans as $perusahaan) {
            $randomno = rand(1, 5);
            if ($randomno != 1) {
                Loker::factory()
                    ->count(rand(1, 3))
                    ->create([
                        'loker_nm' => $perusahaan->perusahaan_nm . " Lowongan Kerja" . " " . rand(1, 10),
                        'loker_id_perusahaan' => $perusahaan->id
                    ]);
            }
        };
    }
}
