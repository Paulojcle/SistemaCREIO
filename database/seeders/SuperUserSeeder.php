<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            [
                'email' => 'admin@gmail.com',            
            ],

            [
                'firstName' => 'Paulo',
                'lastName' => 'José',
                'password'=> Hash::make('123456'),
            ]
        );
    }
}