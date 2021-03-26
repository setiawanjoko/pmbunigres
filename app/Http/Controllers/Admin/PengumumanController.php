<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengumumanController extends Controller
{
    public function index() {
        $data = DB::select('SELECT p.id,p.judul,p.deskripsi,CONCAT(u.nama,\' | \',p.created_at) AS publish
                            FROM pengumuman p
                            LEFT OUTER JOIN users u ON p.petugas_id = u.id
                            ORDER BY p.created_at desc');

        return view('admin.master.pengumuman',compact('data'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        try {
            Pengumuman::create([
                'petugas_id' => auth()->user()->id,
                'judul' => $data['judul'],
                'deskripsi' => $data['deskripsi'],
            ]);

            return response()->redirectToRoute('admin.pengumuman.index');
        } catch(\Exception $e) {
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
