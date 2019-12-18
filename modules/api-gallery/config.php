<?php

return [
    '__name' => 'api-gallery',
    '__version' => '0.0.1',
    '__git' => 'git@github.com:getmim/api-gallery.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'http://iqbalfn.com/'
    ],
    '__files' => [
        'modules/api-gallery' => ['install','update','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'gallery' => NULL
            ],
            [
                'lib-app' => NULL
            ],
            [
                'api' => NULL
            ],
            [
                'lib-formatter' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'ApiGallery\\Controller' => [
                'type' => 'file',
                'base' => 'modules/api-gallery/controller'
            ]
        ],
        'files' => []
    ],
    'routes' => [
        'api' => [
            'apiGalleryIndex' => [
                'path' => [
                    'value' => '/gallery'
                ],
                'method' => 'GET',
                'handler' => 'ApiGallery\\Controller\\Gallery::index'
            ],
            'apiGallerySingle' => [
                'path' => [
                    'value' => '/gallery/view/(:identity)',
                    'params' => [
                        'identity' => 'any'
                    ]
                ],
                'method' => 'GET',
                'handler' => 'ApiGallery\\Controller\\Gallery::single'
            ]
        ]
    ]
];