<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Model Fields To Disregard
    |--------------------------------------------------------------------------
    |
    | Array []
    |
    */

    'global_discards' => [
        'password', 'passkey', 'rsskey', 'ip', 'remember_token',
        'views', 'num_post', 'read', 'nfo',
        'last_reply_at', 'last_action', 'created_at', 'updated_at', 'deleted_at',
    ],

    /*
    |--------------------------------------------------------------------------
    | Recyle Old Audit Records
    |--------------------------------------------------------------------------
    |
    | In Days!
    |
    */

    'recycle' => 30,

];
