<?php

namespace App\Helpers;

use App\Http\Controllers\Controller;
use App\Helpers\BniEnc;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BNIPayment extends Controller
{
    public static function createBNIInvoice($Trx){
        // Function to create new BNI Virtual Account invoice

        /**
         * Example of API Response
         * array("trx_id" => "1465968898"
         * "client_id" => "19063"
         * "virtual_account" => "9881906323022201"      TODO: transformed to custCode
         * "trx_amount" => "500000"                     TODO: transformed to amount
         * "customer_name" => "BNI Billing Testing"
         * "customer_email" => ""
         * "customer_phone" => ""
         * "datetime_created" => "2023-02-22 12:37:26"
         * "datetime_expired" => "2023-02-24 12:37:28"
         * "datetime_payment" => "2023-02-22 12:41:35"
         * "datetime_last_updated" => "2023-02-22 12:37:26"
         * "payment_ntb" => "752895"
         * "payment_amount" => "500000"
         * "va_status" => "2"                           TODO: translated and transformed to status
         * "description" => ""
         * "billing_type" => "c"
         * "datetime_created_iso8601" => "2023-02-22T12:37:26+07:00"
         * "datetime_expired_iso8601" => "2023-02-24T12:37:28+07:00"       TODO: transformed to expiredDate
         * "datetime_payment_iso8601" => "2023-02-22T12:41:35+07:00"
         * "datetime_last_updated_iso8601" => "2023-02-22T12:37:26+07:00")
         */

        try {

            $raw_invoice = array(
                'client_id' => config()->get('unigrespayment.bni.client_id'),
                'trx_id' => mt_rand(),
                'trx_amount' => $Trx['trx_amount'], //TODO: change trx amount
                'customer_name' => $Trx['customer_name'], //TODO: change customer name
                'customer_email' => $Trx['customer_email'],
                'customer_phone' => $Trx['customer_phone'],
                'datetime_expired' => $Trx['datetime_expired'],
                'billing_type' => 'c',
                'type' => 'createbilling'
            );

            $hashed_string = BniEnc::encrypt($raw_invoice, config()->get('unigrespayment.bni.client_id'), config()->get('unigrespayment.bni.client_secret'));

            $data = array('client_id' => config()->get('unigrespayment.bni.client_id'), 'prefix' => config()->get('unigrespayment.bni.prefix'), 'data' => $hashed_string);
            $response = self::get_content(config()->get('unigrespayment.bni.hostname'), json_encode($data));
            // dd(json_decode($response, true));

            $response_json = json_decode($response, 'true');

            if ($response_json['status'] !== '000') {
                dd($response_json);
            } else {
                $data_response = BniEnc::decrypt($response_json['data'], config()->get('unigrespayment.bni.client_id'), config()->get('unigrespayment.bni.client_secret'));

                return $data_response;
            }
        } catch (Exception $e){
            dd($e);
        }
    }

    public static function get_content($url, $post = '') {
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


    public static function inquiryBilling($trx_id)
    {
        // Function to inquire BNI Virtual Account invoice

        try {

            $raw_billing = array(
                "type" => "inquirybilling",
                "client_id" => config()->get('unigrespayment.bni.client_id'),
                "trx_id" => $trx_id
            );

            $hashed_string = BniEnc::encrypt($raw_billing, config()->get('unigrespayment.bni.client_id'), config()->get('unigrespayment.bni.client_secret'));
            $data = array(
                "client_id" => config()->get('unigrespayment.bni.client_id'),
                "prefix" => config()->get('unigrespayment.bni.prefix'),
                "data" => $hashed_string
            );

            $response = self::get_content(config()->get('unigrespayment.bni.hostname'), json_encode($data));

            //dd(json_decode($response, 'true'));
            $response_json = json_decode($response, 'true');

            if ($response_json['status'] !== '000') {

                dd($response_json);

            } else {

                // Dekripsi response data
                $decryptResponse = BniEnc::decrypt($response_json['data'], config()->get('unigrespayment.bni.client_id'), config()->get('unigrespayment.bni.client_secret'));
                return $decryptResponse;

            }

        } catch (Exception $e){
            dd($e);
        }

    }

    public static function updateTransaction($raw){
        try {
            $raw_invoice = array(
                'type' => 'updatebilling',
                'client_id' => config()->get('unigrespayment.bni.client_id'),
                'trx_id' => $raw['trx_id'] ?? '1', //TODO: change trx id
                'trx_amount' => $raw['trx_amount'], //TODO: change trx amount
                'customer_name' => $raw['customer_name'] ?? '', //TODO: change customer name
            );
            $hashed_string = BniEnc::encrypt($raw_invoice, config()->get('unigrespayment.bni.client_id'), config()->get('unigrespayment.bni.client_secret'));
            $data = array(
                'client_id' => config()->get('unigrespayment.bni.client_id'),
                'prefix' => config()->get('unigrespayment.bni.prefix'),
                'data' => $hashed_string
            );

            $response = self::get_content(config()->get('unigrespayment.bni.hostname'), json_encode($data));

            //dd(json_decode($response, 'true'));
            $response_json = json_decode($response, 'true');

            if ($response_json['status'] !== '000') {

                dd($response_json);

            } else {

                // Dekripsi response data
                $decryptResponse = BniEnc::decrypt($response_json['data'], config()->get('unigrespayment.bni.client_id'), config()->get('unigrespayment.bni.client_secret'));
                dd($decryptResponse);

            }
        } catch(Exception $e) {
            dd($e);
        }
    }

}
