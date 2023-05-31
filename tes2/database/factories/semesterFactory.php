<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\semester>
 */
class semesterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sems = fake()->unique()->numberBetween(1,10);
        return[
        
            "idsemester"=>$sems,
            "semester"=> $sems
            //
        ];
    }
}
