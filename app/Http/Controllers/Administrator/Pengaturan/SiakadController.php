<?php

namespace App\Http\Controllers\Administrator\Pengaturan;

use App\Http\Controllers\Controller;
use App\Models\ServerSetting;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SiakadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = ServerSetting::where('key', 'access_token_siakad')->first();

        return response()-> view('administrator.pengaturan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'accessToken' => 'required'
        ]);

        try{
            $data = ServerSetting::updateOrCreate([
                'key' => 'access_token_siakad'
            ],[
                'value' => $validatedData['accessToken']
            ]);

            $res = [
                'status' => 'success',
                'message' => 'Berhasil menyimpoan pengaturan'
            ];
        }catch (Exception $e){
            $res = [
                'status' => 'danger',
                'message' => 'Gagal menyimpan pengaturan. ERR_CODE: ' . $e->getMessage()
            ];
        }

        return response()->redirectToRoute('administrator.pengaturan.siakad.index')->with($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
