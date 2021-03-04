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

function checkBrivaStatus($pembayaran) {
    $token = getToken();
    $timestamp = gmdate("Y-m-d\TH:i:s.000\Z");
    $path = '/v1/briva/status/' . env('BRIVA_INSTITUTION_CODE') . '/' . env('BRIVA_NO') . "/$pembayaran->custCode";
    $verb = 'GET';

    $signature = generateSignature($path, $verb, $token, $timestamp, null);
    $url = env('BRIVA_APP_URL') . $path;
    $res = Http::withHeaders([
        'BRI-Signature' => $signature,
        'BRI-Timestamp' => $timestamp,
    ])->withToken($token)->get($url);

    $response = json_decode($res->body());

    if($response->data->statusBayar == 'Y') {
        return true;
    } else {
        return false;
    }
}
