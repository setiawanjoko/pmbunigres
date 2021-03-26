<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenjang;

class JenjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenjang = Jenjang::latest()->paginate(5);
        //return $jenjang->toJson();
        return view('jenjang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Jenjang $id)
    {
        try {
            return view('jenjang.show',compact('id'));
        } catch (\Throwable $th) {
            return redirect()->back()->with(['status' => 'danger', 'message' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Jenjang $id)
    {
        try {
            return view('jenjang.edit',compact('id'));
        } catch (\Throwable $th) {
            return redirect()->back()->with(['status' => 'danger', 'message' => $th->getMessage()]);
        }
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
    public function destroy(Jenjang $id)
    {
        try {
            $id->destroy();
        } catch (\Throwable $th) {
            return redirect()->back()->with(['status' => 'danger', 'message' => $th->getMessage()]);
        }
    }
}
