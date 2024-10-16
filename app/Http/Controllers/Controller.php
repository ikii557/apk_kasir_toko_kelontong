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
        return view("profile",compact("users"));
    }

    public function edit($id)
    {
        $dataUsers =User::find($id);
        return view("editprofile",compact("dataUsers"));
    }

    public function update(Request $request, $id)
{
    // Validate the incoming request
    $request->validate([
        'nama' => 'required|string|max:255',
        'no_hp'=> 'required',
        'email'=> 'required|unique',
        'password'=> 'required',
    ]);
    $dataUser = User::find($id);

        if ($request->hasFile('foto')){
            if ($dataUser->foto && file_exists(public_path('foto/'. $dataUser->foto))){
                unlink(public_path('foto/'. $dataUser->foto));
            }

            $file = $request->file('foto');
            $fileName = time() .'.'. $file->getClientOriginalExtension();
            $file->move(public_path('foto'), $fileName);
        }else{
            $fileName = $dataUser->foto;
        }

    $updateDataSiswa =[
        'nama' => $request->nama,
        'no_hp'  => $request->no_hp,
        'email'=> $request->email,
        'password'=> bcrypt($request->password),

    ];

    $dataUser = User::find($id)->update($updateDataSiswa);
    return redirect('/siswa/index');
}
}
