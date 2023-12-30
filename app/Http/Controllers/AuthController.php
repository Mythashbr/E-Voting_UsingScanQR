<?php

namespace App\Http\Controllers;

use App\Models\DetailPemilihan;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user) {
            if (Auth::attempt($credentials)) {

                // cek role
                if (Auth::user()->id_role == '1') {
                    $request->session()->regenerate();
                    return redirect('/user')->with('success', 'Anda berhasil login');
                } else {
                    $request->session()->regenerate();

                    return redirect('/')->with('login', 'Anda berhasil login');
                }
            } else {
                return  redirect()->back()->with('errorpassword', 'Password salah');
            }
        } else {
            return  redirect()->back()->with('errorusername', 'Username salah');
        }
    }

    public function logout(Request $request)
    {
        // cek role
        if (Auth::user()->id_role == '1') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login')->with('success', 'Anda berhasil logout');
        } else {

            // cek apakah sudah memilih 2 kali
            $user = User::where('id', Auth::user()->id)->first();
            $detailPemilihan = DetailPemilihan::where('id_user', $user->id)->get();

            if (count($detailPemilihan) == 2) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('/')->with('logout', 'Anda berhasil logout');
            } else {
                return redirect('/')->with('pilihdulu', 'Anda belum memilih 2 kali');
            }
        }
    }
}
