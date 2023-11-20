<?php

namespace Database\Seeders;

use App\Models\UserC;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User_t;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserC::created([
            'rpe' => '262000',
            'nombre' => 'Flores Gomez Alan Alexis'  
        ])->assignRole('Admin');
    }
}
