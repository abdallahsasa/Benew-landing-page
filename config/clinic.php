<?php

return [
    'phone' => env('CLINIC_PHONE', '+90 555 000 0000'),
    'whatsapp' => env('CLINIC_WHATSAPP', '905550000000'),
    'address_en' => env('CLINIC_ADDRESS_EN', 'Benew Aesthetic & Dental Center, City Center'),
    'address_ar' => env('CLINIC_ADDRESS_AR', 'مركز Benew للتجميل والأسنان، وسط المدينة'),
    'maps_url' => env('CLINIC_MAPS_URL', 'https://maps.google.com'),
    'meta_pixel_id' => env('META_PIXEL_ID', ''),
    'social' => [
        'instagram' => env('SOCIAL_INSTAGRAM', 'https://instagram.com'),
        'facebook' => env('SOCIAL_FACEBOOK', 'https://facebook.com'),
        'tiktok' => env('SOCIAL_TIKTOK', 'https://tiktok.com'),
        'youtube' => env('SOCIAL_YOUTUBE', 'https://youtube.com'),
    ],
];
