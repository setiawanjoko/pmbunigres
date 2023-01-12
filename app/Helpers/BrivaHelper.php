<?php

use App\Mail\InvoiceMail;
use App\Models\Biaya;
use App\Models\Biodata;
use App\Models\Pembayaran;
use App\Models\Prodi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

CONST ERRORMESSAGE = [
    '01' => 'Nomor BRIVA tidak boleh kosong.',
    '02' => 'Customer Code tidak boleh kosong.',
    '03' => 'Institution Code tidak boleh kosong.',
    '05' => 'Institution Code tidak diijinkan mengakses nomor BRIVA.',
    '10' => 'Nama tidak boleh kosong.',
    '11' => 'Amount tidak boleh kosong.',
    '13' => 'Data customer sudah ada.',
    '14' => 'Data customer tidak ditemukan.',
    '15' => 'Gagal menyimpan data customer.',
    '16' => 'Gagal mengubah data BRIVA.',
    '17' => 'Gagal menghapus data BRIVA.',
    '20' => 'Gagal mengubah status bayar.',
    '21' => 'Gagal mendapatkan data status bayar.',
    '30' => 'Gagal mendapatkan data BRIVA.',
    '40' => 'Gagal memproses request report BRIVA.',
    '99' => 'Kegagalan umum.',
    '0109' => 'Parameter request tidak valid.'
];

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
    $payload = sprintf(
        'path=%s&verb=%s&token=Bearer %s&timestamp=%s&body=%s',
        $path,
        $verb,
        $token,
        $timestamp,
        $payload
    );
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

    if(isset($response->data) && $response->data->statusBayar == 'Y') {
        return true;
    } else {
        return false;
    }
}

function generateNIM($prodi_id){
    $count = Biodata::whereHas('user', function ($query) use($prodi_id){
        $query->whereHas('pembayaran', function($que) use($prodi_id){
            return $que->where([
                ['kategori', 'daftar_ulang'],
                ['status', 1]
            ]);
        })->where('prodi_id', $prodi_id);
    })->count();
    /*$count = User::whereHas('pembayaran', function($query){
        return $query->where([
            ['kategori', 'daftar_ulang'],
            ['status', 1]
        ]);
    })->where('prodi_id', $prodi_id)->count();*/
    $prodi = Prodi::find($prodi_id);

    $date = Carbon::today()->year;
    $nim = $date . $prodi->kode_prodi_nim . substr(str_repeat(0, 4).$count, - 4);

    // Cek nim sudah ada atau belum

    return $nim;
}

function setNIM($year, $prodi, $count){
    return $year.$prodi.substr(str_repeat(0, 4).$count, - 4);
}

function nomorSurat(){
    $tahun = Carbon::today()->year;
    $count = Pembayaran::where('kategori', 'daftar_ulang')->whereYear('created_at', $tahun)->count();
    $seq = substr(str_repeat(0, 3).$count, - 3);

    return $seq . '/PAN-PMB/' . $tahun;
}

function bypassPembayaran($userId, $kategori = false){
    // kategori false = registrasi, true = daftar ulang
    $kategori = ($kategori) ? 'daftar_ulang' : 'registrasi';

    $pembayaran = Pembayaran::where([
        ['user_id', $userId],
        ['kategori', $kategori]
    ])->first();

    try {
        if(is_null($pembayaran)){
            Pembayaran::create([
                'user_id' => $userId,
                'kategori' => $kategori,
                'custCode' => '000000',
                'amount' => '0',
                'expiredDate' => Carbon::now(),
                'status' => 1
            ]);
        } else{
            $pembayaran->status = 1;
            $pembayaran->save();
        }

        return true;
    }catch (Exception $e){
        dd($e->getMessage());
    }
}

function getBrivaErrorMessage($code) {
    return ERRORMESSAGE[$code];
}

function kirimTagihan($user, $data){
    try {
        Mail::to($user)->send(new InvoiceMail($user, $data));

        return true;
    } catch (Exception $e){
        return false;
    }
}

/*
 *
 * Modified date : 08 Dec 2021
 * Modified by   : Setiawan Joko Prakoso
 *
 * Some code that were scattered to different controllers
 * are now moved to this helper.
 *
 * */

/**
 * @return string
 */
function generateCustCode(): string
{
    // new custCodes are now not distinguished between registration and heregistration

    $todayBills = Pembayaran::whereDate('created_at', Carbon::today())->count();
    if($todayBills > 0) {
        $lastBill = Pembayaran::whereDate('created_at', Carbon::today())->orderBy('custCode', 'DESC')->first();
        return $lastBill->custCode + 1;
    } else {
        Carbon::create(2021, 6, 14);
        $date = date_format(Carbon::today(), 'ymd');
        $number = 1;
        $seq = substr(str_repeat(0, 4).$number, - 4);

        return $date . $seq; // Format : yymmddxxxx
    }
}

/**
 * @return string
 */
function generateNomorSurat(): string
{
    $year = Carbon::today()->year;
    $count = Pembayaran::whereNotNull('no_surat')->whereYear('created_at', $year)->count();
    $sequence = substr(str_repeat(0, 3) . ($count+1), -3);

    return $sequence . '/PAN-PMB/' . $year; // Format : xxx/PAN-PMB/yyyy
}

