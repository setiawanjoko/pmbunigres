<?php

namespace App\Http\Controllers\Administrator\Master;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Pengumuman::with(['petugas'])->where([
            ['deskripsi', '!=', '#brochure#']
        ])->get();
        $brochure = Pengumuman::with(['petugas'])->where('deskripsi', '#brochure#')->first();

        return response()->view('administrator.master.pengumuman', compact('data', 'brochure'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'id' => 'nullable',
            'title' => 'required|string',
            'description' => 'required|string',
            'attachment' => 'file|nullable|max:2048|mimes:png,jpg,jpeg,pdf'
        ]);

        try {
            $file = $request->file('attachment');
            if (!is_null($file)){
                $timestamp = Carbon::now()->timestamp;
                $file_urlname = "pengumuman_" . $timestamp . "." . $file->extension();
                $request->file('attachment')->storeAs('public/', $file_urlname);
            } else $file_urlname = null;

            $rawData = [
                'petugas_id' => auth()->user()->id,
                'id' => $validatedData['id'],
                'judul' => $validatedData['title'],
                'deskripsi' => $validatedData['description'],
                'file_url' => $file_urlname,
            ];

            $filteredData = collect($rawData)->filter()->all();

            Pengumuman::updateOrCreate(
                [
                    'id' => $validatedData['id'],
                ],$filteredData);

            $res = [
                'status' => 'success',
                'message' => 'Data pengumuman berhasil dimasukkan'
            ];
        } catch (Exception $e){
            $res = [
                'status' => 'danger',
                'message' => 'Data pengumuman gagal dimasukkan.' . $e->getMessage()
            ];
        }

        return response()->redirectToRoute('administrator.master.pengumuman.index')->with($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $data = Pengumuman::find($id);

        try {
            if(File::delete(storage_path().'/app/public/'.$data->file_url)){
                $data->delete();
                $res = [
                    'status' => 'success',
                    'message' => 'Data pengumuman berhasil dihapus'
                ];
            }
            else $res = [
                'status' => 'warning',
                'message' => 'Data pengumuman gagal dihapus'
            ];
        } catch (Exception $e){
            $res = [
                'status' => 'danger',
                'message' => 'Data pengumuman gagal dihapus.' . $e->getMessage()
            ];
        }

        return response()->redirectToRoute('administrator.master.pengumuman.index')->with($res);
    }

    public function brochureStore(Request $request){
        $input = $request->validate([
            'brochure' => 'required|file|max:2048|mimes:png,jpg,jpeg'
        ]);

        try {
            $file = $request->file('brochure');
            $timestamp = Carbon::now()->timestamp;
            $file_urlname = "brochure_" . $timestamp . "." . $file->extension();
            $request->file('brochure')->storeAs('public/', $file_urlname);

            $rawData = [
                'petugas_id' => auth()->user()->id,
                'file_url' => $file_urlname,
            ];

            $filteredData = collect($rawData)->filter()->all();

            Pengumuman::updateOrCreate(
                [
                    'judul' => 'brochure',
                    'deskripsi' => '#brochure#',
                ],$filteredData);

            $res = [
                'status' => 'success',
                'message' => 'Data brosur berhasil dimasukkan'
            ];
        } catch (Exception $e){
            $res = [
                'status' => 'danger',
                'message' => 'Data brosur gagal dimasukkan.' . $e->getMessage()
            ];
        }

        return response()->redirectToRoute('administrator.master.pengumuman.index')->with($res);
    }

    public function brochureDestroy($id){
        return $this->destroy($id);
    }
}
