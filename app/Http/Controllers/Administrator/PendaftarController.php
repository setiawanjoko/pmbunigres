<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Exports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;

class PendaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($filter = null): Response
    {
        $data = User::with(['prodi'])->where('permission_id', 2)->get();

        if(!is_null($filter)){
            $data = User::with(['prodi'])->where([
                ['permission_id', 2],
                ['prodi_id', $filter]
            ])->get();
        }

        $pendaftarHariIni = User::with(['prodi'])->where('permission_id', 2)->whereDate('created_at', Carbon::today()->toDateString())->count();
        $tesOnline = User::with(['prodi'])->where('permission_id', 2)->get()
            ->filter(function($item) {
                return $item->progres === 'tes online';
            })->count();
        $daftarUlang = User::with(['prodi'])->where('permission_id', 2)->get()
            ->filter(function($item) {
                return $item->progres === 'daftar ulang';
            })->count();
        $dataProdi = Prodi::all();

        return response()->view('administrator.monitoring.pendaftar.index', compact('data', 'pendaftarHariIni', 'tesOnline', 'daftarUlang', 'dataProdi'));
    }

    public function filter(Request $request): Response
    {
        $data = $request->validate([
            'prodi' => 'required|exists:prodi,id'
        ]);

        return $this->index($data['prodi']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::find($id);

        return response()->view('administrator.monitoring.pendaftar.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function exportExcel(){
        return Excel::download(new StudentExport(), 'export.xlsx');
    }

    public function exportCSV(){
        return Excel::download(new StudentExport(), 'export.csv');
    }
}
