<?php

use App\Models\Partner\Partner;

return [
    'images' => [
        'path' => '/'.Partner::IMAGES_PATH,
        'image' => [
            'extensions' => [
                'jpg', 'jpeg', 'png'
            ],
            //'width' => 390,
            //'height' => 265,
            //'min_width' => 500,
            //'max_width' => 200,
            //'min_height' => 500,
            //'max_height' => 200,
        ]
    ]
];