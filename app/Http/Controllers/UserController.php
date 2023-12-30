<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImport;


class UserController extends Controller
{
    public function index()
    {
        $user = User::all()->where('id_role', '!=', '1')->sortBy('name');
        return view('admin.pages.user', [
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:tb_user',


        ], [
            'name.required' => 'Nama user tidak boleh kosong',
            'username.required' => 'NIM user tidak boleh kosong',
            'username.unique' => 'NIM user sudah terdaftar',

        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->username,
            'id_role' => 2,
        ]);

        return redirect()->back()->with('store', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:tb_user,username,' . $id,

        ], [
            'name.required' => 'Nama user tidak boleh kosong',
            'username.required' => 'NIM user tidak boleh kosong',
            'username.unique' => 'NIM user sudah terdaftar',

        ]);

        User::where('id', $id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->username,
            'id_role' => 2,
        ]);

        return redirect()->back()->with('update', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('delete', 'Data berhasil dihapus');
    }

    public function import(Request $request)
    {
        set_time_limit(500);
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ], [
            'file.required' => 'File tidak boleh kosong',
            'file.mimes' => 'File harus berupa excel'
        ]);

        $file = $request->file('file');
        $namafile = rand() . $file->getClientOriginalName();
        $file->move('excel/user', $namafile);

        Excel::import(new UserImport, public_path('/excel/user/' . $namafile));

        return redirect()->back()->with('import', 'Data berhasil diimport');
    }
}
