<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = fake('id_ID');

        // Data User
        DB::table('users')->insert([
            "email" => "superadmin@gmail.com",
            "email_verified_at" => date("Y-m-d h:i:s"),
            "password" => Hash::make("admin"),
            "name" => "SuperAdministrator",
            "role" => "SuperAdmin",
            "status" => 1,
            "remember_token" => Str::random(10),
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);

        DB::table('users')->insert([
            "email" => "admin@gmail.com",
            "email_verified_at" => date("Y-m-d h:i:s"),
            "password" => Hash::make("admin"),
            "name" => "Administrator",
            "role" => "Admin",
            "Status" => 1,
            "remember_token" => Str::random(10),
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);

        DB::table('users')->insert([
            "email" => "fian@gmail.com",
            "email_verified_at" => date("Y-m-d h:i:s"),
            "password" => Hash::make("20021127"),
            "name" => "Allifian",
            "role" => "Mahasiswa",
            "reff" => "2022320164",
            "status" => 1,
            "remember_token" => Str::random(10),
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);

        // Data Mahasiswa

        DB::table('mahasiswas')->insert([
            "mhs_NIM" => "2022320164",
            "mhs_nm" => "Allifian Witama Putra",
            "mhs_email" => "fian@gmail.com",
            "mhs_jk" => 1,
            "mhs_notelp" => "0895215354845",
            "mhs_th_masuk" => "2022",
            "mhs_th_lulus" => "2023",
            "mhs_kota_lahir" => "MADIUN",
            "mhs_tanggal_lahir" => date("2002-11-27"),
            "mhs_alamat" => "Kedunggalar Ngawi",
            "mhs_kota" => "MADIUN",
            "mhs_status" => 2,
            "mhs_tb" => "178",
            "mhs_bb" => "60",
            "mhs_foto" => $faker->image("public/uploads/berkas/foto", 640, 480),
            "mhs_kd_jurusan" => "320",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);

        DB::table('mahasiswas')->insert([
            "mhs_NIM" => "2022320264",
            "mhs_nm" => "Aditya Ramatullah Yoga Pratama",
            "mhs_email" => "rama@gmail.com",
            "mhs_jk" => 1,
            "mhs_notelp" => "088888888888",
            "mhs_th_masuk" => "2023",
            "mhs_th_lulus" => "2024",
            "mhs_kota_lahir" => "MADIUN",
            "mhs_tanggal_lahir" => date("2000-01-13"),
            "mhs_alamat" => "Merak Madiun",
            "mhs_kota" => "MADIUN",
            "mhs_status" => 1,
            "mhs_tb" => "148",
            "mhs_bb" => "120",
            "mhs_foto" => $faker->image("public/uploads/berkas/foto", 640, 480),
            "mhs_kd_jurusan" => "320",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);

        DB::table('mahasiswas')->insert([
            "mhs_NIM" => "2022320075",
            "mhs_nm" => "Ahmad Dany Fathin Nawwaf",
            "mhs_email" => "danyahmadadfn@gmail.com",
            "mhs_jk" => 1,
            "mhs_notelp" => "0895352882228",
            "mhs_th_masuk" => "2022",
            "mhs_th_lulus" => "2023",
            "mhs_kota_lahir" => "MADIUN",
            "mhs_tanggal_lahir" => date("1999-03-20"),
            "mhs_alamat" => "JL Merak Madiun",
            "mhs_kota" => "MADIUN",
            "mhs_status" => 1,
            "mhs_tb" => "168",
            "mhs_bb" => "50",
            "mhs_foto" => $faker->image("public/uploads/berkas/foto", 640, 480),
            "mhs_kd_jurusan" => "320",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);

        DB::table('mahasiswas')->insert([
            "mhs_NIM" => "2021200200",
            "mhs_nm" => "Aditya Wildan E",
            "mhs_email" => "adityawa22@gmail.com",
            "mhs_jk" => 1,
            "mhs_notelp" => "0812351351351",
            "mhs_th_masuk" => "2021",
            "mhs_th_lulus" => "2022",
            "mhs_kota_lahir" => "MADIUN",
            "mhs_tanggal_lahir" => date("2002-11-11"),
            "mhs_alamat" => "JL Merak Madiun",
            "mhs_kota" => "MADIUN",
            "mhs_status" => 1,
            "mhs_tb" => "168",
            "mhs_bb" => "50",
            "mhs_foto" => $faker->image("public/uploads/berkas/foto", 640, 480),
            "mhs_kd_jurusan" => "320",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);

        DB::table('mahasiswas')->insert([
            "mhs_NIM" => "2022320064",
            "mhs_nm" => "Aliffian Witama Putra",
            "mhs_email" => "aliffianwitama26@gmail.com",
            "mhs_jk" => 1,
            "mhs_notelp" => "085731718506",
            "mhs_th_masuk" => "2022",
            "mhs_th_lulus" => "2023",
            "mhs_kota_lahir" => "MADIUN",
            "mhs_tanggal_lahir" => date("2002-11-27"),
            "mhs_alamat" => "JL Raya Kedunggalar Rt.3 Rw.2",
            "mhs_kota" => "MADIUN",
            "mhs_status" => 1,
            "mhs_tb" => "175",
            "mhs_bb" => "49",
            "mhs_foto" => $faker->image("public/uploads/berkas/foto", 640, 480),
            "mhs_kd_jurusan" => "320",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);

        // Data Berkas
        DB::table('berkas')->insert([
            "berkas_kd" => $faker->isbn13(),
            "berkas_skck" => $faker->uuid(),
            "berkas_kk" => $faker->uuid(),
            "berkas_foto" => $faker->image("public/uploads/berkas/foto", 640, 480),
            "berkas_cv" => $faker->uuid(),
            "berkas_ijazah" => $faker->uuid(),
            "berkas_NIM" => "2022320064",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);
        DB::table('berkas')->insert([
            "berkas_kd" => $faker->isbn13(),
            "berkas_skck" => $faker->uuid(),
            "berkas_kk" => $faker->uuid(),
            "berkas_foto" => $faker->image("public/uploads/berkas/foto", 640, 480),
            "berkas_cv" => $faker->uuid(),
            "berkas_ijazah" => $faker->uuid(),
            "berkas_NIM" => "2021200200",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);
        DB::table('berkas')->insert([
            "berkas_kd" => $faker->isbn13(),
            "berkas_skck" => $faker->uuid(),
            "berkas_kk" => $faker->uuid(),
            "berkas_foto" => $faker->image("public/uploads/berkas/foto", 640, 480),
            "berkas_cv" => $faker->uuid(),
            "berkas_ijazah" => $faker->uuid(),
            "berkas_NIM" => "2022320164",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);
        DB::table('berkas')->insert([
            "berkas_kd" => $faker->isbn13(),
            "berkas_skck" => $faker->uuid(),
            "berkas_kk" => $faker->uuid(),
            "berkas_foto" => $faker->image("public/uploads/berkas/foto", 640, 480),
            "berkas_cv" => $faker->uuid(),
            "berkas_ijazah" => $faker->uuid(),
            "berkas_NIM" => "2022320264",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);
        DB::table('berkas')->insert([
            "berkas_kd" => $faker->isbn13(),
            "berkas_skck" => $faker->uuid(),
            "berkas_kk" => $faker->uuid(),
            "berkas_foto" => $faker->image("public/uploads/berkas/foto", 640, 480),
            "berkas_cv" => $faker->uuid(),
            "berkas_ijazah" => $faker->uuid(),
            "berkas_NIM" => "2022320075",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);

        // Data Perusahaan
        DB::table('perusahaans')->insert([
            "perusahaan_nm" => "PT_Cikarang",
            "perusahaan_alamat" => "JL. Perumnas roro lor No 18 Perkutut",
            "perusahaan_kota" => "Cikarang",
            "perusahaan_notelp" => "0351 757315",
            "perusahaan_email" => "pt_cikarang@gmail.com",
            "perusahaan_website" => "Cikarangable.com",
            "perusahaan_cp_nama" => "Mr. Yukanto",
            "perusahaan_cp_notelp" => "0810548464684",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);

        // Jenis Loker
        DB::table('jenis_lokers')->insert([
            "jenis_loker_nm" => "Full Time",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);
        DB::table('jenis_lokers')->insert([
            "jenis_loker_nm" => "Part Time",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);
        DB::table('jenis_lokers')->insert([
            "jenis_loker_nm" => "Remote",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);

        // Jurusan
        DB::table('jurusans')->insert([
            "jurusan_kd" => "310",
            "jurusan_nm" => "Kabab Exim",
            "jurusan_kda" => "KE",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);
        DB::table('jurusans')->insert([
            "jurusan_kd" => "320",
            "jurusan_nm" => "Inforkom",
            "jurusan_kda" => "IK",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);
        DB::table('jurusans')->insert([
            "jurusan_kd" => "330",
            "jurusan_nm" => "Kasima Pr",
            "jurusan_kda" => "KS",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);
        DB::table('jurusans')->insert([
            "jurusan_kd" => "340",
            "jurusan_nm" => "Degrakom",
            "jurusan_kda" => "DK",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);
        DB::table('jurusans')->insert([
            "jurusan_kd" => "350",
            "jurusan_nm" => "Komputer Pajak",
            "jurusan_kda" => "KP",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);
        DB::table('jurusans')->insert([
            "jurusan_kd" => "360",
            "jurusan_nm" => "Digital Marketing",
            "jurusan_kda" => "DM",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);
        //
    }
}
