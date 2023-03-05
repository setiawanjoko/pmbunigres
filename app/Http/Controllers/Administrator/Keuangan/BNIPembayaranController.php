<?php

namespace App\Http\Controllers\Administrator\Keuangan;

use App\Helpers\BniEnc;
use App\Helpers\BNIPayment;
use App\Http\Controllers\Controller;
use App\Models\Pembayaran as model;
use App\Models\User;
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

    public function renew($id){
        $pembayaran = model::findOrFail($id);
        $user = User::findOrFail($pembayaran->user_id);
        $date = date('c', time() + 24 * 3600);

        try {
            BNIPayment::updateTransaction([
                'trx_id' => json_decode($pembayaran->add_info)->trx_id,
                'trx_amount' => $pembayaran->amount,
                'customer_name' => $user->nama,
                'datetime_expired' => $date,
            ]);
            $pembayaran->update([
                "expiredDate" => date("Y-m-d H:i:s", strtotime($date))
            ]);

            return redirect()->route('administrator.keuangan.pembayaran.index')->with([
                'status' => 'success',
                'message' => 'Pembayaran berhasil diperbarui.'
            ]);
        } catch (\Throwable $e) {
            dd($e);
        }
    }
}
