@extends('layouts.app')

@section('content')
<div class=""><a href="/transaksi"><i class="bi bi-arrow-left-circle">Kembali ke transaksi</i></a></div>
<div class="container">
    <h2>Edit Transaksi</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="p-3 mt-4 me-4">
            <form action="/updatetransaksi/{{ $transaksi->id }}" method="POST">
                @csrf

                <!-- Nama Kasir -->
                <div class="form-group">
                    <label for="kasir">Kasir (Admin):</label>
                    <input type="text" name="kasir" class="form-control" value="{{ $transaksi->user->nama }}" readonly>
                </div>

                <div id="items-container">
                    <!-- Existing Detail Transaksi -->
                    @foreach($transaksi->detailTransaksi as $key => $item)
                        <div class="item-entry" data-index="{{ $key }}">
                            <div class="form-group">
                                <label for="barang_id_{{ $key }}">Nama Barang:</label>
                                <select name="detail_transaksi[{{ $key }}][barang_id]" class="form-control barang-select" data-index="{{ $key }}" required>
                                    <option value="" disabled>Pilih Barang</option>
                                    @foreach ($barangs as $produk)
                                        <option value="{{ $produk->id }}"
                                                data-harga="{{ $produk->harga_barang }}"
                                                data-stok="{{ $produk->stok_barang }}"
                                                {{ $item->barang_id == $produk->id ? 'selected' : '' }}>
                                            {{ $produk->nama_barang }} - Stok: {{ $produk->stok_barang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jumlah_barang_{{ $key }}">Jumlah Barang:</label>
                                <input type="number" name="detail_transaksi[{{ $key }}][jumlah_barang]" value="{{ $item->jumlah_barang }}" class="form-control jumlah-input" data-index="{{ $key }}" min="1" required>
                            </div>

                            <div class="form-group">
                                <label for="total_harga_{{ $key }}">Harga:</label>
                                <input type="text" name="detail_transaksi[{{ $key }}][total_harga]" value="{{ $item->total_harga }}"  class="form-control total-harga" data-index="{{ $key }}" readonly>
                            </div>
                            <!-- Remove button for existing items -->
                            <button type="button" class="btn btn-danger btn-sm remove-item" data-index="{{ $key }}">X</button>
                        </div>
                    @endforeach
                </div>

                <!-- Button to Add New Item -->
                <button type="button" class="btn btn-secondary mt-3" id="add-item">Tambah Barang</button>
                <button type="submit" class="btn btn-primary mt-3">Edit Transaksi</button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const itemsContainer = document.getElementById('items-container');
    let itemIndex = {{ count($transaksi->detailTransaksi) }};

    function calculateTotal(index) {
        const selectedOption = document.querySelector(`select[data-index="${index}"] option:checked`);
        const hargaBarang = parseFloat(selectedOption.getAttribute('data-harga'));
        const stokBarang = parseInt(selectedOption.getAttribute('data-stok'));
        const jumlahInput = document.querySelector(`input[data-index="${index}"].jumlah-input`);
        const totalHargaInput = document.querySelector(`input[data-index="${index}"].total-harga`);
        const jumlahBarang = parseInt(jumlahInput.value);

        if (jumlahBarang > stokBarang) {
            alert(`Stok tidak mencukupi. Stok tersedia: ${stokBarang}`);
            jumlahInput.value = stokBarang;
            return;
        }

        if (!isNaN(hargaBarang) && !isNaN(jumlahBarang)) {
            const totalHarga = hargaBarang * jumlahBarang;
            totalHargaInput.value = totalHarga.toLocaleString('id-ID');
        }
    }

    document.getElementById('add-item').addEventListener('click', () => {
        const newItem = `
            <div class="item-entry" data-index="${itemIndex}">
                <div class="form-group">
                    <label for="barang_id_${itemIndex}">Nama Barang:</label>
                    <select name="detail_transaksi[${itemIndex}][barang_id]" class="form-control barang-select" data-index="${itemIndex}" required>
                        <option value="" disabled selected>Pilih Barang</option>
                        @foreach ($barangs as $produk)
                            <option value="{{ $produk->id }}"
                                    data-harga="{{ $produk->harga_barang }}"
                                    data-stok="{{ $produk->stok_barang }}">
                                {{ $produk->nama_barang }} - Stok: {{ $produk->stok_barang }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="jumlah_barang_${itemIndex}">Jumlah Barang:</label>
                    <input type="number" name="detail_transaksi[${itemIndex}][jumlah_barang]" class="form-control jumlah-input" data-index="${itemIndex}" min="1" required>
                </div>
                <div class="form-group">
                    <label for="total_harga_${itemIndex}">Harga:</label>
                    <input type="text" name="detail_transaksi[${itemIndex}][total_harga]" class="form-control total-harga" data-index="${itemIndex}" readonly>
                </div>
                <button type="button" class="btn btn-danger btn-sm remove-item" data-index="${itemIndex}">X</button>
            </div>
        `;
        itemsContainer.insertAdjacentHTML('beforeend', newItem);
        itemIndex++;
    });

    itemsContainer.addEventListener('input', function(event) {
        const target = event.target;
        if (target.classList.contains('jumlah-input')) {
            const index = target.getAttribute('data-index');
            calculateTotal(index);
        }
    });

    itemsContainer.addEventListener('change', function(event) {
        const target = event.target;
        if (target.classList.contains('barang-select')) {
            const index = target.getAttribute('data-index');
            calculateTotal(index);
        }
    });

    itemsContainer.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-item')) {
            const index = event.target.getAttribute('data-index');
            const itemEntry = document.querySelector(`.item-entry[data-index="${index}"]`);
            if (itemEntry) {
                itemEntry.remove();
            }
        }
    });
});
</script>
@endsection
