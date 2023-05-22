<?php

namespace Database\Seeders;

use App\Models\Berkas;
use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BerkasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswas = Mahasiswa::all();
        foreach ($mahasiswas as $mahasiswa) {
            Berkas::factory()
                ->count(1)
                ->create([
                    'berkas_NIM' => $mahasiswa->mhs_NIM,
                ]);
        };
    }
}
