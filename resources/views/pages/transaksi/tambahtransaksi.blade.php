@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 mt-4">

        <div class="card">
            <h4 class="p-4">Tambah Transaksi</h4>
            <div class="p-3 me-4">

                <form action="/store/transaksi" id="transaksi-form" method="post">
                @csrf
                <!-- Nomor Transaksi -->
                <div class="form-group">
                    <label for="no_transaksi">Nomor Transaksi:</label>
                    <input type="text" name="no_transaksi" class="form-control" value="{{ old('$no_transaksi') }}" required>
                </div>

                <!-- Tanggal Transaksi -->
                <div class="form-group">
                    <label for="tanggal_transaksi">Tanggal Transaksi:</label>
                    <input type="date" name="tanggal_transaksi" class="form-control" value="{{ old('tanggal_transaksi') }}" required>
                </div>

                <!-- Nama Kasir (Admin) -->
                <div class="form-group">
                    <label for="kasir">Kasir (Admin):</label>
                    <input type="text" name="kasir" class="form-control" value="{{Auth::user()->nama}}" readonly>
                </div>

             </div>
        </div>

        <div class="card">
            <h4 class="p-4">Tambah Detail Transaksi</h4>
            <div class="p-3 me-4">

                <!-- Container for multiple items -->
                <div id="item-container">
                    <div class="item-group">
                        <!-- Nama Barang -->
                        <div class="form-group">
                            <label for="barang_id">Nama Barang:</label>
                            <select name="barang_id[]" class="form-control barang-select" required>
                                <option value="" disabled selected>Pilih Barang</option>
                                @foreach ($barangs as $produk)
                                    <option value="{{ $produk->id }}" data-harga="{{ $produk->harga_barang }}">
                                        {{ $produk->nama_barang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Jumlah Barang -->
                        <div class="form-group">
                            <label for="jumlah_barang">Jumlah Barang:</label>
                            <input type="number" name="jumlah_barang[]" class="form-control jumlah-input" min="1" required>
                        </div>

                        <!-- Total Harga Barang -->
                        <div class="form-group">
                            <label for="total_harga">Total Harga Barang:</label>
                            <input type="text" name="total_harga[]" class="form-control total-harga" readonly>
                        </div>

                        <hr>
                    </div>
                </div>

                <!-- Button to add more items -->
                <button type="button" id="add-item" class="btn btn-secondary">Tambah Barang</button>

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

                <!-- Script for handling dynamic item addition and total price calculation -->
                <script>
                    function bindEventsToGroup(group) {
                        const barangSelect = group.querySelector('.barang-select');
                        const jumlahInput = group.querySelector('.jumlah-input');
                        const totalHargaInput = group.querySelector('.total-harga');

                        // Trigger price calculation when quantity is entered
                        jumlahInput.addEventListener('input', function() {
                            const hargaBarang = barangSelect.selectedOptions[0]?.getAttribute('data-harga');
                            const jumlahBarang = this.value;
                            const total = hargaBarang * jumlahBarang || 0;
                            totalHargaInput.value = formatCurrency(total);
                        });

                        // Trigger price calculation when barang is selected
                        barangSelect.addEventListener('change', function() {
                            const hargaBarang = this.selectedOptions[0]?.getAttribute('data-harga');
                            const jumlahBarang = jumlahInput.value;
                            const total = hargaBarang * jumlahBarang || 0;
                            totalHargaInput.value = formatCurrency(total);
                        });
                    }

                    // Function to format number as currency "Rp." with thousands separator
                    function formatCurrency(amount) {
                        return 'Rp. ' + new Intl.NumberFormat('id-ID', {
                            style: 'decimal',
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0
                        }).format(amount);
                    }

                    // Add new item row
                    document.getElementById('add-item').addEventListener('click', function() {

                        const newItem = document.querySelector('.item-group').cloneNode(true);

                        // Clear input fields in cloned item
                        newItem.querySelectorAll('input').forEach(input => input.value = '');

                        // Reset total price
                        newItem.querySelector('.total-harga').value = '';

                        // Append new item to the container
                        document.getElementById('item-container').appendChild(newItem);

                        bindEventsToGroup(newItem);  // Bind events to new inputs
                    });

                    // Initialize event binding for the first item group
                    bindEventsToGroup(document.querySelector('.item-group'));
                </script>
            </div>
        </div>
    </div>
</div>
@endsection
