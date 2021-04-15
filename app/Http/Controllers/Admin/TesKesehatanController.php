<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TesKesehatanController extends Controller
{
    public function index() {
        $data = User::whereHas('kelas', function($query){
            return $query->where('tes_kesehatan', 1);
        })->get();

        return response()->view('admin.data.tes-kesehatan', compact('data'));
    }

    public function edit($id, $aksi){
        $data = User::find($id);

        $data->tes_kesehatan_at = Carbon::now('Asia/Jakarta');
        if($aksi == 'tolak'){
            $data->tes_kesehatan = false;
        } else if($aksi == 'terima'){
            $data->tes_kesehatan = true;
        }
        $data->save();

        return $this->index();
    }
}
