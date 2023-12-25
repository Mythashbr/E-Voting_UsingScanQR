<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all()->where('id_role', '!=', '1');
        return view('admin.pages.user', [
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',

        ], [
            'name.required' => 'Nama user tidak boleh kosong',
            'username.required' => 'NIM user tidak boleh kosong',

        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->username,
            'id_role' => 1,
        ]);

        return redirect()->back()->with('store', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',

        ], [
            'name.required' => 'Nama user tidak boleh kosong',
            'username.required' => 'NIM user tidak boleh kosong',

        ]);

        User::where('id', $id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->username,
            'id_role' => 1,
        ]);

        return redirect()->back()->with('update', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('delete', 'Data berhasil dihapus');
    }
}
