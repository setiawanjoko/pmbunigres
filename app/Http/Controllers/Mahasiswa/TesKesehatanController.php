<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\MoodleAccount;
use Illuminate\Http\Request;

class TesKesehatanController extends Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = auth()->user();

            if(!$user->tes_kesehatan_kelas) {
                return response()->redirectToRoute('tes-online.akademik');
            }else{
                return $next($request);
            }
        });
    }

    public function index(){
        $user = auth()->user();
        $prodi = $user->prodi;
        $dataMoodle = MoodleAccount::where('user_id', auth()->user()->id)->first();

        return response()->view('mahasiswa.tes-kesehatan', compact('prodi', 'dataMoodle'));
    }
}
