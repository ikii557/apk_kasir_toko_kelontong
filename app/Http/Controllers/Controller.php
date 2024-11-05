<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function profile(){
        $users=User::all();
        return view("pages.user.profile",compact("users"));
    }



    // Display the form for creating a new user
    public function create()
    {
        return view('pages.user.tambahuser');
    }

    // Store a newly created user
    public function store(Request $request)

    {

        $request->validate([
            'nama'      => 'required|max:255',
            'no_hp'     => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required',
        ],[
            'nama.required'         => 'Nama harus diisi',
            'nama.max'              => 'Nama maksimal 255 karakter',
            'no_hp.required'        => 'no hp harus benar',
            'email.required'        => 'Email harus diisi',
            'email.unique'          => 'Email sudah terdaftar',
            'password.required'     => 'Password harus diisi',
            'password.min'          => 'Password harus minimal 8 karakter',
        ]);
        // Simpan user baru
        User::create([
            'nama'     => $request->nama,
            'no_hp'    => $request->no_hp,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => $request->role
        ]);
        return redirect('/profile')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    // Show the form for editing a specific user
    public function edit($id)
    {
        $user = User::find($id); // Jika mencari satu pengguna berdasarkan id
        return view('nama_view', compact('user'));

    }

    // Update a specific user's information
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,superadmin',
        ]);

        $user->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        if ($request->password) {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    // Delete a specific user
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
