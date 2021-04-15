<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @return string
     * @var string
     */
    public function redirectPath(): string
    {
        $user = Auth::user();
        if($user->can('admin')) return '/admin/monitoring/pendaftar/';
        else if($user->can('camaba')) return '/biodata';
        else if($user->can('keuangan')) return '/admin/pengaturan-gelombang';
        else if($user->can('monitor')) return '/admin/monitoring/pendaftar/';
        else if($user->can('kesehatan')) return '/admin/tes-kesehatan';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $gate = Gate::inspect('admin');

        if($gate) $this->redirectTo = '/admin/tes-tpa';
        $this->middleware('guest')->except('logout');
    }
}
