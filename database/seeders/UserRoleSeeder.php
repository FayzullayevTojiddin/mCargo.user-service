<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\UserRoleEnum;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        
        foreach (UserRoleEnum::cases() as $role) {
            \App\Models\UserRole::firstOrCreate([
                'code' => $role->value,
            ], [
                'name' => $role->label(),
            ]);
        }
    }
}
