<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function register(){
        return view("pages.akun.register");
    }

    public function storeRegister(Request $request){
        // Validasi input
        $request->validate([
            'nama'      => 'required|max:255',
            'no_hp'     => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required',
        ],[
            'nama.required'         => 'Nama harus diisi',
            'nama.max'              => 'Nama maksimal 255 karakter',
            'no_hp.required'        => 'no hp harus benar',
            'email.required'        => 'Email harus diisi',
            'email.unique'          => 'Email sudah terdaftar',
            'password.required'     => 'Password harus diisi',
            'password.min'          => 'Password harus minimal 8 karakter',
        ]);

        // Simpan user baru
        User::create([
            'nama'     => $request->nama,
            'no_hp'    => $request->no_hp,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => $request->role
        ]);

        // Redirect ke halaman login setelah berhasil registrasi
        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login');
    }


    public function login(){
        return view("pages.akun.login");
    }

    public function storeLogin(Request $request){
        // Validasi input login
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Mencoba login
        if (Auth::attempt($credentials)) {
            // Regenerasi session untuk keamanan
            $request->session()->regenerate();

            // Redirect ke dashboard setelah login sukses
            return redirect()->intended('/index');
        } else {
            // Redirect kembali ke login dengan pesan error jika gagal
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->onlyInput('email');
        }
    }


    public function logout(Request $request){
        Auth::logout();

        // Invalidasi session dan token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login setelah logout
        return redirect('/login');
    }

}
