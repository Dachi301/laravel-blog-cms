<?php

namespace App\Enums;

enum RolesEnum: string
{
    case ADMIN = 'admin';
    case EDITOR = 'editor';
    case AUTHOR = 'author';
}
