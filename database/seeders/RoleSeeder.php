<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'role' => 'administrator'
        ]);
        Role::create([
            'role' => 'pengawas'
        ]);
        Role::create([
            'role' => 'user'
        ]);
        Role::create([
            'role' => 'kepala kantor'
        ]);
    }
}
