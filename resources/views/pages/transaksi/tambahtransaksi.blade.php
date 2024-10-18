@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Transaksi Baru</h2>

        <div class="card">
            <div class="p-3 mt-4 me-4">
                <form action="/store/transaksi" method="post">
                    @csrf

                    <!-- Nama Barang -->
                    <div class="form-group">
                        <label for="barang_id">Nama Barang:</label>
                        <select name="barang_id" id="barang_id" class="form-control" required>
                            <option value="" disabled selected>Pilih Barang</option>
                            @foreach ($barangs as $produk)
                                <option {{ old('barang_id') == $produk->id ? 'selected' : '' }} value="{{ $produk->id }}">{{ $produk->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jumlah Barang -->
                    <div class="form-group">
                        <label for="jumlah_barang">Jumlah Barang:</label>
                        <input type="text" value="{{ old('jumlah_barang') }}" name="jumlah_barang" id="jumlah_barang" class="form-control" required>
                    </div>

                    <!-- Total Harga -->
                    <div class="form-group">
                        <label for="total_harga">Total Harga:</label>
                        <input type="text" value="{{ old('total_harga') }}" name="total_harga" id="total_harga" class="form-control" required>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="form-group">
                        <label for="metode_pembayaran">Metode Pembayaran:</label>
                        <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                            <option value="" disabled selected>Pilih Metode Pembayaran</option>
                            <option value="tunai" {{ old('metode_pembayaran') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                            <option value="debit" {{ old('metode_pembayaran') == 'debit' ? 'selected' : '' }}>Debit</option>
                            <option value="kredit" {{ old('metode_pembayaran') == 'kredit' ? 'selected' : '' }}>Kredit</option>
                        </select>
                    </div>


                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary">Tambah Transaksi</button>
                </form>
            </div>
        </div>
    </div>
@endsection
