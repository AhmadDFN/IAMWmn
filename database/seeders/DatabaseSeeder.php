<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Mahasiswa;
use Illuminate\Support\Str;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;
use Database\Seeders\LokerSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(MahasiswaSeeder::class);
        $this->call(PerusahaanSeeder::class);
        $this->call(BerkasSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ManualSeeder::class);
        $this->call(LokerSeeder::class);

        DB::table('berkas')
            ->where('berkas_foto', 'LIKE', 'public/%')
            ->update(['berkas_foto' => DB::raw("REPLACE(berkas_foto, 'public/', '')")]);

        DB::table('mahasiswas')
            ->where('mhs_foto', 'LIKE', 'public/%')
            ->update(['mhs_foto' => DB::raw("REPLACE(mhs_foto, 'public/', '')")]);





        // Mahasiswa::factory(10)->create();

        // for ($i=1; $i <= 6; $i++){
        //     DB::table('tb_jurusan')->insert([
        //         "jurusan_kd" => "3".$i."0",
        //         "jurusan_nm" => "Digital Marketing",
        //         "created_at" => date("Y-m-d h:i:s"),
        //         "updated_at" => date("Y-m-d h:i:s")
        //     ]);
        // }


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
