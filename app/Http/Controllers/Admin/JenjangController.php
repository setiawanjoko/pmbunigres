<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jenjang;
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
}
