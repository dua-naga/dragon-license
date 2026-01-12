<?php

return [
    /*
    |--------------------------------------------------------------------------
    | License Server URL
    |--------------------------------------------------------------------------
    |
    | This is the URL of your license validation server.
    | You can override this in your .env file with DRAGON_LICENSE_URL
    |
    */
    'server_url' => 'https://whatsmail.org',

    /*
    |--------------------------------------------------------------------------
    | API Endpoints
    |--------------------------------------------------------------------------
    |
    | Define the API endpoints for license operations
    |
    */
    'endpoints' => [
        'check' => '/api/license/checking',
        'credential' => '/api/license/get-credential',
        'versions' => '/api/upgrade/versions',
        'download' => '/api/upgrade/download',
    ],

    /*
    |--------------------------------------------------------------------------
    | Business ID
    |--------------------------------------------------------------------------
    |
    | Your business identifier for the license server
    |
    */
    'business_id' => 'whatsmailorganisation',

    /*
    |--------------------------------------------------------------------------
    | Offline Mode
    |--------------------------------------------------------------------------
    |
    | If true, the license check will pass even if server is unreachable
    | Set to false to require online verification
    |
    */
    'offline_mode' => false,

    /*
    |--------------------------------------------------------------------------
    | Requirements
    |--------------------------------------------------------------------------
    |
    | PHP extensions required for installation
    |
    */
    'requirements' => [
        'php' => [
            'openssl',
            'pdo',
            'mbstring',
            'tokenizer',
            'json',
            'curl',
            'fileinfo',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Permissions
    |--------------------------------------------------------------------------
    |
    | Folder permissions required for installation
    |
    */
    'permissions' => [
        'storage/framework/' => '775',
        'storage/logs/' => '775',
        'bootstrap/cache/' => '775',
    ],
];
