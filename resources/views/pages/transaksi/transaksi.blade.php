@extends('layouts.app')
@section('content')



                        <div class="row">
                            <div class="col-lg-12 mt-4">

                            <div class="card ">
                            <h4 class="p-4">Data Transaksi</h4>
                            <div class="p-4 me-4">
                                <form action="/transaksi" method="get">
                                    <div class="input-group">
                                        <input type="text"  class="text-control p-2" name=search value="{{request('search')}}">
                                        <button class="btn btn-primary">cari</button>
                                    </div>
                                    <div class="float-right"><a href="/tambahtransaksi" class="btn btn-primary">Tambah Transaksi</a></div>
                            </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
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
                                                <td>{{$transaksis->firstItem() + $no}}</td>
                                                <td>{{$transaksi->barang->nama_barang}}</td>
                                                <td><span class="label gradient-1 btn-rounded">{{$transaksi->jumlah_barang}}</span></td>
                                                <td><span class="label gradient-3 btn-rounded">{{$transaksi->total_harga}}</span></td>
                                                <td>{{$transaksi->metode_pembayaran}}</td>

                                                <td><span><a href="/edittransaksi/{{$transaksi->id}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a>
                                                <a href="/destroy/{{$transaksi->id}}" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a></span>
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
                                {{$transaksis->links()}}
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>



@endsection
