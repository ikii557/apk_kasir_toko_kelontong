@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Transaksi</h2>

        <div class="card">
            <div class="p-3 mt-4 me-4">
                <form action="/updatetransaksi/{{$transaksis->id}}" method="POST">
                    @csrf

                    <!-- Nama Barang -->
                    <div class="form-group">
                        <label for="barang_id">Nama Barang:</label>
                        <select name="barang_id" id="barang_id" class="form-control" >
                            <option value="" disabled selected>Pilih Barang</option>
                            @foreach ($barangs as $produk)
                                <option
                                    value="{{ $produk->id }}"
                                    data-harga="{{ $produk->harga_barang }}"
                                    {{ $transaksis->barang_id == $produk->id ? 'selected' : '' }}
                                >
                                    {{ $produk->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jumlah Barang -->
                    <div class="form-group">
                        <label for="jumlah_barang">Jumlah Barang:</label>
                        <input type="number" value="{{ $transaksis->jumlah_barang }}" name="jumlah_barang" id="jumlah_barang" class="form-control" >
                    </div>

                    <!-- Total Harga -->
                    <div class="form-group">
                        <label for="total_harga">Total Harga:</label>
                        <input type="text" value="{{ $transaksis->total_harga }}" name="total_harga" id="total_harga" class="form-control" readonly>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="form-group">
                        <label for="metode_pembayaran">Metode Pembayaran:</label>
                        <select name="metode_pembayaran" id="metode_pembayaran" class="form-control">
                            <option value="" disabled selected>Pilih Metode Pembayaran</option>
                            <option value="tunai" {{ $transaksis->metode_pembayaran  == 'tunai' ? 'selected' : '' }}>Tunai</option>
                            <option value="debit" {{ $transaksis->metode_pembayaran  == 'debit' ? 'selected' : '' }}>Debit</option>
                            <option value="kredit" {{ $transaksis->metode_pembayaran  == 'kredit' ? 'selected' : '' }}>Kredit</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">edit Transaksi</button>

                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript to handle dynamic price calculation -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const barangSelect = document.getElementById('barang_id');
            const jumlahInput = document.getElementById('jumlah_barang');
            const totalHargaInput = document.getElementById('total_harga');

            function calculateTotal() {
                const selectedOption = barangSelect.options[barangSelect.selectedIndex];
                const hargaBarang = selectedOption.getAttribute('data-harga');
                const jumlahBarang = jumlahInput.value;

                if (hargaBarang && jumlahBarang) {
                    const totalHarga = hargaBarang * jumlahBarang;
                    totalHargaInput.value = `Rp. ${totalHarga.toLocaleString()}`;
                }
            }

            // Calculate total when the user changes the selected item
            barangSelect.addEventListener('change', calculateTotal);

            // Calculate total when the user changes the quantity
            jumlahInput.addEventListener('input', calculateTotal);
        });
    </script>
@endsection
        