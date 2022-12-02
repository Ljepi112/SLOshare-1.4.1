<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Enabled
    |--------------------------------------------------------------------------
    |
    | Blacklist On/Off
    |
    */

    'enabled' => false,

    /*
    |--------------------------------------------------------------------------
    | Blacklist Clients
    |--------------------------------------------------------------------------
    | An array of clients to be blacklisted which will reject them from announcing
    | to the sites tracker.
    |
    |
    */
    'clients' => [
        'Transmission/2.93', 'Transmission/2.04',
    ],
];
