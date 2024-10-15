@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Transaksi</h2>

        <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
            @csrf  <!-- CSRF token untuk keamanan -->
            @method('PUT') <!-- Method PUT untuk update data -->

            <!-- Nama Barang (berdasarkan barang_id) -->
            <div class="form-group">
                <label for="barang_id">Nama Barang:</label>
                <select name="barang_id" id="barang_id" class="form-control" required>
                    <option value="" disabled>Pilih Barang</option>
                    @foreach($barang as $item)
                        <option value="{{ $item->id }}" {{ $transaksi->barang_id == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_barang }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Jumlah Barang -->
            <div class="form-group">
                <label for="jumlah_barang">Jumlah Barang:</label>
                <input type="number" name="jumlah_barang" id="jumlah_barang" class="form-control" value="{{ $transaksi->jumlah_barang }}" required>
            </div>

            <!-- Total Harga -->
            <div class="form-group">
                <label for="total_harga">Total Harga:</label>
                <input type="number" name="total_harga" id="total_harga" class="form-control" value="{{ $transaksi->total_harga }}" required>
            </div>

            <!-- Metode Pembayaran -->
            <div class="form-group">
                <label for="metode_pembayaran">Metode Pembayaran:</label>
                <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                    <option value="" disabled>Pilih Metode Pembayaran</option>
                    <option value="cash" {{ $transaksi->metode_pembayaran == 'cash' ? 'selected' : '' }}>Cash</option>
                    <option value="credit" {{ $transaksi->metode_pembayaran == 'credit' ? 'selected' : '' }}>Credit</option>
                    <option value="debit" {{ $transaksi->metode_pembayaran == 'debit' ? 'selected' : '' }}>Debit</option>
                </select>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Update Transaksi</button>
        </form>
    </div>
@endsection
