<?php

use App\Models\Accommodation\Accommodation;

return [
    'accommodation' => [
        'path' => '/'.Accommodation::IMAGES_PATH,
        'thumb' => [
            'width' => '330',
            'height' => '227',
            'crop' => 'center'
        ]
    ]
];