<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\MoodleAccount;
use App\Models\Prodi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TesOnlineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
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

        $dataProdi = Prodi::all();

        return response()->view('administrator.monitoring.tes-online.index', compact('data', 'dataProdi'));
    }

    public function filter(Request $request): Response
    {
        $data = $request->validate([
            'prodi' => 'required|exists:prodi,id'
        ]);

        return $this->index($data['prodi']);
    }

    public function medicalAction($id, $action): RedirectResponse
    {
        $data = User::find($id);

        if(is_null($data)) return response()->redirectToRoute('administrator.monitoring.tes-online.index')->with(['status' => 'danger', 'message' => 'Data tidak ditemukan.']);

        $data->tes_kesehatan = $action;
        $data->tes_kesehatan_at = Carbon::now('Asia/Jakarta');
        $data->save();

        return response()->redirectToRoute('administrator.monitoring.tes-online.index')->with(['status' => 'success', 'message' => 'Data berhasil diubah']);
    }

    public function academicAction(Request $request){
        $validatedData = $this->validate($request, [
            'id' => 'required|exists:users,id',
            'academicGrade' => 'required|numeric'
        ]);

        $data = User::find($validatedData['id']);

        if(is_null($data->moodleAccount)) {
            MoodleAccount::create([
                'user_id' => $validatedData['id'],
                'nilai_tpa' => $validatedData['academicGrade']
            ]);

            return response()->redirectToRoute('administrator.monitoring.tes-online.index')->with(['status' => 'success', 'message' => 'Data berhasil diubah']);
        }

        $data = MoodleAccount::where('user_id', $data->id)->first();
        $data->nilai_tpa = $validatedData['academicGrade'];
        $data->save();

        return response()->redirectToRoute('administrator.monitoring.tes-online.index')->with(['status' => 'success', 'message' => 'Data berhasil diubah']);
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
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
