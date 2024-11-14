@extends('layouts.app')

@section('content')

<div class=""><a href="/transaksi"><i class="bi bi-arrow-left-circle">Kembali ke transaksi</i></a></div>
<div class="row">
    <div class="col-lg-3 mt-4">
        <h4 class="p-2">Print Struk Transaksi</h4>
        <div class="card">
            <div class="card-body">
                <div class="float-right">
                    <a href="javascript:void(0);" onclick="window.print();"><i class="bi bi-printer"></i></a>
                </div>

                <div class="mt-4 text-center">
                    <h4>Toko Kelontong Makmur</h4>
                    <p>Jl.banjar-majenang No. 123, madura</p>
                    <p>Telp: (0831) 34000194</p>
                </div>
                <hr>
                <div>
                    <p><strong>ID Transaksi:</strong> <span class="float-right">{{ $transaksis->no_transaksi }}</span></p>
                    <p><strong>Tanggal Transaksi:</strong> <span class="float-right">{{ $transaksis->tanggal_transaksi }}</span></p>
                    <p><strong>Kasir:</strong> <span class="float-right">{{ $transaksis->user->nama }}</span></p>
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
                                <td>{{ $detail->barang->nama_barang  }}</td>
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
                        <hr>
                        <p class="text-center">Hubungi costumer service kami <strong>083134000194</strong> jika anda mengalami masalah dalam berbelanja di toko kami
                            <span class="text-center">Terimakasih</span> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
