@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Barang</h2>

        <form action="{{ route('barang.update', $barang->id) }}" method="POST">
            @csrf  <!-- CSRF token untuk keamanan -->
            @method('PUT') <!-- Method PUT untuk update data -->

            <!-- Nama Barang -->
            <div class="form-group">
                <label for="nama_barang">Nama Barang:</label>
                <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="{{ $barang->nama_barang }}" required>
            </div>

            <!-- Harga -->
            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" name="harga" id="harga" class="form-control" value="{{ $barang->harga }}" required>
            </div>

            <!-- Stok Barang -->
            <div class="form-group">
                <label for="stok">Stok Barang:</label>
                <input type="number" name="stok" id="stok" class="form-control" value="{{ $barang->stok }}" required>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Update Barang</button>
        </form>
    </div>
@endsection
