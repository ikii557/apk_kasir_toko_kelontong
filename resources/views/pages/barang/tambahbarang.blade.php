@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Barang</h2>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="alert alert-success" id="success-alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form to create a new barang -->
    <div class="card">
        <div class="p-2 mt-4 me-2">
            <form action="/store/barang" method="post">
                @csrf

                <!-- Nama Barang -->
                <div class="form-group">
                    <label for="nama_barang">Nama Barang:</label>
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="{{ old('nama_barang') }}" placeholder="isi nama barang">
                    @error('nama_barang')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stok -->
                <div class="form-group">
                    <label for="stok">Jumlah Stok:</label>
                    <input type="number" name="stok_barang" id="stok" class="form-control" value="{{ old('stok_barang') }}" placeholder="isi jumlah stok">
                    @error('stok_barang')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Harga Barang -->
                <div class="form-group">
                    <label for="harga_barang">Harga Barang (Rp):</label>
                    <input type="number" name="harga_barang" id="harga_barang" class="form-control" value="{{ old('harga_barang') }}" step="0.01" placeholder="isi harga barang">
                    @error('harga_barang')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary mt-3">Tambah Barang</button>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript to auto-hide success alert -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var successAlert = document.getElementById('success-alert');
        if (successAlert) {
            setTimeout(function () {
                successAlert.style.display = 'none';
            }, 3000); // 3000 ms = 3 detik
        }
    });
</script>
@endsection
