<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pengumuman;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index() {
        $data = DB::select('SELECT p.id,p.judul,p.deskripsi,CONCAT(u.nama,\' | \',date(p.created_at)) AS publish
                            FROM pengumuman p
                            LEFT OUTER JOIN users u ON p.petugas_id = u.id
                            ORDER BY p.created_at desc');

        return view('admin.master.pengumuman',compact('data'));
    }

    public function store(Request $request) {

        $data = $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
            'file_url' => 'file|nullable|max:2000|mimes:png,jpg,jpeg,pdf',
        ]);

        $file = $request->file('file_url');
        $file_urlname = null;
        if (!is_null($file)){
            $fileName = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
            $file_urlname = $fileName . "_pengumuman." . $file->extension();
            $request->file('file_url')->storeAs('public/', $file_urlname);
        } else $file_urlname = null;


        try {

            Pengumuman::create([
                'petugas_id' => auth()->user()->id,
                'judul' => $data['judul'],
                'deskripsi' => $data['deskripsi'],
                'file_url' => $file_urlname,
            ]);

            return response()->redirectToRoute('admin.pengumuman.index');
        } catch(\Exception $e) {
            if(Storage::exists('public/' . $file_urlname)) Storage::delete('public/' . $file_urlname);
            dd($e->getMessage());
        }
    }

    public function destroy($id)
    {
        $pengumuman = Pengumuman::find($id);
        $pengumuman->delete();
        return response()->redirectToRoute('admin.pengumuman.index');
    }
}
