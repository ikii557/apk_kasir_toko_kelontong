@extends('layouts.app')
@section('content')

<div class="row">
    <!-- Filter Form -->
    <div class="col-lg-12 mb-4">
        <form method="GET" action="{{ route('report.index') }}">
            <div class="form-row">
                <div class="col">
                    <label for="start_date">Start Date</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ $startDate ?? '' }}">
                </div>
                <div class="col">
                    <label for="end_date">End Date</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $endDate ?? '' }}">
                </div>
                <div class="col align-self-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Expenditure Report (Pengeluaran) -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>Laporan Pengeluaran</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Transaksi</th>
                            <th>Tanggal Transaksi</th>
                            <th>Nama Kasir</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Harga</th>
                            <th>Metode Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengeluaran as $index => $transaksi)
                            @foreach($transaksi->detailtransaksi as $detail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $transaksi->no_transaksi }}</td>
                                    <td>{{ $transaksi->tanggal_transaksi }}</td>
                                    <td>{{ $transaksi->user->name ?? 'N/A' }}</td>
                                    <td>{{ $detail->nama_barang }}</td>
                                    <td>{{ $detail->jumlah_barang }}</td>
                                    <td>{{ $detail->harga }}</td>
                                    <td>{{ $transaksi->metode_pembayaran }}</td>
                                </tr>
                            @endforeach
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No transactions found for the selected date range.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
