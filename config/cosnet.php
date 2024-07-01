<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cosnet_token 
    |--------------------------------------------------------------------------
    |
    | This is the cosnet identification token used to query mycosnet.org
    | to retrieve informations about cosnet members
    |
    */
    'token' => env('COSNET_TOKEN'),
    'url_details_user' => env('COSNET_URL_DETAILS_USER')

];