<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Calon;
use App\Models\User;
use App\Models\Pemilihan;
use App\Models\DetailPemilihan;


class LandingController extends Controller
{
    public function index()
    {
        $calonketua = Calon::where('id_pemilihan', '1')->orderBy('no_urut', 'asc')->get();
        $calonwakil = Calon::where('id_pemilihan', '2')->orderBy('no_urut', 'asc')->get();
        // cek auth
        if (auth()->check()) {
            // cek role
            if (auth()->user()->id_role == '1') {
                return redirect('/calon');
            } elseif (auth()->user()->id_role == '2') {
                return view('landing.pages.landing', [
                    'calonketua' => $calonketua,
                    'calonwakil' => $calonwakil,
                ]);
            } else {
                return view('landing.pages.landing', [
                    'calonketua' => $calonketua,
                    'calonwakil' => $calonwakil,
                ]);
            }
        } else {
            return view('landing.pages.landing', [
                'calonketua' => $calonketua,
                'calonwakil' => $calonwakil,
            ]);
        }
    }

    public function detail($id)
    {
        $calon = Calon::find($id);
        return view('landing.pages.detail-calon', [
            'calon' => $calon,
        ]);
    }

    public function pilihcalon(Request $request)
    {
        $id_user = $request->id_user;
        $id_calon = $request->id_calon;
        $id_pemilihan = $request->id_pemilihan;

        // cek apakah user sudah memilih
        $cek = DetailPemilihan::where('id_user', $id_user)->where('id_pemilihan', $id_pemilihan)->first();

        if ($cek) {
            return redirect()->back()->with('error', 'Anda sudah memilih');
        } else {
            $pemilihan = new DetailPemilihan;
            $pemilihan->id_user = $id_user;
            $pemilihan->id_calon = $id_calon;
            $pemilihan->id_pemilihan = $id_pemilihan;
            $pemilihan->save();

            return redirect()->back()->with('success', 'Berhasil memilih');
        }
    }
}
