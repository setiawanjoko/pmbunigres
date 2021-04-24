<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use App\Models\JalurMasuk;
use App\Models\JamMasuk;
use App\Models\Jenjang;
use App\Models\Prodi;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\isNan;
use function PHPUnit\Framework\isNull;

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
        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Http\RedirectResponse
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'no_telepon' => ['required', 'string'],
            'jamMasuk' => ['required', 'exists:jam_masuk_kelas,id'],//Rule::in($jamMasukValidation)],
            'prodi' => ['required', 'exists:prodi,id'],
            'jalur_masuk' => ['required', 'integer'],//Rule::in($jalurMasukValidation)],
            'lulusan_unigres' => ['nullable', 'boolean'],
            'kelas' => 'required|exists:kelas,id'
            ]);
        }

        /**
         * Create a new user instance after a valid registration.
         *
         * @param  array  $data
         * @return \App\Models\User
         */
    protected function create(array $data) {
        $gelombang = Gelombang::where([
            ['tgl_mulai', '<=', Carbon::today()],
            ['tgl_selesai', '>=', Carbon::today()]
        ])->first();
        if(is_null($gelombang)) return response()->redirectToRoute('register')->with([
            'status' => 'danger',
            'message' => 'Saat ini tidak ada gelombang pendaftaran yang dibuka.'
        ]);

        return User::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'no_telepon' => $data['no_telepon'],
            'jam_masuk_id' => $data['jamMasuk'],
            'prodi_id' => $data['prodi'],
            'jalur_masuk_id' => $data['jalur_masuk'],
            'gelombang_id' => $gelombang->id,
            'kelas_id' => $data['kelas'],
            'lulusan_unigres' => (empty($data['lulusan_unigres'])) ? 0 : $data['lulusan_unigres'] ,
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $gelombang = Gelombang::where([
            ['tgl_mulai', '<=', Carbon::today()],
            ['tgl_selesai', '>=', Carbon::today()]
        ])->first();

        if(is_null($gelombang)) return response()->redirectToRoute('register')->with([
            'status' => 'danger',
            'message' => 'Saat ini tidak ada gelombang pendaftaran yang dibuka.'
        ]);

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }
}
