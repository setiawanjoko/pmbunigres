<?php

use Illuminate\Support\Facades\Http;

function getToken(){
    $params = [
        'client_id' => env('BRIVA_CONSUMER_KEY'),
        'client_secret' => env('BRIVA_CONSUMER_SECRET')
    ];
    $url = env('BRIVA_APP_URL') . "/oauth/client_credential/accesstoken?grant_type=client_credentials";

    $res = Http::asForm()->post($url, $params );
    $response = json_decode($res->body());

    return $response->access_token;
}

function generateSignature($path,$verb,$token,$timestamp,$payload){
    $g = "path=$path&verb=$verb&token=Bearer $token&timestamp=$timestamp&body=$payload";
    $signPayload = hash_hmac('sha256', $g, env('BRIVA_CONSUMER_SECRET'), true);

    return base64_encode($signPayload);
}
