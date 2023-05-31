<?php

namespace Database\Seeders;

use App\Models\matkul;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class matkulseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $matkul = matkul::factory()->count(5)->make();

        foreach($matkul as $item){
            $item->save();
        }
    }
}
