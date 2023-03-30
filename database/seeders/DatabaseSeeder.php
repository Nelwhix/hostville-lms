<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Program::factory()->create([
            'title' => 'Computer Science',
            'description' => fake()->paragraph(),
            'cover_image' => '01GWQPY2R02JRKXMKZBANVM4X0.png',
            'duration' => 30
        ]);
        Program::factory()->create([
            'title' => 'Mechanical Engineering',
            'description' => fake()->paragraph(),
            'cover_image' => '01GWQEV6RZZJJW21R9NE6KYE0W.jpg',
            'duration' => 30
        ]);
        Program::factory()->create([
            'title' => 'Systems Engineering',
            'description' => fake()->paragraph(),
            'cover_image' => '01GWQEXW26PMCZ5R88CBWX74RG.jpg',
            'duration' => 30
        ]);
        $this->call([
            PermissionSeeder::class,
            AdminSeeder::class
        ]);
    }
}
