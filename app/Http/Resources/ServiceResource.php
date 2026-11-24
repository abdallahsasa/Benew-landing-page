<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name_en' => $this->name_en,
            'name_ar' => $this->name_ar,
            'category' => $this->category,
            'short_description_en' => $this->short_description_en,
            'short_description_ar' => $this->short_description_ar,
            'display_order' => $this->display_order,
            'case_images' => CaseImageResource::collection($this->whenLoaded('caseImages')),
        ];
    }
}
