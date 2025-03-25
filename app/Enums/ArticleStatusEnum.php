<?php

namespace App\Enums;

enum ArticleStatusEnum: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';

    public static function labels(): array
    {
        return [
            self::DRAFT->value => __('Draft'),
            self::PUBLISHED->value => __('Published'),
        ];
    }

    public static function colors(): array
    {
        return [
            'gray' => self::DRAFT->value,
            'success' => self::PUBLISHED->value
        ];
    }

    // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
    public function label(): string
    {
        return match ($this) {
            static::DRAFT => 'Draft',
            static::PUBLISHED => 'Published'
        };
    }
}
