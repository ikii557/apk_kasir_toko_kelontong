@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-3 mt-4">
        <h4 class="p-2">Print Struk Transaksi</h4>
        <div class="card">
            <div class="card-body">
                <div class="mt-4 text-center">
                    <h4>Toko Kelontong Makmur</h4>
                    <p>Jl.banjar-majenang No. 123, madura</p>
                    <p>Telp: (0831) 34000194</p>
                </div>
                <hr>
                <div>
                    <p><strong>ID Transaksi:</strong> <span class="float-right">{{ $transaksis->no_transaksi }}</span></p>
                    <p><strong>Tanggal Transaksi:</strong> <span class="float-right">{{ $transaksis->tanggal_transaksi }}</span></p>
                    <p><strong>Kasir:</strong><span class="float-right">{{ Auth::user()->nama }}</span></p>
                    <hr>
                    <h5>Barang yang Dibeli:</h5>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksis->detailTransaksi as $detail)
                            <tr>
                                <td>{{ $detail->barang->nama_barang }}</td>
                                <td>{{ $detail->jumlah_barang }}</td>
                                <td>Rp. {{ number_format($detail->barang->harga_barang, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <div class="text-end">
                        <p><strong>Total Pembayaran:</strong>
                            Rp. {{
                                number_format(
                                    $transaksis->detailTransaksi->sum(function ($detail) {
                                        return $detail->jumlah_barang * $detail->barang->harga_barang;
                                    }), 0, ',', '.'
                                )
                            }}
                        </p>
                        <p><strong>Metode Pembayaran:</strong> {{ $transaksis->metode_pembayaran }}</p>
                    </div>


                </div>
            </div>
        </div>
    </div>
<div class="row">
    <div class="col-lg-9 mt-4">
        <h4 class="p-2">Data Laporan</h4>
        <div class="card">
            <div class="p-2 mt-4 me-4">
                <p><strong>Laporan Penjualan Hari Ini</strong></p>

                <div class="mb-2">
                    <p><strong>Total Transaksi:</strong> {{ $transaksis->count() }}</p>
                    <p><strong>Total Pendapatan:</strong> Rp. {{ number_format($total_harga, 0, ',', '.') }}</p>
                    <p><strong>Total Barang Terjual:</strong> {{ $total_barang }}</p>
                </div>

                <table class="table table-bordered table-sm mt-3">
                    <thead>
                        <tr>
                            <th>No Transaksi</th>
                            <th>Kasir</th>
                            <th>Tanggal</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksis as $transaction)
                            @foreach ($transaction->detailTransaksi as $detail)
                                <tr>
                                    <td>{{ $transaction->no_transaksi }}</td>
                                    <td>{{ $transaction->user->nama }}</td>
                                    <td>{{ $transaction->tanggal_transaksi }}</td>
                                    <td>{{ $detail->barang->nama_barang }}</td>
                                    <td>{{ $detail->jumlah_barang }}</td>
                                    <td>Rp. {{ number_format($detail->jumlah_barang * $detail->barang->harga_barang, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Data Transaksi Table -->
    <div class="col-lg-12 mt-4">
        <div class="card">
            <h4 class="p-4">Data Transaksi</h4>
            <div class="p-4 me-4">
                <form action="/transaksi" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control p-2" name="search" value="{{ request('search') }}">
                        <button class="btn btn-primary">Cari</button>
                    </div>
                    <div class="float-right"><a href="/tambahtransaksi" class="btn btn-primary">Tambah Transaksi</a></div>
                </form>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>



</div>



@endsection
