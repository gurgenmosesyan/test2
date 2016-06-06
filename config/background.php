<?php

use App\Models\Background\Background;

return [
    'images' => [
        'path' => '/'.Background::IMAGES_PATH,
        'homepage' => [
            'extensions' => [
                'jpg', 'jpeg', 'png'
            ],
            'min_width' => 1800,
            'min_height' => 800,
            'max_width' => 2000,
            'max_height' => 1500
        ],
        'about' => [
            'extensions' => [
                'jpg', 'jpeg', 'png'
            ],
            'min_width' => 1800,
            'min_height' => 800,
            'max_width' => 2000,
            'max_height' => 1500
        ],
        'accommodation' => [
            'extensions' => [
                'jpg', 'jpeg', 'png'
            ],
            'min_width' => 1800,
            'min_height' => 800,
            'max_width' => 2000,
            'max_height' => 1500
        ],
        'offer' => [
            'extensions' => [
                'jpg', 'jpeg', 'png'
            ],
            'min_width' => 1800,
            'min_height' => 800,
            'max_width' => 2000,
            'max_height' => 1500
        ],
        'facility' => [
            'extensions' => [
                'jpg', 'jpeg', 'png'
            ],
            'min_width' => 1800,
            'min_height' => 800,
            'max_width' => 2000,
            'max_height' => 1500
        ],
        'event' => [
            'extensions' => [
                'jpg', 'jpeg', 'png'
            ],
            'min_width' => 1800,
            'min_height' => 800,
            'max_width' => 2000,
            'max_height' => 1500
        ]
    ]
];