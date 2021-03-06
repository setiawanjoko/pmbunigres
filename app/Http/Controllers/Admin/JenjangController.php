<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jenjang;
use App\Models\Prodi;
use Illuminate\Http\Request;

class JenjangController extends Controller
{
    public function index() {
        $data = Jenjang::all();

        return response()->view('admin.master.jenjang');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'nama' => 'required|string'
        ]);

        try {
            Jenjang::create([
                'nama' => $data['nama']
            ]);

            return response()->redirectToRoute('admin.jenjang');
        } catch(\Exception $e) {
            dd($e->getMessage());
        }
    }
    public function destroy($id)
    {
        $count = Prodi::where('jenjang_id', $id)->whereHas('pendaftar')->count();

        if($count == 0) {
            $jenjang = Jenjang::find($id);

            $jenjang->delete();

            return response()->redirectToRoute('admin.jenjang');
        } else {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Terdapat pendaftar pada jenjang ini.'
            ]);
        }
    }
}
