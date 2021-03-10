<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckStatusController extends Controller
{
    public function index(Request $request) {
        $validatedData = $request->validate([
            'start_date' => 'required_with:end_date|date',
            'end_date' => 'required_with:start_date|date'
        ]);


        if(!empty($validatedData)) {
            $token = getToken();
            $timestamp = gmdate("Y-m-d\TH:i:s.000\Z");

            $path = '/v1/briva/report/' . env('BRIVA_INSTITUTION_CODE') . '/' . env('BRIVA_NO') . '/' . date_format(Carbon::createFromFormat('Y-m-d', $validatedData['start_date']), 'Ymd') . '/' . date_format(Carbon::createFromFormat('Y-m-d', $validatedData['end_date']), 'Ymd');
            $verb = 'GET';

            $signature = generateSignature($path, $verb, $token, $timestamp, null);
            $url = env('BRIVA_APP_URL') . $path;
            $res = Http::withHeaders([
                'BRI-Signature' => $signature,
                'BRI-Timestamp' => $timestamp,
            ])->withToken($token)->get($url);

            $response = json_decode($res->body());
            if($response->status) {
                $data = $response->data;
            }
        } else $data = null;

        return response()->view('keuangan.check-status', compact('data'));
    }
}
