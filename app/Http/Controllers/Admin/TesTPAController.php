<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServerSetting;
use Illuminate\Http\Request;
use MongoDB\Driver\Server;

class TesTPAController extends Controller
{
    public function index() {
        $data = ServerSetting::where('key', 'link_tes_tpa')->first();

        return response()->view('admin.pengaturan.tes-tpa', compact('data'));
    }

    public function store(Request $request) {
        $data = $this->validate($request, [
            'link' => 'required|string'
        ]);

        try {
            $query = parse_url($data['link'], PHP_URL_PATH );
            if (strpos($query, "/course/view.php") !== false) {
                $query = parse_url($data['link'], PHP_URL_QUERY );
                parse_str($query, $output);

                if(!is_null($output['id'])) {
                    ServerSetting::updateOrCreate(
                        ['key' => 'link_tes_tpa'],
                        ['value' => $data['link']]
                    );

                    ServerSetting::updateOrCreate([
                        'key' => 'module_id_tes_tpa',
                    ],[
                        'value' => $output['id']
                    ]);

                    return redirect()->back()->with([
                        'status' => 'success',
                        'message' => 'Link Tes TPA berhasil disimpan'
                    ]);
                }
            }

            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Pastikan link sesuai dengan format'
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
