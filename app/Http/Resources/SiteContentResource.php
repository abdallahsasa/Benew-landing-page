<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteContentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'section_key' => $this->section_key,
            'title_en' => $this->title_en,
            'title_ar' => $this->title_ar,
            'subtitle_en' => $this->subtitle_en,
            'subtitle_ar' => $this->subtitle_ar,
            'body_en' => $this->body_en,
            'body_ar' => $this->body_ar,
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
