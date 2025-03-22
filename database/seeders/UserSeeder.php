<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com'
        ])->assignRole(RolesEnum::ADMIN->value);

        User::factory()->create([
            'name' => 'Editor',
            'email' => 'editor@example.com'
        ])->assignRole(RolesEnum::EDITOR->value);

        User::factory()->create([
            'name' => 'Author',
            'email' => 'author@example.com'
        ])->assignRole(RolesEnum::AUTHOR->value);
    }
}
