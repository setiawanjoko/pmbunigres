<?php

return [
    'bni' => [
        'prefix' => 988,
        'client_secret' => '0c0d0841713261e59080b3a64b6252ea',
        'client_id' => '19063',

        // request_type sandbox (8067), development (8066), testing (8065)
        'request_type' => 8065,

        // hostname prod (https://api.bni.co.id), non prod (https://newapidev.bni.co.id), from email(https://api.bni-ecollection.com), sandbox(https://sandbox.bni.co.id)
        'hostname' => 'https://apibeta.bni-ecollection.com',

        // status code returned from BNI Server
        'status_code' => [
            '000' => 'Success',
            '001' => 'Incomplete/invalid Parameter(s).',
            '002' => 'IP address not allowed or wrong Client ID.',
            '004' => 'Service not found.',
            '005' => 'Service not defined.',
            '006' => 'Invalid VA Number.',
            '007' => 'Invalid Billing Number.',
            '008' => 'Technical Failure.',
            '009' => 'Unexpected Error.',
            '010' => 'Request Timeout.',
            '011' => 'Billing type does not match billing amount.',
            '012' => 'Invalid expiry date/time.',
            '013' => 'IDR curency cannot have billing amount with decimal fraction.',
            '014' => 'VA Number should not be defined when Billing Number is set.',
            '015' => 'Invalid Permission(s)',
            '016' => 'Invalid Billing Type',
            '017' => 'Customer Name cannot be used.',
            '100' => 'Billing has been paid.',
            '101' => 'Billing not found.',
            '102' => 'VA Number is in use.',
            '103' => 'Billing has been expired.',
            '104' => 'Billing Number is in use.',
            '105' => 'Duplicate Billing ID.',
            '107' => 'Amount can not be changed.',
            '108' => 'Data not found.',
            '110' => 'Exceed Daily Limit Transaction',
            '200' => 'Failed to send SMS Payment.',
            '201' => 'SMS Payment can only be used with Fixed Payment.',
            '801' => 'Billing type not supported for this Client ID.',
            '997' => 'System is temporarily offline.',
            '996' => 'Too many inquiry request per hour.',
            '998' => '"Content-Type" header not defined as it should be.',
            '999' => 'Internal error.'
        ]
    ],
];
