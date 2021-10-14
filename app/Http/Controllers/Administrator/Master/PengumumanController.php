<?php

namespace App\Http\Controllers\Administrator\Master;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pengumuman::with(['petugas'])->get();

        return response()->view('administrator.master.pengumuman', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
            $file_urlname = null;
            if (!is_null($file)){
                $fileName = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
                $file_urlname = $fileName . "_pengumuman." . $file->extension();
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
        } catch (\Exception $e){
            $res = [
                'status' => 'danger',
                'message' => 'Data pengumuman gagal dimasukkan.' . $e->getMessage()
            ];
        }

        return response()->redirectToRoute('administrator.master.pengumuman.index')->with($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
