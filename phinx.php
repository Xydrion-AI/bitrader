<?php

return [
    'paths' => [
        'migrations' => 'database/migrations'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'development' => [
            'adapter' => 'mysql',
            'host' => '127.0.0.1',
            'name' => 'bitrader', 
            'user' => 'root',
            'pass' => '',         
            'port' => '3306',
            'charset' => 'utf8mb4',
        ],
    ],
];
