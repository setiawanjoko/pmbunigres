<?php

return [
    'bni' => [
        'prefix' => 988,
        'client_secret' => '0c0d0841713261e59080b3a64b6252ea',
        'client_id' => '19063',

        // request_type sandbox (8067), development (8066), testing (8065)
        'request_type' => 8065,

        // hostname prod (https://api.bni.co.id), non prod (https://newapidev.bni.co.id), from email(https://api.bni-ecollection.com), sandbox(https://sandbox.bni.co.id)
        'hostname' => 'https://api.bni-ecollection.com'
    ],
];
