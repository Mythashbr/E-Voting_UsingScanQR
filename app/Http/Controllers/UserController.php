<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImport;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('id_role', '!=', 1)->orderBy('name')->get();
        return view('admin.pages.user', compact('user'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:tb_user',
            'id_anggota' => 'required|string|max:255|unique:tb_user',
            'email' => 'required|string|email|max:255|unique:tb_user',
        ], [
            'name.required' => 'Nama user tidak boleh kosong.',
            'username.required' => 'N0 ID user tidak boleh kosong.',
            'username.unique' => 'N0 ID user sudah terdaftar.',
            'id_anggota.required' => 'ID Anggota tidak boleh kosong.',
            'id_anggota.unique' => 'ID Anggota sudah terdaftar.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->username), // Menggunakan username sebagai password sementara
            'id_anggota' => $request->id_anggota,
            'email' => $request->email,
            'id_role' => 2, // Hardcoded role untuk user
        ]);

        return redirect()->back()->with('store', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:tb_user,username,' . $id,
            'email' => 'required|string|email|max:255|unique:tb_user,email,' . $id,
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('update', 'Data Berhasil Diupdate');
    }


    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('delete', 'Data berhasil dihapus');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ], [
            'file.required' => 'File tidak boleh kosong.',
            'file.mimes' => 'File harus berupa file Excel (xls, xlsx).',
        ]);

        $file = $request->file('file');
        $namafile = rand() . $file->getClientOriginalName();
        $file->move('excel/user', $namafile);

        Excel::import(new UserImport, public_path('/excel/user/' . $namafile));

        return redirect()->back()->with('import', 'Data berhasil diimport');
    }
}
