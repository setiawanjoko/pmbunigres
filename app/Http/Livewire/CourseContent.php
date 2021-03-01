<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CourseContent extends Component
{
    public $courses = array();
    public $chosenCourse;
    public $contents = array();
    public $chosenContent;
    public $modules = array();
    public $chosenModule;
    public $moodleUrl;
    public $moodleToken;

    protected $listeners = [
        'courseChange' => 'courseChangeListener',
        'contentChange' => 'contentChangeListener'
    ];

    public function mount() {
        $this->moodleUrl = env('MOODLE_APP_SOCKET');
        $this->moodleToken = env('MOODLE_ADMIN_TOKEN');
        $res = Http::post($this->moodleUrl . "webservice/rest/server.php?wstoken=$this->moodleToken&wsfunction=core_course_get_courses&moodlewsrestformat=json");
        $response = json_decode($res->body());

        foreach ($response as $key => $course) {
            if ($course->format == "topics") array_push($this->courses, json_decode(json_encode($response[$key], true), true));
        }
    }

    public function render()
    {
        $this->contents = array();

        return view('livewire.course-content');
    }

    public function courseChangeListener(){
        $res = Http::post($this->moodleUrl . "webservice/rest/server.php?wstoken=$this->moodleToken&wsfunction=core_course_get_contents&moodlewsrestformat=json&courseid=$this->chosenCourse");
        $response = json_decode($res->body());

        foreach ($response as $key => $content) {
            array_push($this->contents, json_decode(json_encode($response[$key], true), true));
        }
    }

    public function contentChangeListener(){
        $res = Http::post($this->moodleUrl . "webservice/rest/server.php?wstoken=$this->moodleToken&wsfunction=core_course_get_course_module&moodlewsrestformat=json&courseid=$this->chosenCourse");
        $response = json_decode($res->body());

        foreach ($response as $key => $content) {
            array_push($this->contents, json_decode(json_encode($response[$key], true), true));
        }
    }
}
