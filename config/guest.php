<?php

use App\Models\Guest\Guest;

return [
    'images' => [
        'path' => '/'.Guest::IMAGES_PATH,
        'image' => [
            'extensions' => [
                'jpg', 'jpeg', 'png'
            ],
            'width' => 192,
            'height' => 192,
            //'min_width' => 500,
            //'max_width' => 200,
            //'min_height' => 500,
            //'max_height' => 200,
        ]
    ]
];