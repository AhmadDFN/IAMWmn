<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ManualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data User
        DB::table('users')->insert([
            "username" => "superadmin",
            "email" => "superadmin@gmail.com",
            "email_verified_at" => date("Y-m-d h:i:s"),
            "password" => Hash::make("admin"),
            "nama" => "SuperAdministrator",
            "role" => "SuperAdmin",
            "Status" => 1,
            "remember_token" => Str::random(10),
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);

        DB::table('users')->insert([
            "username" => "admin",
            "email" => "admin@gmail.com",
            "email_verified_at" => date("Y-m-d h:i:s"),
            "password" => Hash::make("admin"),
            "nama" => "Administrator",
            "role" => "Admin",
            "Status" => 1,
            "remember_token" => Str::random(10),
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);

        DB::table('users')->insert([
            "username" => "fian",
            "email" => "fian@gmail.com",
            "email_verified_at" => date("Y-m-d h:i:s"),
            "password" => Hash::make("fian123"),
            "nama" => "Allifian",
            "role" => "Mahasiswa",
            "Status" => 1,
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
            "mhs_kota_lahir" => "Ngawi",
            "mhs_tanggal_lahir" => date("2002-11-27"),
            "mhs_alamat" => "Kedunggalar Ngawi",
            "mhs_kota" => "Madiun",
            "mhs_tb" => "178",
            "mhs_bb" => "60",
            "mhs_kd_jurusan" => "330",
            "mhs_id_user" => 2,
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);

        // Data Berkas
        DB::table('berkas')->insert([
            "berkas_kd" => Str::random(10),
            "berkas_skck" => "None",
            "berkas_kk" => "None",
            "berkas_ijazah" => "None",
            "berkas_foto" => "None",
            "berkas_cv" => "None",
            "berkas_NIM" => "2022320164",
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
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);
        DB::table('jurusans')->insert([
            "jurusan_kd" => "320",
            "jurusan_nm" => "Inforkom",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);
        DB::table('jurusans')->insert([
            "jurusan_kd" => "330",
            "jurusan_nm" => "Kasima Pr",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);
        DB::table('jurusans')->insert([
            "jurusan_kd" => "340",
            "jurusan_nm" => "Degrakom",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);
        DB::table('jurusans')->insert([
            "jurusan_kd" => "350",
            "jurusan_nm" => "Komputer Pajar",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);
        DB::table('jurusans')->insert([
            "jurusan_kd" => "360",
            "jurusan_nm" => "Digital Marketing",
            "created_at" => date("Y-m-d h:i:s"),
            "updated_at" => date("Y-m-d h:i:s")
        ]);
        //
    }
}
