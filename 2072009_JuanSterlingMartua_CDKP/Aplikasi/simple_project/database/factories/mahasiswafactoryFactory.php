<?php

namespace Database\Factories;
use App\Models\mahasiswa;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class mahasiswafactoryFactory extends Factory
{
    protected $model= mahasiswa::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nrp"=>"2072". strval(fake()->unique()->numerify("###")),
            "nama"=> fake()->name(),
            "fkmatkul"=>"IN20". strval(fake()->numberBetween(101, 105))
            //
        ];
    }
}
