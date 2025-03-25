<?php

namespace App\Enums;

enum RolesEnum: string
{
    case ADMIN = 'admin';
    case EDITOR = 'editor';
    case AUTHOR = 'author';
    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::EDITOR => 'Editor',
            self::AUTHOR => 'Author',
        };
    }
}
