<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class GelombangController extends Controller
{
    public function index() {
        $data = Gelombang::all();

        Return response()->view('admin.master.gelombang');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'gelombang' => 'required|string',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date'
        ]);

        try {
            Gelombang::create([
                'gelombang' => $data['gelombang'],
                'tgl_mulai' => $data['tgl_mulai'],
                'tgl_selesai' => $data['tgl_selesai']
            ]);
            
            return response()->redirectTo('admin.gelombang');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    // public function destroy($id) {
    //     $count = 
    // }
}
