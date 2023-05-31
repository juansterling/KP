<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\matkul>
 */
class matkulFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            "idmatkul"=>"IN20". strval(fake()->unique()->numberBetween(101, 105)),
            "matkul"=> fake()->name(),
            "sks"=>fake()->numberBetween(1,9),
            "fksemester"=>fake()->unique()->numberBetween(1,10)
            //
        ];
    }
}
