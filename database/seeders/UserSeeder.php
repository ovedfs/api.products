<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Adela Torres',
            'email' => 'adela@gmail.com',
            'password' => Hash::make('password'),
        ])->assignRole('user');
        
        User::create([
            'name' => 'Pedro Luna',
            'email' => 'pedro@gmail.com',
            'password' => Hash::make('password'),
        ])->assignRole('admin');
        
        User::create([
            'name' => 'Sofia Prado',
            'email' => 'sofia@gmail.com',
            'password' => Hash::make('password'),
        ])->assignRole('superadmin');
    }
}
