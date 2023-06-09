<?php

namespace Database\Seeders;

use App\Models\semester;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class semesterseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $semester = semester::factory()->count(5)->make();

        foreach($semester as $item){
            $item->save();
        }
    }
}
