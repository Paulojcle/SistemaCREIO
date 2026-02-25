<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'firstName' => 'Paulo José',
            'lastName' => 'Pereira Trindade',
            'email' => 'paulo@gmail.com',
            'password' => bcrypt('P@ulo123'),
        ]);
    }
}
