<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $data = DB::select('SELECT p.id,p.judul,p.deskripsi,p.file_url,CONCAT(u.nama,\' | \',date(p.created_at)) AS publish
//                            FROM pengumuman p
//                            LEFT OUTER JOIN users u ON p.petugas_id = u.id
//                            WHERE p.deskripsi != "#brochure#"
//                            ORDER BY p.created_at desc
//                            LIMIT 2');
        $data = Pengumuman::where('deskripsi', '!=', '#brochure#')->orderBy('created_at', 'desc')->limit(2)->get()->toArray();
        $brochure = Pengumuman::where('deskripsi', '#brochure#')->first();

        return view('welcome',compact('data', 'brochure'));
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
        //
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
}
