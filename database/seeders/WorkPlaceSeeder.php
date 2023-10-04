<?php

namespace Database\Seeders;

use App\Models\Work_place;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Work_place::create([
            'work_place' => 'Sub Bagian TU'
        ]);
        Work_place::create([
            'work_place' => 'Seksi PD Pontren'
        ]);
        Work_place::create([
            'work_place' => 'Seksi PAIS'
        ]);
    }
}
