<?php

namespace App\Http\Controllers;

use App\Models\Calon;
use App\Models\Pemilihan;
use Illuminate\Http\Request;

class CalonController extends Controller
{
    public function index()
    {
        $pemilihan = Pemilihan::all();
        $calon = Calon::with('pemilihan')->get();
        return view('admin.pages.calon', [
            'calon' => $calon,
            'pemilihan' => $pemilihan,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'foto' => 'required|image',
            'visi' => 'required',
            'misi' => 'required',
            'no_urut' => 'required',
            'id_pemilihan' => 'required',
        ], [
            'name.required' => 'Nama calon tidak boleh kosong',
            'foto.required' => 'Foto calon tidak boleh kosong',
            'foto.image' => 'Foto calon harus berupa gambar',
            // 'foto.mimes' => 'Foto calon harus berupa gambar',
            // 'foto.max' => 'Foto calon maksimal 2MB',
            'visi.required' => 'Visi calon tidak boleh kosong',
            'misi.required' => 'Misi calon tidak boleh kosong',
            'no_urut.required' => 'Nomor urut calon tidak boleh kosong',
            'id_pemilihan.required' => 'Pemilihan tidak boleh kosong',
        ]);

        // masukkan foto ke dalam folder public/images
        $foto = $request->file('foto');
        $namaFoto = time() . '.' . $foto->extension();
        $foto->move(public_path('images'), $namaFoto);


        Calon::create([
            'name' => $request->name,
            'foto' => $namaFoto,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'no_urut' => $request->no_urut,
            'id_pemilihan' => $request->id_pemilihan,
        ]);

        return redirect()->back()->with('create', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'foto' => 'image',
            'visi' => 'required',
            'misi' => 'required',
            'no_urut' => 'required',
            'id_pemilihan' => 'required',
        ], [
            'name.required' => 'Nama calon tidak boleh skosong',
            'foto.image' => 'Foto calon harus berupa gambar',
            // 'foto.mimes' => 'Foto calon harus berupa gambar',
            // 'foto.max' => 'Foto calon maksimal 2MB',
            'visi.required' => 'Visi calon tidak boleh kosong',
            'misi.required' => 'Misi calon tidak boleh kosong',
            'no_urut.required' => 'Nomor urut calon tidak boleh kosong',
            'id_pemilihan.required' => 'Pemilihan tidak boleh kosong',
        ]);

        // jika ada foto yang diupload
        if ($request->hasFile('foto')) {
            // hapus foto lama
            $calon = Calon::where('id', $id)->first();
            unlink(public_path('images/' . $calon->foto));

            // masukkan foto baru ke dalam folder public/images
            $foto = $request->file('foto');
            $namaFoto = time() . '.' . $foto->extension();
            $foto->move(public_path('images'), $namaFoto);

            Calon::where('id', $id)->update([
                'name' => $request->name,
                'foto' => $namaFoto,
                'visi' => $request->visi,
                'misi' => $request->misi,
                'no_urut' => $request->no_urut,
                'id_pemilihan' => $request->id_pemilihan,
            ]);
        } else {
            Calon::where('id', $id)->update([
                'name' => $request->name,
                'visi' => $request->visi,
                'misi' => $request->misi,
                'no_urut' => $request->no_urut,
                'id_pemilihan' => $request->id_pemilihan,
            ]);
        }

        return redirect()->back()->with('update', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        // hapus foto
        $calon = Calon::where('id', $id)->first();
        unlink(public_path('images/' . $calon->foto));

        Calon::where('id', $id)->delete();
        return redirect()->back()->with('delete', 'Data berhasil dihapus');
    }
}
