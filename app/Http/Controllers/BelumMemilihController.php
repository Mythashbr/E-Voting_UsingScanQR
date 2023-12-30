<?php

namespace App\Http\Controllers;

use App\Models\Pemilihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BelumMemilihController extends Controller
{
    public function index()
    {
        // Ambil semua data pemilihan
        $pemilihan = Pemilihan::all();

        // Tampilkan data user yang belum memilih pada pemilihan tertentu
        $belum_memilih = DB::table('tb_user')
            ->whereNotIn('id', function ($query) {
                $id_pemilihan = 0;
                $query->select('id_user')->from('tb_detail_pemilihan')->where('id_pemilihan', $id_pemilihan);
            })
            ->where('id_role', '=', 2)
            // tambahkan sort by name
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.pages.belum-memilih', [
            'id_pemilihan' => '0',
            'pemilihan' => $pemilihan,
            'belummemilih' => $belum_memilih
        ]);
    }

    public function caribelummemilih(Request $request)
    {
        Session::flash('id_pemilihan', $request->id_pemilihan);

        // Ambil semua data pemilihan
        $pemilihan = Pemilihan::all();

        // Tampilkan data user yang belum memilih pada pemilihan tertentu
        $belum_memilih = DB::table('tb_user')
            ->whereNotIn('id', function ($query) use ($request) {
                $id_pemilihan = $request->id_pemilihan;
                $query->select('id_user')->from('tb_detail_pemilihan')->where('id_pemilihan', $id_pemilihan);
            })
            ->where('id_role', '=', 2)
            // tambahkan sort by name
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.pages.belum-memilih', [
            'id_pemilihan' => $request->id_pemilihan,
            'pemilihan' => $pemilihan,
            'belummemilih' => $belum_memilih
        ]);
    }
}
