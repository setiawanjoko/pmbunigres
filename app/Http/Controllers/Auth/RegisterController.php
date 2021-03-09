<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Jenjang;
use App\Models\Prodi;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/email/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $dataProdi = Jenjang::with('prodi')->get();

        return view('auth.register', compact('dataProdi'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $prodi = Prodi::find($data['prodi']);
        $arr = array();
        if($prodi->pagi) {
            array_push($arr, 'pagi');
        }
        if($prodi->siang) {
            array_push($arr, 'siang');
        }
        if($prodi->sore) {
            array_push($arr, 'sore');
        }
        if($prodi->malam) {
            array_push($arr, 'malam');
        }

        return Validator::make($data, [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'informasi' => ['required', 'in:sosial_media,teman_saudara,lainnya'],
            'no_telepon' => ['required', 'string'],
            'kelas' => ['required', Rule::in($arr)],
            'prodi' => ['required', 'exists:prodi,id'],
            'jalur_masuk' => ['required', 'in:reguler,transfer,pindahan,lanjutan']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'informasi' => $data['informasi'],
            'no_telepon' => $data['no_telepon'],
            'kelas' => $data['kelas'],
            'prodi_id' => $data['prodi'],
            'jalur_masuk' => $data['jalur_masuk']
        ]);
    }
}
