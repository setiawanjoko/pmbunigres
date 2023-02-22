<?php

namespace App\Http\Controllers\Pembayaran;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BniEnc;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BNIPaymentController extends Controller
{

    function createBNIInvoice(){
        // Function to create new BNI Virtual Account invoice

        $uri = config()->get('unigrespayment.bni.hostname');
        $client_id = config()->get('unigrespayment.bni.client_id');
        $client_secret = config()->get('unigrespayment.bni.client_secret');

        try {

            $raw_invoice = array(
                'client_id' => config()->get('unigrespayment.bni.client_id'),
                'trx_id' => mt_rand(),
                'trx_amount' => '500000',
                'customer_name' => 'BNI Billing Testing',
                'billing_type' => 'c',
                'type' => 'createbilling'
            );

            $hashed_string = BniEnc::encrypt($raw_invoice, $client_id, $client_secret);

            $data = array('client_id' => $client_id, 'data' => $hashed_string);
            $response = $this->get_content($uri, json_encode($data));
            // dd(json_decode($response, true));

            $response_json = json_decode($response, 'true');

            if ($response_json['status'] !== '000') {
                dd($response_json);
            } else {
                $data_response = BniEnc::decrypt($response_json['data'], $client_id, $client_secret);

                dd($data_response);
            }
        } catch (Exception $e){
            dd($e);
        }
    }

    function get_content($url, $post = '') {
        $usecookie = __DIR__ . "/cookie.txt";
        $header[] = 'Content-Type: application/json';
        $header[] = "Accept-Encoding: gzip, deflate";
        $header[] = "Cache-Control: max-age=0";
        $header[] = "Connection: keep-alive";
        $header[] = "Accept-Language: en-US,en;q=0.8,id;q=0.6";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        // curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_ENCODING, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 5);

        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36");

        if ($post)
        {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $rs = curl_exec($ch);

        if(empty($rs)){
            var_dump($rs, curl_error($ch));
            curl_close($ch);
            return false;
        }
        curl_close($ch);
        return $rs;
    }


    function inquiryBilling($trx_id)
    {
        // Function to inquire BNI Virtual Account invoice
        
        $uri = config()->get('unigrespayment.bni.hostname');
        $client_id = config()->get('unigrespayment.bni.client_id');
        $client_secret = config()->get('unigrespayment.bni.client_secret');


        try {

            $raw_billing = array(
                "type" => "inquirybilling",
                "client_id" => $client_id,
                "trx_id" => $trx_id
            );
    
            $hashed_string = BniEnc::encrypt($raw_billing, $client_id, $client_secret);
            $data = array(
                "client_id" => $client_id,
                "prefix" => config()->get('unigrespayment.bni.prefix'),
                "data" => $hashed_string
            );
    
            $response = $this->get_content($uri, json_encode($data));

            //dd(json_decode($response, 'true'));
            $response_json = json_decode($response, 'true');

            if ($response_json['status'] !== '000') {
                
                dd($response_json);
                
            } else {
                
                // Dekripsi response data
                $decryptResponse = BniEnc::decrypt($response_json['data'], $client_id, $client_secret);
                dd($decryptResponse);

            }

        } catch (Exception $e){
            dd($e);
        }

    }



}
