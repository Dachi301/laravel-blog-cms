<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

use Spatie\Tags\HasTags;

class Article extends Model implements HasMedia
{
    use InteractsWithMedia, HasTags;

//    protected $casts = [
//        'tags' => 'array',
//    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('articles')
            ->useDisk('public') // or whatever disk you're using
            ->singleFile(); // if each article should have only one image
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function sub_category(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }
}
