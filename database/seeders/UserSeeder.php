<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('123123123'),
                'email_verified_at' => now()
            ]
        );
        $admin->assignRole(RolesEnum::ADMIN->value);

        $editor = User::firstOrCreate(
            ['email' => 'editor@example.com'],
            [
                'name' => 'Editor',
                'password' => Hash::make('123123123'),
                'email_verified_at' => now()
            ]
        );
        $editor->assignRole(RolesEnum::EDITOR->value);

        $author = User::firstOrCreate(
            ['email' => 'author@example.com'],
            [
                'name' => 'Author',
                'password' => Hash::make('123123123'),
                'email_verified_at' => now()
            ]
        );
        $author->assignRole(RolesEnum::AUTHOR->value);
    }
}
