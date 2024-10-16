@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Barang </h2>

        <div class="card">
            <div class="p-4 mt-4 me-4">
            <form action="" method="POST">
            @csrf

            <!-- Nama Barang -->
            <div class="form-group">
                <label for="nama_barang">Nama Barang:</label>
                <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
            </div>

            <!-- Harga -->
            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" name="harga" id="harga" class="form-control" required>
            </div>

            <!-- Stok Barang -->
            <div class="form-group">
                <label for="stok">Stok Barang:</label>
                <input type="number" name="stok" id="stok" class="form-control" required>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Tambah Barang</button>
        </form>
            </div>
        </div>
    </div>
@endsection
