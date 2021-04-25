<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Prodi;
use App\Models\User;
use Carbon\Carbon;
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
                'BRI-Timestamp' => $timestamp
            ])->withToken($token)->get($url);
            $response = json_decode($res->body());
            if ($response->status && (isset($response->data) && $response->responseCode == '00')) {
                $data = $response->data;

                if($data->statusBayar == 'Y') {
                    $pembayaran = Pembayaran::where('custCode', $data->CustCode)->first();
                    $res = $this->getBrivaStatus($pembayaran->custCode);

                    if ($res->status && (isset($res->data) && $res->responseCode == '00')) {
                        $pembayaran->status = true;
                        $pembayaran->save();
                    }
                }
                return response()->view('admin.keuangan.briva-search.index', compact('data'));
            } else if(!is_null($response->status)){
                if(isset($response->status->code)) throw new \Exception(getBrivaErrorMessage($response->status->code));
                else throw new \Exception($response);
            }
        }catch (\Exception $e){
            return response()->redirectToRoute('admin.keuangan.briva-search.index')->with([
                'status' => 'danger',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function brivaConfirm(Request $request){
        $validatedData = $request->validate([
            'briva' => 'required|exists:pembayaran,custCode'
        ]);

        try {
            $pembayaran = Pembayaran::where('custCode', $validatedData['briva'])->first();

            if($pembayaran->status) throw new \Exception('Pembayaran telah dibayarkan.');

            $response = $this->getBrivaStatus($validatedData['briva']);
            if ($response->status && (isset($response->data) && $response->responseCode == '00')) {
                $data = $response->data;

                $confirm = false;
                if($data->statusBayar == 'N') {
                    $confirm = $this->confirm($validatedData['briva']);
                    if($confirm != 1) throw new \Exception($confirm);
                }
                if($data->statusBayar == 'Y' || $confirm) {
                    $pembayaran->status = true;
                    $pembayaran->save();

                    return response()->redirectToRoute('admin.keuangan.briva-search.index')->with([
                        'status' => 'success',
                        'message' => 'Status pembayaran berhasil diubah.'
                    ]);
                }
            } else if(!is_null($response->status)){
                throw new \Exception(getBrivaErrorMessage($response->status->code));
            }
        } catch (\Exception $e){return response()->redirectToRoute('admin.keuangan.briva-search.index')->with([
            'status' => 'danger',
            'message' => $e->getMessage()
        ]);
        }
    }

    private function confirm($briva)
    {
        $token = getToken();
        $timestamp = gmdate("Y-m-d\TH:i:s.000\Z");

        $path = '/v1/briva/status';
        $verb = 'PUT';

        $data = [
            'institutionCode' => env('BRIVA_INSTITUTION_CODE'),
            'brivaNo' => env('BRIVA_NO'),
            'custCode' => $briva,
            'statusBayar' => 'Y'
        ];

        $payload = json_encode($data, true);

        $signature = generateSignature($path, $verb, $token, $timestamp, $payload);
        $url = env('BRIVA_APP_URL') . $path;

        $res = Http::withHeaders([
            'BRI-Signature' => $signature,
            'BRI-Timestamp' => $timestamp,
            'Content-Type' => 'application/json'
        ])->withToken($token)->put($url, $data);
        $response = json_decode($res->body());
        if ($response->status && (isset($response->data) && $response->responseCode == '00')) {
            return 1;
        } else if(!is_null($response->status)){
            return getBrivaErrorMessage($response->status->code);
        }
    }

    public function pembayaranIndex($filter = null){
        $data = Pembayaran::with(['pendaftar.prodi.jenjang', 'pendaftar.gelombang', 'pendaftar.kelas'])
            ->whereHas('pendaftar', function($query) use($filter){
                if(is_null($filter)){
                    return $query->whereNotNull('prodi_id');
                } else {
                    return $query->whereNotNull('prodi_id')->where('prodi_id', $filter);
                }
            })
            ->get();
        if(is_null($filter)){
            $data = User::with(['prodi.jenjang', 'gelombang', 'kelas', 'pembayaran'])
                ->has('pembayaran')
                ->whereNotNull('prodi_id')
                ->where('permission_id', 2)
                ->get();
        } else {
            $data = User::with(['prodi.jenjang', 'gelombang', 'kelas', 'pembayaran'])
                ->has('pembayaran')
                ->whereNotNull('prodi_id')
                ->where([
                    ['permission_id', 2],
                    ['prodi_id', $filter]
                ])
                ->get();
        }

        $dataProdi = Prodi::all();

        return response()->view('admin.keuangan.pembayaran.index', compact('data', 'dataProdi'));
    }

    public function pembayaranFilter(Request $request){
        $data = $request->validate([
            'prodi' => 'required|exists:prodi,id'
        ]);

        return $this->pembayaranIndex($data['prodi']);
    }

    public function getLatestBrivaStatus(){
        $pembayaran = Pembayaran::where('status', 0)->get();
        foreach ($pembayaran as $item) {
            $response = $this->getBrivaStatus($item->custCode);

            if ($response->status && (isset($response->data) && $response->responseCode == '00')) {
                if($response->data->statusBayar == 'Y') {
                    $item->status = 1;
                    $item->save();
                }
            } else if(!is_null($response->status)){
                return response()->redirectToRoute('admin.keuangan.pembayaran.index')->getBrivaErrorMessage($response->status->code);
            }
        }

        return response()->redirectToRoute('admin.keuangan.pembayaran.index');
    }

    private function getBrivaStatus($custCode){
        $token = getToken();
        $timestamp = gmdate("Y-m-d\TH:i:s.000\Z");

        $path = '/v1/briva/status/' . env('BRIVA_INSTITUTION_CODE') . '/' . env('BRIVA_NO') . '/' . $custCode;
        $verb = 'GET';

        $payload = null;

        $signature = generateSignature($path, $verb, $token, $timestamp, $payload);
        $url = env('BRIVA_APP_URL') . $path;

        $response = Http::withHeaders([
            'BRI-Signature' => $signature,
            'BRI-Timestamp' => $timestamp
        ])->withToken($token)->get($url);

        return json_decode($response->body());
    }
}
