@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Transaksi Baru</h2>

        <div class="card">
            <div class="p-3 mt-4 me-4">
                <!-- Nama Barang -->
<div class="form-group">
    <label for="barang_id">Nama Barang:</label>
    <select name="barang_id" id="barang_id" class="form-control" required>
        <option value="" disabled selected>Pilih Barang</option>
        @foreach ($barangs as $produk)
            <option value="{{ $produk->id }}" data-harga="{{ $produk->harga_barang }}">{{ $produk->nama_barang }}</option>
        @endforeach
    </select>
</div>

<!-- Jumlah Barang -->
<div class="form-group">
    <label for="jumlah_barang">Jumlah Barang:</label>
    <input type="number" value="{{ old('jumlah_barang') }}" name="jumlah_barang" id="jumlah_barang" class="form-control" required>
</div>

<!-- Total Harga -->
<div class="form-group">
    <label for="total_harga">Total Harga:</label>
    <input type="text" value="{{ old('total_harga') }}" name="total_harga" id="total_harga" class="form-control" readonly>
</div>

<script>
    // Update total price when selecting a product
    document.getElementById('barang_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const hargaBarang = selectedOption.getAttribute('data-harga');
        const jumlahBarang = document.getElementById('jumlah_barang').value;
        document.getElementById('total_harga').value = hargaBarang * jumlahBarang || 0;
    });

    // Update total price when changing the quantity
    document.getElementById('jumlah_barang').addEventListener('input', function() {
        const hargaBarang = document.getElementById('barang_id').selectedOptions[0].getAttribute('data-harga');
        const jumlahBarang = this.value;
        document.getElementById('total_harga').value = hargaBarang * jumlahBarang || 0;
    });
</script>

            </div>
        </div>
    </div>
@endsection
