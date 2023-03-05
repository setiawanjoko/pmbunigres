<?php

namespace App\Http\Controllers\Administrator\Keuangan;

use App\Helpers\BniEnc;
use App\Helpers\BNIPayment;
use App\Http\Controllers\Controller;
use App\Models\Pembayaran as model;
use Illuminate\Http\Request;

class BNIPembayaranController extends Controller
{
    public function delete($id){
        $pembayaran = model::findOrFail($id);

        // BNI check status
        $addInfo = json_decode($pembayaran->add_info);
        $bniInquiry = BNIPayment::inquiryBilling($addInfo->trx_id);
        try {
            if ($bniInquiry['va_status'] !== 1){
                $pembayaran->delete();
                return redirect()->route('administrator.keuangan.pembayaran.index')->with([
                    'status' => 'success',
                    'message' => 'Berhasil menghapus kode BNI.'
                ]);
            } else {
                return redirect()->route('administrator.keuangan.pembayaran.index')->with([
                    'status' => 'danger',
                    'message' => 'Tidak dapat menghapus kode BNI. Kode BNI sudah dibayar di bayar.'
                ]);
            }

        } catch(\Throwable $e) {
            dd(e);
        }
    }

    public function checkPayment ($id)
    {
        $pembayaran = model::findOrFail($id);

        // BNI check status
        $addInfo = json_decode($pembayaran->add_info);
        $bniInquiry = BNIPayment::inquiryBilling($addInfo->trx_id);
        try {
            if (is_null($bniInquiry['payment_ntb'])){
                return redirect()->route('administrator.keuangan.pembayaran.index')->with([
                    'status' => 'warning',
                    'message' => 'Belum dibayar.'
                ]);
            } else {
                return redirect()->route('administrator.keuangan.pembayaran.index')->with([
                    'status' => 'success',
                    'message' => 'Sudah dibayar.'
                ]);
            }
        } catch (\Throwable $e){
            dd($e);
        }

    }
}
