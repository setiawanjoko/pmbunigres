<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $totalRegistrar = User::all()->count();
        $pendaftarHariIni = User::with(['prodi'])
            ->where('permission_id', 2)
            ->whereDate('created_at', Carbon::today()
                ->toDateString())->count();
        $tesOnline = User::with(['prodi'])->where('permission_id', 2)->get()
            ->filter(function($item) {
                return $item->progres === 'tes online';
            })->count();
        $daftarUlang = User::with(['prodi'])->where('permission_id', 2)->get()
            ->filter(function($item) {
                return $item->progres === 'daftar ulang';
            })->count();

        return response()->view('administrator.dashboard', compact('totalRegistrar', 'pendaftarHariIni', 'tesOnline', 'daftarUlang'));
    }
}
