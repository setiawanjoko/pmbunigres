<?php

namespace App\Http\Controllers\Administrator\Keuangan;

use App\Exports\PaymentReport;
use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\Pembayaran;
use App\Models\Prodi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $dataProdi = Prodi::all();

        return response()->view('administrator.keuangan.pembayaran', compact('dataProdi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Process a listing of the registrar on a selected major.
     *
     * @param Request $request
     * @return Response
     */
    public function filter(Request $request): Response
    {
        $input = $request->validate([
            'prodi' => 'required|exists:prodi,id'
        ]);

        $dataProdi = Prodi::all();
        $data = User::with([
            'pembayaran' => function($query){
                return $query->orderBy('created_at', 'ASC');
            },
            'prodi',
            'gelombang',
            'kelas'])
            ->whereHas('pembayaran')
            ->where('prodi_id', $input['prodi'])
            ->orderBy('created_at', 'desc

           ')
            ->get();

        return response()->view('administrator.keuangan.pembayaran', compact('data', 'dataProdi'));
    }

    public function report(Request $request)
    {
        $input = $request->validate([
            'prodi' => 'required'
        ]);

        try {
            $prodi = $input['prodi'];

            if($input['prodi'] == 'all') $data = Pembayaran::with(['pendaftar', 'pendaftar.prodi', 'pendaftar.gelombang'])
            ->whereHas('pendaftar', function($query){
                $query->where('permission_id', 2)
                    ->orderBy('gelombang_id', 'ASC')
                    ->orderBy('created_at', 'ASC');
            })
            ->where('status', 1)
            ->get();

            else $data = Pembayaran::with([
                'pendaftar.prodi',
                'pendaftar',
                'pendaftar.gelombang'
            ])
            ->whereHas('pendaftar', function($query) use($prodi){
                $query->where('prodi_id', $prodi)
                    ->where('permission_id', 2)
                    ->orderBy('gelombang_id', 'ASC')
                    ->orderBy('created_at', 'ASC');
            })
            ->where('status', 1)
            ->get();

            return Excel::download(new PaymentReport($data), 'laporan_pembayaran_' . Carbon::now()->format('YmdHis') . '.xlsx');
        } catch (\Exception $e){
            return response()->redirectToRoute('administrator.keuangan.pembayaran.index')->with([
                'status' => 'danger',
                'message' => 'Gagal membuat laporan. ERR_CODE: ' . $e->getMessage()
            ]);
        }
    }

    public function check($id){
        $data = Pembayaran::findOrFail($id);

        if(checkBrivaStatus($data)) {
            $data->status = true;
            $data->save();

            $res = [
                'status' => 'success',
                'message' => 'Tagihan telah dibayarkan. Status bayar telah diperbarui.'
            ];
        } else {
            $res = [
                'status' => 'warning',
                'message' => 'Tagihan belum dibayarkan.'
            ];
        }

        return response()->redirectToRoute('administrator.keuangan.pembayaran.index')->with($res);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function renew($id): RedirectResponse
    {
        $data = Pembayaran::findOrFail($id);

        if(checkBrivaStatus($data)) {
            $data->status = true;
            $data->save();

            $res = [
                'status' => 'warning',
                'message' => 'Tidak dapat memperbarui kode BRIVA. Kode BRIVA telah dibayarkan.'
            ];
        } else {
            if(deleteBriva($data->custCode)){
                $data->delete();

                $paymentType = $data->kategori;
                $user = User::find($data->user_id);
                $costs = $user->biaya();

                $res = createBriva($paymentType, $costs, $user);
            } else $res = [
                'status' => 'danger',
                'message' => 'Gagal memperbarui kode BRIVA.'
            ];
        }

        return response()->redirectToRoute('administrator.keuangan.pembayaran.index')->with($res);
    }

    public function confirm(Request $request){
        $input = Validator::make($request->all(), [
            'brivaNo' => 'required|exists:pembayaran,custCode',
            'invoice' => 'required|file|max:2048|mimes:png,jpg,jpeg,pdf'
        ]);

        if($input->fails()) return response()->redirectToRoute('administrator.keuangan.pembayaran.index')->withErrors($input);

        try {
            $file = $request->file('invoice');
            $file_urlname = "invoice_" . $request->get('brivaNo') . "." . $file->extension();
            $request->file('invoice')->storeAs('public/', $file_urlname);

            $data = Pembayaran::where('custCode', $request->get('brivaNo'))->first();
            $data->bukti_kirim = $file_urlname;
            $data->status = true;
            $data->save();

            updateStatusBriva($data, 'Y');

            $res = [
                'status' => 'success',
                'message' => 'Bukti kirim berhasil diunggah.'
            ];
        } catch (\Exception $e){
            $res = [
                'status' => 'danger',
                'message' => 'Bukti kirim gagal dimasukkan.' . $e->getMessage()
            ];
        }

        return response()->redirectToRoute('administrator.keuangan.pembayaran.index')->with($res);
    }

    public function delete($id){
        $data = Pembayaran::findOrFail($id);

        if(checkBrivaStatus($data)) {
            $data->status = true;
            $data->save();

            $res = [
                'status' => 'warning',
                'message' => 'Tidak dapat menghapus kode BRIVA. Kode BRIVA telah dibayarkan.'
            ];
        } else {
            if(deleteBriva($data->custCode)){
                $data->delete();

                $res = [
                    'status' => 'success',
                    'message' => 'Berhasil menghapus kode BRIVA.'
                ];
            } else $res = [
                'status' => 'danger',
                'message' => 'Gagal menghapus kode BRIVA.'
            ];
        }

        return response()->redirectToRoute('administrator.keuangan.pembayaran.index')->with($res);
    }

    public function getPembayaranProperty($id){
        $data = Pembayaran::with(['pendaftar'])->findOrFail($id);

        return response()->json($data);
    }
}
