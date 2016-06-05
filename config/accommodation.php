<?php

use App\Models\Accommodation\AccommodationImage;

return [
    'images' => [
        'path' => '/'.AccommodationImage::IMAGES_PATH,
        'image' => [
            'extensions' => [
                'jpg', 'jpeg', 'png'
            ],
            'width' => 1200,
            'height' => 460,
            //'min_width' => 500,
            //'max_width' => 200,
            //'min_height' => 500,
            //'max_height' => 200,
        ]
    ]
];