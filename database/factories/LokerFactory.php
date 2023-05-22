<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loker>
 */
class LokerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = fake('id_ID');
        $kd_jurusan = $faker->randomElement(["310", "320", "330", "340", "350", "360"]);
        $randomjns = $faker->randomElement(['1', '2', '3']);

        return [
            "loker_kd" => $faker->isbn13(),
            "loker_nm" => $faker->name(),
            "loker_ket" => $faker->paragraphs(2),
            "loker_exp" => $faker->dateTimeThisMonth('+14 days'),
            "loker_kd_jurusan" => $kd_jurusan,
            "loker_status" => 1,
            "loker_id_perusahaan" => $faker->randomNumber(2),
            "loker_id_jnsloker" => $randomjns,
        ];
    }
}
