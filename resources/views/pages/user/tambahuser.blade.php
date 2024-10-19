@extends('layouts.app')

@section('content')
    <div class="container">

        <h2>Tambah Pengguna Baru</h2>

        <div class="card">
            <div class="p-4 mt-4 me-4">
            <form action="/store/user" method="POST">
            @csrf
            <!-- Nama -->
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" value="{{ old('nama') }}" name="nama" id="nama" class="form-control" required>
            </div>

            <!-- No HP -->
            <div class="form-group">
                <label for="no_hp">No HP:</label>
                <input type="text" value="{{ old('no_hp') }}" name="no_hp" id="no_hp" class="form-control" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" value="{{ old('email') }}" name="email" id="email" class="form-control" required>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" value="{{ old('password') }}" name="password" id="password" class="form-control" required>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Tambah Pengguna</button>
        </form>

            </div>
        </div>
    </div>
@endsection
