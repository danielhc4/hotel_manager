<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Shift;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password123'),
        ]);

        // Call's Shift seeder
        $this->call(ShiftSeeder::class);

        // Call's Department seeder
        $this->call(DepartmentSeeder::class);

        // Call's Employee seeder
        $this->call(EmployeeSeeder::class);

        // Call's Activity seeder
        $this->call(ActivitySeeder::class);
    }
}
