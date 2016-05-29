<?php

use App\Models\Homepage\Homepage;

return [
    'images' => [
        'path' => '/'.Homepage::IMAGES_PATH,
        'about_image' => [
            'extensions' => [
                'jpg', 'jpeg', 'png'
            ],
            //'width' => 500,
            //'height' => 400,
            //'min_width' => 500,
            //'max_width' => 200,
            //'min_height' => 500,
            //'max_height' => 200,
        ],
        'offers_image' => [
            'extensions' => [
                'jpg', 'jpeg', 'png'
            ],
            //'width' => 500,
            //'height' => 400,
        ]
    ]
];