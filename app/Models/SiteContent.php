<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteContent extends Model
{
    protected $fillable = ['section_key', 'title_en', 'title_ar', 'subtitle_en', 'subtitle_ar', 'body_en', 'body_ar'];
}
