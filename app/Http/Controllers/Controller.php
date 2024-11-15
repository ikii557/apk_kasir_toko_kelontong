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
    public function profile()
    {
        $users = User::all(); // This fetches all users if needed for the view.

        return view("pages.user.profile", compact("users"));
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
        return redirect('/profile')->with('success', 'Kasir Baru berhasil ditambahkan.');
    }

    // Show the form for editing a specific user
    public function editprofile($id)
    {
        $users = User::findOrFail($id); // Use `findOrFail` for better error handling
        return view('pages.user.editprofile', compact('users'));
    }


    // Update a specific user's information
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id); // Ensure user exists before updating

    // Validate input from the form
    $request->validate([
        'nama' => 'required|string|max:255',
        'no_hp' => 'required|string|max:15',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required|in:admin,superadmin',
    ], [
        'nama.required' => 'Nama harus diisi.',
        'nama.string' => 'Nama harus berupa teks.',
        'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
        'no_hp.required' => 'Nomor HP harus diisi.',
        'no_hp.string' => 'Nomor HP harus berupa teks.',
        'no_hp.max' => 'Nomor HP tidak boleh lebih dari 15 karakter.',
        'email.required' => 'Email harus diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah terdaftar, gunakan email lain.',
        'role.required' => 'Role harus dipilih.',
        'role.in' => 'Role hanya bisa dipilih antara admin dan superadmin.',
    ]);

    // Update user data
    $user->update([
        'nama' => $request->nama,
        'no_hp' => $request->no_hp,
        'email' => $request->email,
        'role' => $request->role,
    ]);

    // Redirect back to the profile or user list with a success message
    return redirect('/profile')->with('success', 'Profil berhasil diperbarui.');
}



    // Delete a specific user
    public function destroy($id)
    {
        // Find the record in the 'barang' table by its ID
        $users = User::findOrFail($id);

        // Delete the record
        $users->delete();

        // Redirect back to the 'barang' list page with a success message
        return redirect('/profile')->with('success', 'Kasir berhasil dihapus!');
    }
}
