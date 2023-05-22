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

        return [
            "berkas_kd" => $faker->isbn13(),
            "berkas_skck" => $faker->uuid(),
            "berkas_kk" => $faker->uuid(),
            "berkas_foto" => $faker->imageUrl(640, 480, "animals"),
            "berkas_cv" => $faker->uuid(),
            "berkas_ijazah" => $faker->uuid(),
        ];
    }
}
