<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Download Check Page
    |--------------------------------------------------------------------------
    |
    | Weather Or Not User Will Be Stopped At Download Check Page Or Not
    |
    */

    'download_check_page' => 0,

    /*
    |--------------------------------------------------------------------------
    | Source Value
    |--------------------------------------------------------------------------
    |
    | Torrent Source Value
    |
    */

    'source' => 'SLOshare.eu',

    /*
    |--------------------------------------------------------------------------
    | Created By
    |--------------------------------------------------------------------------
    |
    | Created By Value
    |
    */

    'created_by'        => 'Uredil SLOshare.eu',
    'created_by_append' => true,

    /*
    |--------------------------------------------------------------------------
    | Comment
    |--------------------------------------------------------------------------
    |
    | Comment Value
    |
    */

    'comment' => 'Preneseno iz https://www.sloshare.eu/ - SLOshare.eu in vas zavezuje pravilnik o zasebnosti!',

    /*
    |--------------------------------------------------------------------------
    | Magnet
    |--------------------------------------------------------------------------
    |
    | Enable/Disable magnet links
    |
    */

    'magnet' => 0,

    /*
    |--------------------------------------------------------------------------
    | Freeleech on torrents over specified size threshold
    |--------------------------------------------------------------------------
    |
    | Enable/Disable freeleech on torrents over specified size threshold
    | true/false
    */

    'size_freeleech' => true,
    'size_threshold' => '53687091200', //in bytes, default is 53687091200 (50GiB)
];
