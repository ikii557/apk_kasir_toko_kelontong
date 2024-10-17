@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Transaksi Baru</h2>

        <div class="card">
            <div class="p-3 mt-4 me-4">
                <form action="" method="POST">
                    @csrf

                    <!-- Nama Barang -->
                    <div class="form-group">
                        <label for="barang_id">Nama Barang:</label>
                        <select name="barang_id" id="barang_id" class="form-control" required>
                            <option value="" disabled selected>Pilih Barang</option>
                            @foreach ($barangs as $produk)
                                <option {{ old('barang_id') == $produk->id ? 'selected' : '' }} value="{{ $produk->id }}">{{ $produk->barangs }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jumlah Barang -->
                    <div class="form-group">
                        <label for="jml_barang">Jumlah Barang:</label>
                        <input type="number" value="{{ old('jml_barang') }}" name="jml_barang" id="jml_barang" class="form-control" required>
                    </div>

                    <!-- Total Harga -->
                    <div class="form-group">
                        <label for="total_harga">Total Harga:</label>
                        <input type="number" value="{{ old('total_harga') }}" name="total_harga" id="total_harga" class="form-control" required>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="form-group">
                        <label for="metode_pembayaran">Metode Pembayaran:</label>
                        <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                            <option value="" disabled selected>Pilih Metode Pembayaran</option>
                            @foreach ($barangs as $metode)
                                <option {{ old('metode_pembayaran') == $metode->id ? 'selected' : '' }} value="{{ $metode->id }}">{{ $metode->nama_metode }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary">Tambah Transaksi</button>
                </form>
            </div>
        </div>
    </div>
@endsection
