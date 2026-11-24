<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = [
        'slug', 'name_en', 'name_ar', 'category',
        'short_description_en', 'short_description_ar', 'display_order'
    ];

    public function caseImages(): HasMany
    {
        return $this->hasMany(CaseImage::class)->orderBy('sort_order')->orderByDesc('id');
    }
}
