<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Database\Seeders\LokerSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    protected function hapusdirectory()
    {
        $folderPath = public_path('uploads');

        if (File::exists($folderPath)) {
            File::deleteDirectory($folderPath);
        }
    }

    protected function buatdirectory()
    {
        $baseFolderPath = public_path('uploads/berkas');

        $subfolders = ['foto', 'cv', 'pdf', 'ijazah', 'kk', 'skck', 'ktp'];

        foreach ($subfolders as $subfolder) {
            $folderPath = $baseFolderPath . '/' . $subfolder;

            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true);
            }
        }

        if (!File::exists(public_path("uploads/perusahaan/foto"))) {
            File::makeDirectory(public_path("uploads/perusahaan/foto"), 0755, true);
        }

        if (!File::exists(public_path("uploads/profile/foto"))) {
            File::makeDirectory(public_path("uploads/profile/foto"), 0755, true);
        }
    }
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->hapusdirectory();
        $this->buatdirectory();

        $this->call(provinsisCSV::class);
        $this->call(kotasCSV::class);
        $this->call(kecamatansCSV::class);
        $this->call(MahasiswaSeeder::class);
        $this->call(PerusahaanSeeder::class);
        $this->call(BerkasSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ManualSeeder::class);
        $this->call(LokerSeeder::class);
        $this->call(LamarSeeder::class);

        DB::table('berkas')
            ->where('berkas_foto', 'LIKE', 'public/%')
            ->update(['berkas_foto' => DB::raw("REPLACE(berkas_foto, 'public/', '')")]);

        DB::table('perusahaans')
            ->where('perusahaan_foto', 'LIKE', 'public/%')
            ->update(['perusahaan_foto' => DB::raw("REPLACE(perusahaan_foto, 'public/', '')")]);

        DB::table('mahasiswas')
            ->where('mhs_foto', 'LIKE', 'public/%')
            ->update(['mhs_foto' => DB::raw("REPLACE(mhs_foto, 'public/', '')")]);

        DB::table('mahasiswas')
            ->whereNotNull('mhs_kota')
            ->update(['mhs_kota' => DB::raw("CONCAT('KOTA ', mhs_kota)")]);

        DB::table('mahasiswas')
            ->whereNotNull('mhs_kota_lahir')
            ->update(['mhs_kota_lahir' => DB::raw("CONCAT('KOTA ', mhs_kota_lahir)")]);

        DB::table('perusahaans')
            ->whereNotNull('perusahaan_kota')
            ->update(['perusahaan_kota' => DB::raw("CONCAT('KOTA ', perusahaan_kota)")]);

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
