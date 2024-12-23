@extends('layouts.app')

@section('content')
<div class=""><a href="/transaksi"><i class="bi bi-arrow-left-circle">Kembali ke transaksi</i></a></div>
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
                        <input type="text" name="no_transaksi" class="form-control" value="{{ $newTransaksiNumber ?? old('no_transaksi') }}" readonly>
                    </div>

                    <!-- Tanggal Transaksi -->
                    <div class="form-group">
                        <label for="tanggal_transaksi">Tanggal Transaksi:</label>
                        <input type="date" name="tanggal_transaksi" class="form-control" value="{{ now()->toDateString() }}" readonly>
                    </div>

                    <!-- Nama Kasir (Admin) -->
                    <div class="form-group">
                        <label for="kasir">Kasir (Admin):</label>
                        <input type="text" name="kasir" class="form-control" value="{{ Auth::user()->nama }}" readonly>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="form-group">
                        <label for="metode_pembayaran">Metode Pembayaran:</label>
                        <select name="metode_pembayaran" id="metode_pembayaran" class="form-control">
                            <option value="" disabled selected>Pilih Metode Pembayaran</option>
                            <option value="tunai" {{ old('metode_pembayaran') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                            <option value="debit" {{ old('metode_pembayaran') == 'debit' ? 'selected' : '' }}>Debit</option>
                            <option value="kredit" {{ old('metode_pembayaran') == 'kredit' ? 'selected' : '' }}>Kredit</option>
                        </select>
                        @error('metode_pembayaran')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
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
                                <select name="barang_id[]" class="form-control barang-select">
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
                                <input type="number" name="jumlah_barang[]" class="form-control jumlah-input" value="1" min="1">
                                @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }} , <a href="/tambahbarang">tambah barang</a>
                                    </div>
                                @endif
                            </div>

                            <!-- Total Harga Barang -->
                            <div class="form-group">
                                <label for="total_harga">Total Harga Barang:</label>
                                <input type="text" name="total_harga[]" class="form-control total-harga" readonly>
                            </div>

                            <!-- Remove Button -->
                            <button type="button" class="btn btn-danger remove-item">X</button>

                            <hr>
                        </div>
                    </div>

                    <!-- Button to add more items -->
                    <button type="button" id="add-item" class="btn btn-secondary">Tambah Barang</button>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary">Tambah Transaksi</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('custom-js')
<!-- Add Select2 CSS and JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>

<script>
    function bindEventsToGroup(itemGroup) {
        const barangSelect = $(itemGroup).find('.barang-select');
        const jumlahInput = itemGroup.querySelector('.jumlah-input');
        const totalHargaInput = itemGroup.querySelector('.total-harga');
        const removeButton = itemGroup.querySelector('.remove-item');

        barangSelect.select2(); // Initialize Select2 on the dropdown

        barangSelect.on('change', calculateTotal);
        jumlahInput.addEventListener('input', calculateTotal);
        removeButton.addEventListener('click', function() {
            itemGroup.remove();
        });

        function calculateTotal() {
            const harga = barangSelect.find(':selected').data('harga') || 0;
            const jumlah = jumlahInput.value || 0;
            const total = harga * jumlah;
            totalHargaInput.value = formatCurrency(total);
        }

        // Set initial total price based on the default quantity of 1
        calculateTotal();
    }

    function formatCurrency(amount) {
        return 'Rp. ' + new Intl.NumberFormat('id-ID', {
            style: 'decimal',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(amount);
    }

    document.getElementById('add-item').addEventListener('click', function () {
        const newItem = document.querySelector('.item-group').cloneNode(true);
        newItem.querySelectorAll('input').forEach(input => input.value = '');
        newItem.querySelector('.jumlah-input').value = 1; // Set default quantity to 1 for new items
        newItem.querySelector('.total-harga').value = '';
        newItem.querySelector('.barang-select').selectedIndex = 0;

        document.getElementById('item-container').appendChild(newItem);
        bindEventsToGroup(newItem);
    });

    // Bind events to the initial item group
    bindEventsToGroup(document.querySelector('.item-group'));
</script>
@endpush
