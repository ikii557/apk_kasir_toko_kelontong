@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Profile Anda</h2>

        <div class="card">
            <div class="p-4 mt-4 me-4">
                <form action="/updateprofile/{{ $users->id }}" method="POST">
                    @csrf

                    <!-- Nama -->
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" value="{{ $users->nama }}" name="nama" id="nama" class="form-control" required>
                    </div>

                    <!-- No HP -->
                    <div class="form-group">
                        <label for="no_hp">No HP:</label>
                        <input type="text" value="{{ $users->no_hp }}" name="no_hp" id="no_hp" class="form-control" required>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" value="{{ $users->email }}" name="email" id="email" class="form-control" required>
                    </div>

                    <!-- Role -->
                    <div class="form-group">
                        <label for="role"><strong>Role</strong></label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="admin" {{ $users->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="superadmin" {{ $users->role == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                        </select>
                        @error('role')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
