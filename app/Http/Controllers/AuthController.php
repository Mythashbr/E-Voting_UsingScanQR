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
        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required',
                'qr_code' => 'required' // Menambahkan validasi untuk qr_code
            ]);

            $user = User::where('username', $request->username)->first();

            if (!$user) {
                error_log("Username not found: " . $request->username);
                return redirect()->back()->with('error', 'Username salah');
            }

            // Lakukan proses login dengan username dan password
            $credentials = $request->only('username', 'password');

            // Validasi nomor anggota dengan yang ada di database
            if ($request->qr_code != $user->id_anggota) {
                error_log("Invalid membership number from QR Code: " . $request->qr_code . ", User ID Anggota: " . $user->id_anggota);
                return redirect()->back()->with('error', 'Nomor Anggota Tidak Valid');
            }

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                if (Auth::user()->id_role == '1') {
                    return redirect('/')->with('success', 'Anda berhasil login');
                } else {
                    return redirect('/')->with('login', 'Anda berhasil login');
                }
            } else {
                error_log("Invalid password for username: " . $request->username);
                return redirect()->back()->with('error', 'Password salah');
            }
        } catch (\Exception $e) {
            // Log error message
            error_log("Exception during login: " . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->with('error', 'Terjadi kesalahan dalam proses login.');
        }
    }

    public function showAdminLoginForm()
    {
        return view('admin.login');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->id_role == 1) { // Ganti dengan kondisi sesuai role admin Anda
                return redirect()->intended('/user'); // Redirect ke halaman admin jika login sukses
            } else {
                Auth::logout(); // Logout user yang bukan admin
                return redirect()->route('admin.login')->with('bukanadmin', true); // Redirect ke halaman login dengan pesan error
            }
        } else {
            error_log("Invalid login attempt for username: " . $request->username);
            return redirect()->route('admin.login')->with('loginerror', true); // Redirect ke halaman login dengan pesan error
        }
    }

    public function logout(Request $request)
    {
        // Simpan informasi pengguna sebelum logout
        $id_role = Auth::user()->id_role;
        $userId = Auth::user()->id;

        // Logika logout
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($id_role == '1') {
            return redirect('/')->with('success', 'Anda berhasil logout');
        } else {
            // cek apakah sudah memilih 2 kali
            $detailPemilihan = DetailPemilihan::where('id_user', $userId)->get();

            if (count($detailPemilihan) == 2) {
                return redirect('/')->with('logout', 'Anda berhasil logout');
            } else {
                return redirect('/')->with('pilihdulu', 'Anda belum memilih 2 kali');
            }
        }
    }
}
