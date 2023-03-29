<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'firstName' => 'Nelson',
            'lastName' => 'Isioma',
            'phone' => '+2349016607485',
            'email' => 'admin@email.com',
            'password' => Hash::make('password')
        ])->assignRole('admin');
    }
}
