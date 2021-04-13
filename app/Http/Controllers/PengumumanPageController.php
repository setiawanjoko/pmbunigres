<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PengumumanPageController extends Controller
{
    
    public function index()
    {
        $data = DB::select('SELECT p.id,p.judul,p.deskripsi,p.file_url,CONCAT(u.nama,\' | \',date(p.created_at)) AS publish
                            FROM pengumuman p
                            LEFT OUTER JOIN users u ON p.petugas_id = u.id
                            ORDER BY p.created_at desc
                            LIMIT 10');

        return view('pengumuman',compact('data'));
    }
}
