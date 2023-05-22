<?php

namespace Database\Factories;

use Faker\Guesser\Name;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = fake('id_ID');
        $gender = $faker->randomElement(["male", "female"]);
        $th_masuk = $faker->randomElement(["2020", "2021", "2022", "2023"]);
        $kd_jurusan = $faker->randomElement(["310", "320", "330", "340", "350", "360"]);

        return [
            // "mhs_NIM" => $faker->unique()->$th_masuk . $kd_jurusan . rand($minra = 1, $maxra = 999),
            "mhs_NIM" => $th_masuk . $kd_jurusan . strval(rand(111, 999)),
            "mhs_nm" => $faker->name($gender),
            "mhs_email" => $faker->email(),
            "mhs_jk" => $gender == "male" ? 1 : 2,
            "mhs_notelp" => $faker->e164PhoneNumber(),
            "mhs_th_masuk" => $th_masuk,
            "mhs_th_lulus" => $th_masuk + 1,
            "mhs_kota_lahir" => $faker->city(),
            "mhs_tanggal_lahir" => $faker->dateTimeBetween($startDate = '-30 years', $endDate = '-18 years'),
            "mhs_alamat" => $faker->address(),
            "mhs_kota" => $faker->city(),
            "mhs_tb" => $faker->numberBetween($min = 150, $max = 190),
            "mhs_kd_jurusan" => $kd_jurusan,
        ];
    }
}
