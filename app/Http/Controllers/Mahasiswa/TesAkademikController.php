<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\MoodleAccount;
use App\Models\ServerSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TesAkademikController extends Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            if(auth()->user()->progres == 'registrasi' || auth()->user()->progres == 'biodata') {
                return response()->redirectToRoute('berkas.create');
            }else{
                return $next($request);
            }
        });
    }

    public function index() {
        $dataMoodle = MoodleAccount::where('user_id', auth()->user()->id)->first();
        if(is_null($dataMoodle)) {
            $dataMoodle = $this->createMoodleAccount();
        }

        if(is_null($dataMoodle->nilai_tpa)) {
            $dataMoodle->nilai_tpa = $this->checkNilai($dataMoodle->moodle_user_id);

            $dataMoodle->save();
        }

        $dataLink = ServerSetting::where('key', 'link_tes_tpa')->first();

        return response()->view('mahasiswa.tes-akademik', compact('dataMoodle', 'dataLink'));
    }

    private function createMoodleAccount() {
        $randomAlfaSmall = str_shuffle('abcdefghjklmnopqrstuvwxyz');
        $randomAlfaBig = str_shuffle('ABCDEFGHJKLMNOPQRSTUVWXYZ');
        $randomNumeric = str_shuffle('1234567890');
        $randomSymbol = str_shuffle('!$^.,');
        $password = substr($randomAlfaSmall, 0, 3) . substr($randomAlfaBig, 0, 3) . substr($randomNumeric, 0, 3) . substr($randomSymbol, 0, 3);
        $biodata = auth()->user()->biodata;
        $firstname = $biodata->nama_depan;
        $lastname = $biodata->nama_belakang;
        $email = auth()->user()->email;
        $username = $biodata->no_pendaftaran;

        $moodleUrl = env('MOODLE_APP_SOCKET');
        $moodleToken = env('MOODLE_ADMIN_TOKEN');
        try {

            $res = Http::post($moodleUrl . "webservice/rest/server.php?wstoken=$moodleToken&wsfunction=auth_email_signup_user&moodlewsrestformat=json&username=$username&email=$email&password=$password&firstname=$firstname&lastname=$lastname");
            $response = json_decode($res->body());

            if($response->success) {
                $res = Http::post($moodleUrl . "webservice/rest/server.php?wstoken=$moodleToken&wsfunction=core_user_get_users&moodlewsrestformat=json&criteria[0][key]=username&criteria[0][value]=$username");
                $response = json_decode($res->body());
                $userData = $response->users[0];

                if(!is_null($userData)) {
                    $data = MoodleAccount::create([
                        'moodle_username' => $userData->username,
                        'moodle_default_password' => $password,
                        'moodle_email' => $userData->email,
                        'moodle_firstname' => $userData->firstname,
                        'moodle_lastname' => $userData->lastname,
                        'moodle_user_id' => $userData->id,
                        'user_id' => auth()->user()->id,
                        'nilai_tpa' => null,
                    ]);

                    return $data;
                } else return false;
            } else abort(503);
        } catch (\Exception $e) {
            dd($e->getMessage());
            abort(500);
        }
    }

    public function checkNilai(int $id) {
        $moodleUrl = env('MOODLE_APP_SOCKET');
        $moodleToken = env('MOODLE_ADMIN_TOKEN');
        $final=null;

        $res = Http::post($moodleUrl . "webservice/rest/server.php?wstoken=$moodleToken&wsfunction=gradereport_overview_get_course_grades&moodlewsrestformat=json&userid=$id");
        $response = json_decode($res->body());

        $courseID = ServerSetting::where('key', 'module_id_tes_tpa')->first();
        if (!is_null($courseID)) {
            if (!empty($response->grades)) {
                foreach ($response->grades as $grade) {
                    if($grade->courseid == $courseID->value) {
                        if (!empty($grade->rawgrade)) {
                            $final = $grade->rawgrade;
                            break;
                        }
                    }
                }
            } else {
                $final =null;
            }
        }

        return $final;
    }
}
