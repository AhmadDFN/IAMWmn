<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Perusahaan;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perusahaans = Perusahaan::all();
        foreach ($perusahaans as $perusahaan) {
            User::factory()
                ->count(1)
                ->create([
                    'reff' => $perusahaan->id,
                    'email' => $perusahaan->perusahaan_email,
                    'password' => Hash::make("adminperusahaan"),
                    'name' => $perusahaan->perusahaan_nm,
                    'foto' => $perusahaan->perusahaan_foto
                ]);
        };
    }
}
