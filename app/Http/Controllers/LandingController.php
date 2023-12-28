<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Calon;


class LandingController extends Controller
{
    public function index()
    {
        $calonketua = Calon::where('id_pemilihan', '1')->get();
        $calonwakil = Calon::where('id_pemilihan', '2')->get();
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
}
