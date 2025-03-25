<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear usuario Admin si no existe
        User::firstOrCreate(
            ['email' => 'angelestrada12@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ]
        );

        // Crear otro usuario 
        User::firstOrCreate(
            ['email' => 'munguiachucho@gmail.com'],
            [
                'name' => 'jesus',
                'password' => Hash::make('12345678'),
                'role' => 'user',
            ]
        );
    }
}
