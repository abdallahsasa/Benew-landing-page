<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'full_name', 'phone', 'email', 'service_interest', 'message',
        'utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'fbclid', 'status',
    ];
}
