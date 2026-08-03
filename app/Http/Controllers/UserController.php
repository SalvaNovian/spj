<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:users',
            'jabatan' => 'required',
            'username' => 'required|unique:users',
            'role' => 'required',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'status' => true,
        ]);


        return redirect()->route('users.index')
    ->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:users,nip,' . $user->id,
            'jabatan' => 'required',
            'username' => 'required|unique:users,username,' . $user->id,
            'role' => 'required',
        ]);

        $user->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'username' => $request->username,
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil diubah');
    }

    public function destroy(User $user)
{
    $user->delete();

    return redirect()
        ->route('users.index')
        ->with('success', 'User berhasil dihapus');
}
}