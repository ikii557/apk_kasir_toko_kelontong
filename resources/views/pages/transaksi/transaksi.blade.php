<?php
use App\Models\DetailTransaksi;
?>
@extends('layouts.app')
@section('content')



                        <div class="row">
                            <div class="col-lg-12 mt-12">
                            <div class="card mt-5">
                            <h4 class="p-4">Data Transaksi</h4>
                            <div class="p-4 me-4">
                                <!-- <form action="/transaksi" method="get">
                                    <div class="input-group">
                                        <input type="text"  class="text-control p-2" name=search value="{{request('search')}}">
                                        <button class="btn btn-primary">cari</button>
                                    </div>
                                </form> -->
                                <div class="float-right"><a href="/tambahtransaksi" class="btn btn-primary ">Tambah Transaksi</a></div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">No</th>
                                                <th scope="col">No transaksi</th>
                                                <th scope="col">tanggal transaksi</th>
                                                <th scope="col">Nama Kasir</th>
                                                <th scope="col">Nama Barang</th>
                                                <th scope="col">Jumlah Barang</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">metode pembayaran</th>
                                                <th scope="col">opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transaksis as $no=> $transaksi )

                                            <tr>
                                                <td>{{$no +1}}</td>
                                                <td>{{$transaksi->no_transaksi}}</td>
                                                <td>{{$transaksi->tanggal_transaksi}}</td>
                                                <td>{{ $transaksi->user ? $transaksi->user->nama : 'Tidak ada kasir' }}</td>

                                                @php
                                                    $detailtransaksis = DetailTransaksi::where('transaksi_id', $transaksi->id)->get();
                                                @endphp
                                                <td>
                                                    @foreach ($detailtransaksis as $detailtransaksi) 
                                                        {{ $detailtransaksi->barang?->nama_barang ?? "nama barang tidak ada dalam daftar barang" }},
                                                    @endforeach
                                                </td>


                                                @if ($transaksi->detailtransaksi->sum('total_harga') >= 0 && $transaksi->detailtransaksi->sum('total_harga')  < 100000)
                                                    <td><span class="label gradient-3 btn-rounded">{{ $transaksi->detailtransaksi->sum('jumlah_barang') }}</span></td>
                                                @endif
                                                @if ($transaksi->detailtransaksi->sum('total_harga') >= 100000  && $transaksi->detailtransaksi->sum('total_harga')  < 1000000)
                                                    <td><span class="label gradient-2 btn-rounded">{{ $transaksi->detailtransaksi->sum('jumlah_barang') }}</span></td>
                                                @endif
                                                @if ($transaksi->detailtransaksi->sum('total_harga') >= 1000000)
                                                <td><span class="label gradient-1 btn-rounded">{{ $transaksi->detailtransaksi->sum('jumlah_barang') }}</span></td>
                                                @endif




                                                @if ($transaksi->detailtransaksi->sum('total_harga') >= 0 && $transaksi->detailtransaksi->sum('total_harga') < 100000)
                                                    <td><span class="label gradient-3 btn-rounded">Rp. {{ number_format($transaksi->detailtransaksi->sum('total_harga'), 0, ',', '.') }}</span></td>
                                                @endif
                                                @if ($transaksi->detailtransaksi->sum('total_harga') >= 100000 && $transaksi->detailtransaksi->sum('total_harga') < 1000000)
                                                    <td><span class="label gradient-2 btn-rounded">Rp. {{ number_format($transaksi->detailtransaksi->sum('total_harga'), 0, ',', '.') }}</span></td>
                                                @endif
                                                @if ($transaksi->detailtransaksi->sum('total_harga') >= 1000000)
                                                    <td><span class="label gradient-1 btn-rounded">Rp. {{ number_format($transaksi->detailtransaksi->sum('total_harga'), 0, ',', '.') }}</span></td>
                                                @endif


                                                <td>{{$transaksi->metode_pembayaran}}</td>

                                                <td><span class="{{ auth()->user()->role == 'admin' ? 'd-none' : '' }}"><a href="/edittransaksi/{{$transaksi->id}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a>
                                                <a href="javascript:void(0);"
   data-toggle="tooltip"
   data-placement="top"
   title="Close"
   onclick="confirmDeletion({{ $transaksi->id }});">
   <i class="fa fa-close color-danger"></i>
</a>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDeletion(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus dan tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/destroy/transaksi/' + id;
            }
        });
    }
</script>
</span>
                                                <span><a href="/print/{{$transaksi->id}}" data-toggle="tooltip" data-placement="top" title="Print"><i class="bi bi-printer-fill"></i></a> </span>
                                                </td>

                                        </tr>
                                        @endforeach
                                            <!-- <tr>
                                                <td>2</td>
                                                <td>
                                                    <div class="progress" style="height: 10px">
                                                        <div class="progress-bar gradient-2" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Pisang</td>
                                                <td><span class="label gradient-2 btn-rounded">20</span>
                                                <td><span class="label gradient-2 btn-rounded">Rp 300.000</span>
                                                <td>Cash</td>
                                                <td><span><a href="#" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="#" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>
                                                    <div class="progress" style="height: 10px">
                                                        <div class="progress-bar gradient-3" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Milk tester</td>
                                                <td><span class="label gradient-3 btn-rounded">50</span></td>
                                                <td><span class="label gradient-3 btn-rounded">Rp.30.000</span></td>
                                                <td><span >kredit</span></td>
                                                <td><span><a href="#" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="#" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                                </td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                    <div>

                            </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>



@endsection
