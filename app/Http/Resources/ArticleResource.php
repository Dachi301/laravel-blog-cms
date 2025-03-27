<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $media = $this->getFirstMedia();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'category' => $this->category->name ?? null,
            'sub_category' => $this->sub_category->name ?? null,
            'status' => $this->status,
            'tags' => $this->tags->pluck('name'),
            'image' => $media ? $media->original_url : null,
            'image_preview' => $media ? $media->getUrl('preview') : null,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
