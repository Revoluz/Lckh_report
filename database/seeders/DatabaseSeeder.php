<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Document_types;
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
        Document_types::create([
            'name' => 'KGB'
        ]);
        Document_types::create([
            'name' => 'PAK'
        ]);
        User::create([
            'name' => 'admin',
            'nip' => '12345678',
            'work_place_id' => '1',
            'image' => '34233',
            'status_id' => '1',
            'role_id' => '1',
            'password' => '12345678',
        ]);
        User::create([
            'name' => 'user',
            'nip' => '1234567',
            'work_place_id' => '1',
            'image' => '34233',
            'status_id' => '1',
            'role_id' => '3',
            'password' => '12345678',
        ]);
        User::create([
            'name' => 'pengawas',
            'nip' => '123456',
            'work_place_id' => '1',
            'image' => '34233',
            'status_id' => '1',
            'role_id' => '2',
            'password' => '12345678',
        ]);
        User::create([
            'name' => 'kepala kantor',
            'nip' => '12345',
            'work_place_id' => '1',
            'image' => '34233',
            'status_id' => '1',
            'role_id' => '4',
            'password' => '12345678',
        ]);
    }
}
