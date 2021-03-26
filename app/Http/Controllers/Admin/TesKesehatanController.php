<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TesKesehatanController extends Controller
{
    public function index() {
        $data = User::whereHas('prodi', function($query){
            return $query->where('tes_kesehatan', true);
        })->get();

        return response()->view('admin.data.tes-kesehatan', compact('data'));
    }

    public function store(){
        //
    }

    public function edit($id){
        $data = User::find($id);

        $data->tes_kesehatan = true;
        $data->save();

        return $this->index();
    }
}
