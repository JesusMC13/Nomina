<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {


        $user = new User;
        $user->name = 'Admin';
        $user->email = 'angelestrada12@gmail.com';
        $user->password = '1234568';
        $user->role = 'admin';

        $user->save();
        
    }
}
