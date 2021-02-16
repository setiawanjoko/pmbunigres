<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    public function index(): Response
    {
        return response()->view('auth.register');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);

        try {
            $user = User::create([
                'nama' => $data['nama'],
                'email' => $data['email'],
                'password' => bcrypt($data['password'])
            ]);

            return redirect()->back()->with('status', 'Harap periksa email anda untuk melanjutkan proses pendaftaran.');
        } catch(Exception $e) {
            return redirect()->back()->with('status', $e->getMessage());
        }
    }
}
