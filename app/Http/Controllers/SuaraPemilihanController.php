<?php

namespace App\Http\Controllers;

use App\Events\VoteCountUpdated;
use App\Models\DetailPemilihan;
use App\Models\Pemilihan;
use App\Models\Calon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SuaraPemilihanController extends Controller
{
    // Metode untuk menampilkan halaman suara pemilihan
    public function index()
    {
        $pemilhan = Pemilihan::all();
        $jumlahsuara = DB::table('tb_detail_pemilihan')
            ->select('id_calon', DB::raw('count(*) as jumlahsuara'))
            ->where('tb_detail_pemilihan.id_pemilihan', '0')
            ->groupBy('tb_detail_pemilihan.id_calon')
            ->get();

        return view('admin.pages.suara-pemilihan', [
            'pemilihan' => $pemilhan,
            'jumlahsuara' => $jumlahsuara,
        ]);
    }

    public function carisuara(Request $request)
    {
        Session::flash('id_pemilihan', $request->id_pemilihan);
        $id_pemilihan = $request->id_pemilihan;
        $pemilhan = Pemilihan::all();
        $jumlahsuara = DB::table('tb_detail_pemilihan')
            ->select('id_calon', DB::raw('count(*) as jumlahsuara'))
            ->where('tb_detail_pemilihan.id_pemilihan', $id_pemilihan)
            ->groupBy('tb_detail_pemilihan.id_calon')
            ->get();

        return view('admin.pages.suara-pemilihan', [
            'pemilihan' => $pemilhan,
            'jumlahsuara' => $jumlahsuara,
        ]);
    }

    public function getVoteCounts()
    {
        $jumlahsuara = DB::table('tb_detail_pemilihan')
            ->join('tb_calon', 'tb_detail_pemilihan.id_calon', '=', 'tb_calon.id')
            ->select('tb_calon.id', 'tb_calon.name', DB::raw('count(tb_detail_pemilihan.id_calon) as jumlah_suara'))
            ->groupBy('tb_calon.id', 'tb_calon.name')
            ->get();

        return response()->json($jumlahsuara);
    }
}
