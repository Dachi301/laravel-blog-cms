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
        $adminRole = Role::create(['name' => RolesEnum::ADMIN->value]);
        $editorRole = Role::create(['name' => RolesEnum::EDITOR->value]);
        $authorRole = Role::create(['name' => RolesEnum::AUTHOR->value]);

        // Admin
        $manageUsers = Permission::create([
            'name' => PermissionsEnum::MANAGEUSERS->value
        ]);

        // Admin, Editor
        $manageAllArticles = Permission::create([
            'name' => PermissionsEnum::MANAGEALLARTICLES->value
        ]);

        // Admin, Editor
        $publishArticlesPermission = Permission::create([
            'name' => PermissionsEnum::PUBLISHARTICLES->value
        ]);

        // Admin, Editor
        $manageCategoriesTags = Permission::create([
            'name' => PermissionsEnum::MANAGECATEGORIESTAGS->value
        ]);

        // Admin
        $manageSiteSettings = Permission::create([
            'name' => PermissionsEnum::MANAGESITESETTINGS->value
        ]);

        // Admin, Editor
        $adminPanelAccessPermission = Permission::create([
            'name' => PermissionsEnum::ACCESSADMINPANEL->value
        ]);

        // Author
        $manageOwnArticles = Permission::create([
            'name' => PermissionsEnum::MANAGEOWNARTICLES->value
        ]);

        $adminRole->syncPermissions([
            $manageUsers,
            $manageAllArticles,
            $publishArticlesPermission,
            $manageCategoriesTags,
            $manageSiteSettings,
            $adminPanelAccessPermission
        ]);

        $editorRole->syncPermissions([
            $manageAllArticles,
            $publishArticlesPermission,
            $manageCategoriesTags,
            $adminPanelAccessPermission
        ]);

        $authorRole->syncPermissions([
            $manageOwnArticles,
            $publishArticlesPermission
        ]);
    }
}
