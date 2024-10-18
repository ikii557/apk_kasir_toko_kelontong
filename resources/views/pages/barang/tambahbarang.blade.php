@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Barang</h2>

    <!-- Form to create a new barang -->
    <div class="card">
        <div class="p-2 mt-4 me-2">
        <form action="/store/barang" method="post">
        @csrf

        <!-- Nama Barang -->
        <div class="form-group">
            <label for="nama_barang">Nama Barang:</label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="{{ old('nama_barang') }}" placeholder="isi nama barang">

        </div>

        <!-- Stok -->
        <div class="form-group">
            <label for="stok">Jumlah Stok:</label>
            <input type="number" name="stok_barang" id="stok" class="form-control" value="{{ old('stok') }}" placeholder="isi jumlah stok">
        </div>

        <!-- Harga Barang -->
        <div class="form-group">
            <label for="harga_barang">Harga Barang (Rp):</label>
            <input type="number" name="harga_barang" id="harga_barang" class="form-control" value="{{ old('harga_barang') }}" step="0.01" placeholder="isi harga barang">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary mt-3">Tambah Barang</button>
    </form>

        </div>
    </div>
</div>
@endsection
