@extends('layouts.app')

@section('content')

@if(session('success'))
        <div class="alert alert-success" id="success-alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <h2>Tambah Pengguna</h2>

        <div class="card">
            <div class="p-4 mt-4 me-4">
            <form action="/store/user" method="post" class="mt-4">
                @csrf
                <div class="form-group">
                    <label><strong>Nama</strong></label>
                    <input name="nama" type="nama" class="form-control">
                    @error('nama')
                            <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>No hp</strong></label>
                    <input name="no_hp" type="no_hp" class="form-control">
                    @error('no_hp')
                            <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>Email</strong></label>
                    <input name="email" type="email" class="form-control">
                    @error('email')
                            <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>Password</strong></label>
                    <input name="password" type="password" class="form-control" >
                    @error('password')
                            <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>Role</strong></label>
                    <select name="role" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="superadmin">Super Admin</option>
                    </select>
                    @error('role')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>


                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block mt-2">Simpan</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
