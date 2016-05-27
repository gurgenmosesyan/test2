<?php

use App\Models\Facility\Facility;

return [
    'images' => [
        'path' => '/'.Facility::IMAGES_PATH,
        'image' => [
            'extensions' => [
                'jpg', 'jpeg', 'png'
            ],
            'width' => 1200,
            'height' => 550,
            //'min_width' => 500,
            //'max_width' => 200,
            //'min_height' => 500,
            //'max_height' => 200,
        ]
    ]
];