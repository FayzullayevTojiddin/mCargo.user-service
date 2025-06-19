<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserRoleSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'phone' => '+998901234567',
            'password' => bcrypt('password'),
            'role_id' => 1,
        ]);
    }
}
