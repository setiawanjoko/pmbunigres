<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\ServerSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use MongoDB\Driver\Server;

class LinkTesTPAController extends Controller
{
    public function index() {/*
        $moodleUrl = env('MOODLE_APP_SOCKET');
        $moodleToken = env('MOODLE_ADMIN_TOKEN');
        $courses = array();

        $res = Http::post($moodleUrl . "webservice/rest/server.php?wstoken=$moodleToken&wsfunction=core_course_get_courses&moodlewsrestformat=json");
        $response = json_decode($res->body());

        foreach ($response as $key => $course){
            if($course->format == "topics") array_push($courses, $response[$key]);
        }*/

        return response()->view('mahasiswa.link-tes');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'link' => 'required',
            'course_id' => 'nullable'
        ]);

        try {
            ServerSetting::updateOrCreate([
                'key' => 'link_tes_tpa',
            ],[
                'value' => $data['link']
            ]);

            if(is_null($data['course_id'])) {
                $query = parse_url($data['link'], PHP_URL_QUERY );
                parse_str($query, $output);

                $data['course_id'] = $output['id'];
            }

            ServerSetting::updateOrCreate([
                'key' => 'course_id_tes_tpa',
            ],[
                'value' => $data['course_id']
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
