<?php

return [
    'managers' => [
        'default' => [
            'dev' => env('APP_DEBUG', false),
            'meta' => 'attributes',
            'connection' => env('DB_CONNECTION', 'mysql'),
            'namespaces' => [
                'App\Entities',
            ],
            'paths' => [
                base_path('app/Entities')
            ],
            'repository' => Doctrine\ORM\EntityRepository::class,
            'proxies' => [
                'namespace' => 'DoctrineProxies',
                'path' => storage_path('proxies'),
                'auto_generate' => env('DOCTRINE_PROXY_AUTOGENERATE', false)
            ],
            'events' => [
                'listeners' => [],
                'subscribers' => []
            ],
            'filters' => [],
            'mapping_types' => []
        ]
    ],
    'extensions' => []
];
