<?php

namespace App\Http\Controllers;

use App\Models\Gelombang;
use App\Models\JalurMasuk;
use App\Models\JamMasuk;
use App\Models\Jenjang;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisNersController extends Controller
{
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
    
    
    protected function validator(array $data){
        $kelas =  DB::table('kelas')->where('prodi_id',9)->where('lulusan_unigres',$data['lulusan_unigres'])->get();
        $kelasValidation = array();
        foreach($kelas as $k){
            array_push($kelasValidation, $k->id);
        }
        
        return Validator::make($data,[
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'informasi' => ['required', 'in:sosial_media,teman_saudara,lainnya'],
            'no_telepon' => ['required', 'string'],
            'kelas' => ['required', Rule::in($kelasValidation)],
            'lulusan_unigres' => ['required', 'boolean'],
        ]);        
    }

    protected function create(array $data){
        $gelombang = Gelombang::where([
            ['tgl_mulai', '<=', Carbon::today()],
            ['tgl_selesai', '>=', Carbon::today()]
        ])->first();

        $jam_masuk_id = DB::table('jam_masuk_kelas')->where('kelas_id',$data['kelas'])->first();

        //dd($jam_masuk_id);
        //dd($gelombang);

        $jalur_masuk = 1;
        if ($data['lulusan_unigres']) {
            $jalur_masuk = 4;
        }else{  
            $jalur_masuk = 1;
        }

        try {
            User::create([
                'nama' => $data['nama'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'informasi' => $data['informasi'],
                'no_telepon' => $data['no_telepon'],
                'jam_masuk_id' => $jam_masuk_id->id,
                'prodi_id' => 9,
                'jalur_masuk_id' => $jalur_masuk,
                'gelombang_id' => $gelombang->id,
                'lulusan_unigres' => $data['lulusan_unigres']
            ]);
            return response()->redirectToRoute('homepage');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$dataProdi = Jenjang::with('prodi')->get();
        //$dataJalurMasuk = DB::table('jalur_masuk')->get();//JalurMasuk::all();
        $dataJamMasuk = DB::table('kelas')->where('prodi_id','9')->get();

        return view('regis-ners', compact('dataJamMasuk'));
    }

    public function get_kelas($id, $lulusan_unigres){
        $dataJamMasuk = DB::table('kelas')->where('prodi_id',$id)->where('lulusan_unigres',$lulusan_unigres)->get();
        return $dataJamMasuk;
    }

    public function store(Request $request)    {
        //dd($request['lulusan_unigres']);
        $kelas =  DB::table('kelas')->where('prodi_id',9)->where('lulusan_unigres',$request['lulusan_unigres'])->get();
        $kelasValidation = array();
        foreach($kelas as $k){
            array_push($kelasValidation, $k->id);
        }
        
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'informasi' => ['required', 'in:sosial_media,teman_saudara,lainnya'],
            'no_telepon' => ['required', 'string'],
            'kelas' => ['required', Rule::in($kelasValidation)],
            'lulusan_unigres' => ['required', 'boolean'],
        ]);

        $gelombang = Gelombang::where([
            ['tgl_mulai', '<=', Carbon::today()],
            ['tgl_selesai', '>=', Carbon::today()]
        ])->first();

        $jam_masuk_id = DB::table('jam_masuk_kelas')->where('kelas_id',$data['kelas'])->first();

        //dd($jam_masuk_id);
        //dd($gelombang);

        $jalur_masuk = 1;
        if ($data['lulusan_unigres']) {
            $jalur_masuk = 4;
        }else{  
            $jalur_masuk = 1;
        }

        try {
            User::create([
                'nama' => $data['nama'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'informasi' => $data['informasi'],
                'no_telepon' => $data['no_telepon'],
                'jam_masuk_id' => $jam_masuk_id->id,
                'prodi_id' => 9,
                'jalur_masuk_id' => $jalur_masuk,
                'gelombang_id' => $gelombang->id,
                'lulusan_unigres' => $data['lulusan_unigres']
            ]);
            return response()->redirectToRoute('homepage');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        
    }

    
}
