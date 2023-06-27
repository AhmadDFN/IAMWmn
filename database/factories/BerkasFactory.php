<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Berkas>
 */
class BerkasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = fake('id_ID');
        $randomisi = $faker->randomElement([null, $faker->uuid()]);
        $ktp = $faker->randomElement([null, $faker->uuid()]);
        $skck = $faker->randomElement([null, $faker->uuid()]);
        $kk = $faker->randomElement([null, $faker->uuid()]);
        $cv = $faker->randomElement([null, $faker->uuid()]);
        $ijazah = $faker->randomElement([null, $faker->uuid()]);

        return [
            "berkas_kd" => $faker->isbn13(),
            "berkas_ktp" => $ktp,
            "berkas_skck" => $skck,
            "berkas_kk" => $kk,
            // "berkas_foto" => $faker->image("public/uploads/berkas/foto", 640, 480),
            "berkas_cv" => $cv,
            "berkas_ijazah" => $ijazah,
        ];
    }
}
