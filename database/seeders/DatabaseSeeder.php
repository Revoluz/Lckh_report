<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use App\Models\Status;
use App\Models\Work_place;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Role::create([
            'role' => 'Administrator'
        ]);
        Role::create([
            'role' => 'Pengawas'
        ]);
        Role::create([
            'role' => 'User'
        ]);
        Role::create([
            'role' => 'Kepala kantor'
        ]);
        Status::create([
            'status' => 'Aktif'
        ]);
        Status::create([
            'status' => 'Tidak aktif'
        ]);
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