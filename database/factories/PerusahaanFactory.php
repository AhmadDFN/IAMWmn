<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Perusahaan>
 */
class PerusahaanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = fake('id_ID');
        $nama1 = $faker->randomElement(["PT", "CV"]);
        $nama2 = $faker->randomElement(["Terpadu", "Terdepan", "Pernaugan", "Barokah", "Persatuan"]);
        $nama3 = $faker->randomElement(["Pergerakan", "Persero", "Mitsubishi", "Japan", "Group"]);

        return [
            // "mhs_NIM" => $faker->unique()->$th_masuk . $kd_jurusan . rand($minra = 1, $maxra = 999),
            "perusahaan_nm" => $nama1 . " " . $nama2 . " " . $nama3,
            "perusahaan_alamat" => $faker->address(),
            "perusahaan_kota" => strtoupper($faker->city()),
            "perusahaan_notelp" => $faker->phoneNumber(),
            "perusahaan_email" => $faker->companyEmail(),
            "perusahaan_website" => $nama1 . $nama2 . ".com",
            "perusahaan_cp_nama" => $faker->name(),
            "perusahaan_cp_notelp" => $faker->e164PhoneNumber(),
            "perusahaan_foto" => $faker->image("public/uploads/perusahaan/foto", 640, 480),
        ];
    }
}
