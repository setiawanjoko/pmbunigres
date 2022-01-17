<?php

namespace App\Http\Controllers\Administrator\Pengaturan;

use App\Http\Controllers\Controller;
use App\Models\ServerSetting;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class TandatanganSKLController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $data = ServerSetting::where('key', 'loa-signature')->first();

        return response()->view('administrator.pengaturan.loa-signature', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'tandatangan' => ['required', 'file', 'mimes:jpeg,jpg,png', 'max:150',
                Rule::dimensions()->maxWidth(760)->maxHeight(360)->minHeight(360)->minWidth(760)]
        ]);

        try {
            $file = $request->file('tandatangan');
            $file_urlname = "loa-signature." . $file->extension();
            $request->file('tandatangan')->storeAs('public/', $file_urlname);

            ServerSetting::updateOrCreate([
                'key' => 'loa-signature'
            ],[
                'value' => $file_urlname
            ]);

            $res = [
                'status' => 'success',
                'message' => 'Berhasil menambahkan tandatangan.'
            ];
        } catch (\Exception $e){
            $res = [
                'status' => 'danger',
                'message' => 'Gagal menambahkan tandatangan. ERR_CODE: '.$e->getMessage()
            ];
        }

        return response()->redirectToRoute('administrator.pengaturan.skl.index')->with($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $data = ServerSetting::findOrFail($id);

        try {
            $data->delete();

            $res = [
                'status' => 'success',
                'message' => 'Data berhasil dihapus'
            ];
        } catch (\Exception $e){
            $res = [
                'status' => 'danger',
                'message' => 'Data gagal dihapus. ERR_CODE: ' . $e->getMessage()
            ];
        }

        return response()->redirectToRoute('administrator.pengaturan.skl.index')->with($res);
    }
}
