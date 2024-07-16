<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calon;
use App\Models\Pemilihan;
use App\Models\DetailPemilihan;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index()
    {
        $datapemilihan = Pemilihan::with('calon')->get();

        // Ambil data jumlah suara untuk setiap calon
        $jumlahsuara = [];
        foreach ($datapemilihan as $pemilihan) {
            $calon = Calon::where('id_pemilihan', $pemilihan->id)->get();
            foreach ($calon as $c) {
                $count = DetailPemilihan::where('id_calon', $c->id)->count();
                $jumlahsuara[$c->id] = $count;
            }
        }

        // cek auth
        if (auth()->check()) {
            // cek role
            if (auth()->user()->id_role == '1') {
                return redirect('/calon');
            } else if (auth()->user()->id_role == '2') {
                return view('landing.pages.landing', [
                    'datapemilihan' => $datapemilihan,
                    'jumlahsuara' => $jumlahsuara, // Mengirimkan jumlah suara ke blade
                ]);
            } else {
                return view('landing.pages.landing', [
                    'datapemilihan' => $datapemilihan,
                    'jumlahsuara' => $jumlahsuara, // Mengirimkan jumlah suara ke blade
                ]);
            }
        } else {
            return view('landing.pages.landing', [
                'datapemilihan' => $datapemilihan,
                'jumlahsuara' => $jumlahsuara, // Mengirimkan jumlah suara ke blade
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
