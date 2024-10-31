@extends('layouts.app')

@section('content')
<di class="row">
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


    <div class="p-2 mt-4 me-3">
    <h4>Data Laporan Transaksi</h4>
    <div class="card mt-3">
        <div class="card-body">
            {{-- Filter options --}}
            <form action="/report" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <label for="start_date">Tanggal Mulai:</label>
                        <input type="date" name="start_date" id="start_date" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="end_date">Tanggal Akhir:</label>
                        <input type="date" name="end_date" id="end_date" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="kasir">Kasir:</label>
                        <select name="kasir" id="kasir" class="form-control">
                            <option value="">Semua Kasir</option>

                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary mt-4">Filter</button>
                    </div>
                </div>
            </form>

            {{-- Laporan Pengeluaran --}}
           



</div>



@endsection
