<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KeuanganController extends Controller
{
    public function brivaSearchIndex(){
        return response()->view('admin.keuangan.briva-search.index');
    }

    public function brivaSearchShow(Request $request){
        $validatedData = $request->validate([
            'briva' => 'required|exists:pembayaran,custCode'
        ],[
            'briva.exists' => 'BRI Virtual Account tidak terdaftar di database PMB.'
        ]);

        try {
            $token = getToken();
            $timestamp = gmdate("Y-m-d\TH:i:s.000\Z");

            $path = '/v1/briva/' . env('BRIVA_INSTITUTION_CODE') . '/' . env('BRIVA_NO') . '/' . $validatedData['briva'];
            $verb = 'GET';

            $payload = null;

            $signature = generateSignature($path, $verb, $token, $timestamp, $payload);
            $url = env('BRIVA_APP_URL') . $path;

            $res = Http::withHeaders([
                'BRI-Signature' => $signature,
                'BRI-Timestamp' => $timestamp,
                'Content-Type' => 'application/json'
            ])->withToken($token)->get($url);
            $response = json_decode($res->body());
            if ($response->status && (isset($response->data) && $response->responseCode == '00')) {
                $data = $response->data;
                return response()->view('admin.keuangan.briva-search.index', compact('data'));
            } else if(!is_null($response->status)){
                throw new \Exception(getBrivaErrorMessage($response->status->code));
            }
        }catch (\Exception $e){
            return response()->redirectToRoute('admin.keuangan.briva-search.index')->with([
                'status' => 'danger',
                'message' => $e->getMessage()
            ]);
        }
    }
}
