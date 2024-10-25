@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 mt-4">

        <form action="/store/transaksi" id="transaksi-form" method="post">
            @csrf
            <div class="card">
                <h4 class="p-4">Tambah Transaksi</h4>
                <div class="p-3 me-4">

                    <!-- Nomor Transaksi -->
                    <div class="form-group">
                        <label for="no_transaksi">Nomor Transaksi:</label>
                        <input type="text" name="no_transaksi" class="form-control" value="{{ old('$no_transaksi') }}"
                            required>
                    </div>

                    <!-- Tanggal Transaksi -->
                    <div class="form-group">
                        <label for="tanggal_transaksi">Tanggal Transaksi:</label>
                        <input type="date" name="tanggal_transaksi" class="form-control"
                            value="{{ old('tanggal_transaksi') }}" required>
                    </div>

                    <!-- Nama Kasir (Admin) -->
                    <div class="form-group">
                        <label for="kasir">Kasir (Admin):</label>
                        <input type="text" name="kasir" class="form-control" value="{{Auth::user()->nama}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="metode_pembayaran">Metode Pembayaran:</label>
                        <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                            <option value="" disabled selected>Pilih Metode Pembayaran</option>
                            <option value="tunai" {{ old('metode_pembayaran') == 'tunai' ? 'selected' : '' }}>Tunai
                            </option>
                            <option value="debit" {{ old('metode_pembayaran') == 'debit' ? 'selected' : '' }}>Debit
                            </option>
                            <option value="kredit" {{ old('metode_pembayaran') == 'kredit' ? 'selected' : '' }}>Kredit
                            </option>
                        </select>
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
                                <input type="number" name="jumlah_barang[]" class="form-control jumlah-input" min="1"
                                    required>
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


                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary">Tambah Transaksi</button>
        </form>


    </div>
</div>
</div>
</div>
@endsection

@push('custom-js')
    <!-- Script for handling dynamic item addition and total price calculation -->
    <script>
            // Fungsi untuk mengikat event handler ke setiap input dalam grup
            function bindEventsToGroup(itemGroup) {
                const barangSelect = itemGroup.querySelector('.barang-select');
                const jumlahInput = itemGroup.querySelector('.jumlah-input');
                const totalHargaInput = itemGroup.querySelector('.total-harga');

                // Update total harga saat barang atau jumlah diubah
                barangSelect.addEventListener('change', calculateTotal);
                jumlahInput.addEventListener('input', calculateTotal);

                function calculateTotal() {
                    const harga = barangSelect.selectedOptions[0]?.getAttribute('data-harga') || 0;
                    const jumlah = jumlahInput.value || 0;
                    const total = harga * jumlah;
                    totalHargaInput.value = formatCurrency(total);
                }
            }

            // Fungsi untuk memformat jumlah sebagai mata uang "Rp."
            function formatCurrency(amount) {
                return 'Rp. ' + new Intl.NumberFormat('id-ID', {
                    style: 'decimal',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(amount);
            }

            // Menambahkan row baru
            document.getElementById('add-item').addEventListener('click', function () {
                const newItem = document.querySelector('.item-group').cloneNode(true);

                // Reset nilai input pada item baru
                newItem.querySelectorAll('input').forEach(input => input.value = '');
                newItem.querySelector('.total-harga').value = '';

                // Reset select ke default
                newItem.querySelector('.barang-select').selectedIndex = 0;

                // Ubah atribut name untuk input agar unik
                const itemIndex = document.querySelectorAll('.item-group').length;
                newItem.querySelector('.barang-select').setAttribute('name', `barang_id[${itemIndex}]`);
                newItem.querySelector('.jumlah-input').setAttribute('name', `jumlah_barang[${itemIndex}]`);
                newItem.querySelector('.total-harga').setAttribute('name', `total_harga[${itemIndex}]`);

                // Tambahkan item baru ke dalam container
                document.getElementById('item-container').appendChild(newItem);

                // Bind events ke item baru
                bindEventsToGroup(newItem);
            });

            // Inisialisasi event binding pada item pertama
            bindEventsToGroup(document.querySelector('.item-group'));
        </script>
@endpush
