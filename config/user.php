<?php

return [

    /*
    |--------------------------------------------------------------------------
    | User Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default settings for users if they belong to no group.
    |
    */

    'group' => [
        'defaults' => [
            'name'          => 'Slabo razmerje',
            'slug'          => 'slabo-razmerje',
            'color'         => '#FF9966',
            'effect'        => '',
            'icon'          => 'fal fa-robot',
            'is_admin'      => false,
            'is_freeleech'  => false,
            'is_immune'     => false,
            'is_incognito'  => false,
            'is_internal'   => false,
            'is_modo'       => false,
            'is_trusted'    => false,
            'can_upload'    => false,
            'level'         => 0,
            'position'      => 0,
        ],
    ],

    'privacy' => [
        'defaults' => [
            'is_hidden'  => false,
            'is_private' => false,
        ],
    ],
];
