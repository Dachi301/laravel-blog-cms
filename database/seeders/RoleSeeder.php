<?php

namespace Database\Seeders;

use App\Enums\PermissionsEnum;
use App\Enums\RolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => RolesEnum::ADMIN->value]);
        $editorRole = Role::firstOrCreate(['name' => RolesEnum::EDITOR->value]);
        $authorRole = Role::firstOrCreate(['name' => RolesEnum::AUTHOR->value]);

        // Admin
        $manageUsers = Permission::firstOrCreate([
            'name' => PermissionsEnum::MANAGEUSERS->value
        ]);

        // Admin, Editor
        $manageAllArticles = Permission::firstOrCreate([
            'name' => PermissionsEnum::MANAGEALLARTICLES->value
        ]);

        // Admin, Editor
        $publishArticlesPermission = Permission::firstOrCreate([
            'name' => PermissionsEnum::PUBLISHARTICLES->value
        ]);

        // Admin, Editor
        $manageCategoriesTags = Permission::firstOrCreate([
            'name' => PermissionsEnum::MANAGECATEGORIESTAGS->value
        ]);

        // Author
        $manageOwnArticles = Permission::firstOrCreate([
            'name' => PermissionsEnum::MANAGEOWNARTICLES->value
        ]);

        $adminRole->syncPermissions([
            $manageUsers,
            $manageAllArticles,
            $publishArticlesPermission,
            $manageCategoriesTags
        ]);

        $editorRole->syncPermissions([
            $manageAllArticles,
            $publishArticlesPermission,
            $manageCategoriesTags
        ]);

        $authorRole->syncPermissions([
            $manageOwnArticles,
            $publishArticlesPermission
        ]);
    }
}
