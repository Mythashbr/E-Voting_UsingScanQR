<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemilihan;

class PemilihanController extends Controller
{
    public function index()
    {
        $pemilihan = Pemilihan::all();
        return view('admin.pages.pemilihan', [
            'pemilihan' => $pemilihan
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'status' => 'required',
        ], [
            'name.required' => 'Nama pemilihan tidak boleh kosong',
            'waktu_mulai.required' => 'Waktu mulai tidak boleh kosong',
            'waktu_selesai.required' => 'Waktu selesai tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
        ]);

        Pemilihan::create([
            'name' => $request->name,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('store', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'status' => 'required',
        ], [
            'name.required' => 'Nama pemilihan tidak boleh kosong',
            'waktu_mulai.required' => 'Waktu mulai tidak boleh kosong',
            'waktu_selesai.required' => 'Waktu selesai tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
        ]);

        Pemilihan::where('id', $id)->update([
            'name' => $request->name,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('update', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        Pemilihan::where('id', $id)->delete();
        return redirect()->back()->with('delete', 'Data berhasil dihapus');
    }
}
