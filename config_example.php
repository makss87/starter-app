<?php

return [
    /**
     * Database connection settings(uncomment if needed)
     */
    'database' => [
        'name'     => 'ua',
        'username' => 'homestead',
        'password' => 'secret',
        'host'     => '127.0.0.1',
        'options'  => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ],
    ],

    'auth_login'    => 'admin',
    'auth_password' => '123',

    /**
     * Hosting setting for sites working in non-root folders like
     *
     */
//    'website_root' => 'subfolder',
];