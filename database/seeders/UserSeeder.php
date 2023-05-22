<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswas = Mahasiswa::all();
        foreach ($mahasiswas as $mahasiswa) {
            User::factory()
                ->count(1)
                ->create([
                    'email' => $mahasiswa->mhs_email,
                    'password' => md5($mahasiswa->mhs_NIM),
                    'nama' => $mahasiswa->mhs_nm,
                ]);
        };
    }
}
