<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Carbon;
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
            $tanggalObj = Carbon::createFromFormat('Y-m-d', $mahasiswa->mhs_tanggal_lahir);
            $tanggalText = $tanggalObj->format('dmY');
            User::factory()
                ->count(1)
                ->create([
                    'email' => $mahasiswa->mhs_email,
                    'password' => md5($tanggalText),
                    'name' => $mahasiswa->mhs_nm,
                ]);
        };
    }
}
