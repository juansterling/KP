<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('studios')->insert([
            "theater_id"=>"2",
            "jenis_studio"=>"3D",
            "studio"=>2,
        ]);
        DB::table('studios')->insert([
            "theater_id"=>"3",
            "jenis_studio"=>"4X",
            "studio"=>6,
        ]);
    }
}
