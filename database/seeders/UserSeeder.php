<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Exventory',
            'last_name' => 'admin',
            'email' => 'exventoryadmin@gmail.com',
            'password' => Hash::make('123456789')
        ]);

        $user->assignRole('super-admin');
    }
}
