<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Powered By
    |--------------------------------------------------------------------------
    |
    | A string that describes the core software that powers the application
    |
    */

    'powered-by' => 'SLOshare.eu v1.4.2',

    /*
    |--------------------------------------------------------------------------
    | Codebase Name
    |--------------------------------------------------------------------------
    |
    | Name of Codebase
    |
    */

    'codebase' => 'SLOshare.eu (Tracker)',

    /*
    |--------------------------------------------------------------------------
    | Codebase Version
    |--------------------------------------------------------------------------
    |
    | Version of Codebase
    |
    */

    'version' => 'v1.4.2',

    /*
    |--------------------------------------------------------------------------
    | Owner Account Configuration
    |--------------------------------------------------------------------------
    |
    | Various settings related to the Owner account configuration
    |
    */

    'owner-username'         => env('DEFAULT_OWNER_NAME', 'SLOshare'),
    'default-owner-email'    => env('DEFAULT_OWNER_EMAIL', 'info@sloshare.eu'),
    'default-owner-password' => env('DEFAULT_OWNER_PASSWORD', 'SLOshare'),

    // If using a Reverse Proxy for HTTPS set the 'PROXY_SCHEME' value in your .env file to `https` or adjust the below value
    'proxy_scheme'      => env('PROXY_SCHEME', false),
    'root_url_override' => env('FORCE_ROOT_URL', false),

    // Global Rate Limit for Comments - X Per Minute
    'comment-rate-limit' => env('COMMENTS_PER_MINUTE', 2),

    /*
    |--------------------------------------------------------------------------
    | External Chat Platform
    |--------------------------------------------------------------------------
    |
    | Settings to configure an external chat platform
    |
    */

    'chat-link-name' => 'Discord',
    'chat-link-icon' => 'fab fa-discord',
    'chat-link-url'  => '',
];
