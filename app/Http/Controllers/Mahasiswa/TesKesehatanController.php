<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TesKesehatanController extends Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = auth()->user();
            $prodi = $user->prodi;

            if(!$prodi->tes_kesehatan) {
                return response()->redirectToRoute('daftar-ulang');
            }else{
                return $next($request);
            }
        });
    }

    public function index(){
        $user = auth()->user();
        $prodi = $user->prodi;

        return response()->view('mahasiswa.tes-kesehatan', compact('prodi'));
    }
}
