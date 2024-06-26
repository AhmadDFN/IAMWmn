<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lamar>
 */
class LamarFactory extends Factory
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
            "lamar_kd" => $faker->isbn13(),
            "lamar_tgl_daftar" => $faker->date($format = 'Y-m-d', $max = '-8 weeks'),
        ];
    }
}
