<?php

return [
    'displayErrorDetails' => true,
    'addContentLengthHeader' => false,
    'doctrine' => [
        'meta' => [
            'entity_path' => [
                __DIR__ . '/src/Nx/Domain/Model/Address',
                __DIR__ . '/src/Nx/Domain/Model/Dealer',
                __DIR__ . '/src/Nx/Domain/Model/Listing',
                __DIR__ . '/src/Nx/Domain/Model/Vehicle'
            ],
            'auto_generate_proxies' => true,
            'proxy_dir' =>  __DIR__ . '/cache/proxies',
            'cache' => null,
        ],
        'connection' => [
            'driver'   => 'pdo_mysql',
            'host'     => 'localhost',
            'dbname'   => 'nx',
            'user'     => 'root',
            'password' => '',
        ]
    ]
];