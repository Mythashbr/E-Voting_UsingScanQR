<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('admin.pages.user', [
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nim' => 'required',
            'password' => 'required',
            'id_role' => 'required',
        ], [
            'name.required' => 'Nama user tidak boleh kosong',
            'nim.required' => 'NIM user tidak boleh kosong',
            'password.required' => 'Password user tidak boleh kosong',
            'id_role.required' => 'Role user tidak boleh kosong',
        ]);

        User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'password' => $request->password,
            'id_role' => $request->role,
        ]);

        return redirect()->back()->with('store', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'nim' => 'required',
            'password' => 'required',
            'id_role' => 'required',
        ], [
            'name.required' => 'Nama user tidak boleh kosong',
            'nim.required' => 'NIM user tidak boleh kosong',
            'password.required' => 'Password user tidak boleh kosong',
            'id_role.required' => 'Role user tidak boleh kosong',
        ]);

        User::where('id', $id)->update([
            'name' => $request->name,
            'nim' => $request->nim,
            'password' => $request->password,
            'id_role' => $request->role,
        ]);

        return redirect()->back()->with('update', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('delete', 'Data berhasil dihapus');
    }
}