function getBriva(string $custCode){
    $token = getToken();
    $timestamp = gmdate("Y-m-d\TH:i:s.000\Z");

    $path = '/v1/briva/' . env('BRIVA_INSTITUTION_CODE') . '/' . env('BRIVA_NO') . '/' . $custCode;
    $verb = 'GET';

    $signature = generateSignature($path, $verb, $token, $timestamp, null);
    $url = env('BRIVA_APP_URL') . $path;

    var_dump($url);

    try {
        $res = Http::withHeaders([
            'BRI-Signature' => $signature,
            'BRI-Timestamp' => $timestamp,
        ])->withToken($token)->get($url);
        $response = json_decode($res->body());

        dd($response);
    } catch (\Exception $e){
        dd($e->getMessage());
    }
}

/**
 * @param string $kategori
 * @param Biaya $biaya
 * @param User $user
 * @return string[]
 */
function createBriva(string $kategori, Biaya $biaya, User $user): array
{
    $token = getToken();
    $timestamp = gmdate("Y-m-d\TH:i:s.000\Z");

    $path = '/v1/briva/';
    $verb = 'POST';
    $custCode = generateCustCode();
    $expDate = Carbon::now()->addDays(2)->format('Y-m-d H:i:s');

    if($kategori == 'registrasi') {
        $data = [
            'amount' => $biaya->biaya_registrasi,
            'keterangan' => 'Registrasi PMB Unigres'
        ];
    } else if($kategori == 'daftar_ulang') {
        $data = [
            'amount' => $biaya->total_daftar_ulang,
            'keterangan' => 'Daftar Ulang PMB Unigres'
        ];
    }

    $data = array_merge($data, [
        'institutionCode' => env('BRIVA_INSTITUTION_CODE'),
        'brivaNo' => env('BRIVA_NO'),
        'custCode' => $custCode,
        'nama' => $user->nama,
        'expiredDate' => $expDate
    ]);
    $payload = json_encode($data);

    $signature = generateSignature($path, $verb, $token, $timestamp, $payload);
    $url = env('BRIVA_APP_URL') . $path;

    $res = Http::withHeaders([
        'BRI-Signature' => $signature,
        'BRI-Timestamp' => $timestamp,
        'Content-Type' => 'application/json'
    ])->withToken($token)->post($url, $data);
    $response = json_decode($res->body());

    if($kategori == 'daftar_ulang') {
        $data = array_merge($data, [
            'no_surat' => generateNomorSurat()
        ]);
    }

    if($response->status && $response->responseDescription == 'Success') {
        try {
            $data = Pembayaran::create([
                'user_id' => $user->id,
                'custCode' => $custCode,
                'amount' => $data['amount'],
                'keterangan' => $data['keterangan'],
                'expiredDate' => $expDate,
                'status' => false,
                'kategori' => $kategori,
                'no_surat' => $data['no_surat'] ?? null
            ]);

            kirimTagihan($user, $data);
            return [
                'status' => 'success',
                'message' => 'Berhasil mengirimkan tagihan.',
                'data' => $data
            ];
        } catch (Exception $e) {
            return [
                'status' => 'danger',
                'message' => 'Gagal membuat tagihan. ERR_CODE: ' . $e->getMessage()
            ];
        }
    } else {
        $res = [
            'status' => 'danger',
            'message' => 'Gagal membuat tagihan. ERR_CODE: ' . $response->errDesc
        ];

        return $res;
    }
}

/**
 * @param Pembayaran $pembayaran
 * @param string $statusBayar
 * @return bool
 */
function updateStatusBriva(Pembayaran $pembayaran, string $statusBayar = 'N'): bool
{
    $token = getToken();
    $timestamp = gmdate("Y-m-d\TH:i:s.000\Z");

    $path = '/v1/briva/status';
    $verb = 'PUT';

    $data = [
        'institutionCode' => env('BRIVA_INSTITUTION_CODE'),
        'brivaNo' => env('BRIVA_NO'),
        'custCode' => $pembayaran->custCode,
        'statusBayar' => $statusBayar
    ];
    $payload = json_encode($data);

    $signature = generateSignature($path, $verb, $token, $timestamp, $payload);
    $url = env('BRIVA_APP_URL') . $path;
    $res = Http::withHeaders([
        'BRI-Signature' => $signature,
        'BRI-Timestamp' => $timestamp,
        'Content-Type' => 'application/json'
    ])->withToken($token)->put($url, $data);
    $response = json_decode($res->body());

    return isset($response->status) && $response->status;
}

/**
 * @param $custCode
 * @return bool
 */
function deleteBriva($custCode): bool
{
    $token = getToken();
    $timestamp = gmdate("Y-m-d\TH:i:s.000\Z");
    $path = '/v1/briva';
    $verb = 'DELETE';

    $institutionCode = env('BRIVA_INSTITUTION_CODE');
    $brivaNo = env('BRIVA_NO');
    $data = compact('institutionCode', 'brivaNo', 'custCode');
    $payload = http_build_query($data);

    $url = env('BRIVA_APP_URL') . $path;
    $signature = generateSignature($path, $verb, $token, $timestamp, $payload);

    $client = new GuzzleHttp\Client();
    $options['headers'] = [
        'Authorization' => 'Bearer ' . $token,
        'BRI-Timestamp' => $timestamp,
        'BRI-Signature' => $signature,
        'Content-Type' => 'text/plain'
    ];
    $options['body'] = $payload;

    $res = $client->request($verb, $url, $options);

    $response = json_decode($res->getBody());

    return isset($response->status) && $response->status;
}
