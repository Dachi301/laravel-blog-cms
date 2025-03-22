<?php

namespace App\Enums;

enum PermissionsEnum: string
{
    // Only Admin
    case MANAGEUSERS = 'manage-users';
    // Admin, Editor
    case MANAGEALLARTICLES = 'manage-all-articles';
    // Admin, Editor
    case PUBLISHARTICLES = 'publish-articles';
    // Admin, Editor
    case MANAGECATEGORIESTAGS = 'manage-categories-tags';
    // Only Author
    case MANAGEOWNARTICLES = 'manage-own-articles';
}
