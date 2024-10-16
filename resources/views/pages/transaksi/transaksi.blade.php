@extends('layouts.app')
@section('content')


                    <div class="card-body">
                        <span>Data Transaksi</span>
                    </div>

                    <div class="row">
                    <div class="col-lg-6 mt-4">
                        <div class="card ">
                            <div class="card-body">
                                <h4 class="card-title">Data Transaksi</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped verticle-middle">
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
                                                <td>{{$no +1}}</td>
                                                <td>{{$transaksi->barang->nama_barang}}</td>
                                                <td><span class="label gradient-1 btn-rounded">{{$transaksi->jml_barang}}</span></td>
                                                <td><span class="label gradient-3 btn-rounded">{{$transaksi->total_harga}}</span></td>
                                                <td>{{$transaksi->metode_pembayaran}}</td>

                                                <td><span><a href="#" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="#" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a></span>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-6 mt-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Tambah Transaksi</h4>
                                <div class="table-responsive">
                                <form action="" method="POST">
                                    @csrf

                                    <div>
                                        <label for="barang_id">Pilih Barang</label>
                                        <select name="barang_id" id="barang_id" required>
                                            <option value="">-- Pilih Barang --</option>

                                        </select>
                                    </div>

                                    <div>
                                        <label for="jml_barang">Jumlah Barang</label>
                                        <input type="number" name="jml_barang" id="jml_barang" min="1" required>
                                    </div>

                                    <div>
                                        <label for="metode_pembayaran">Metode Pembayaran</label>
                                        <input type="text" name="metode_pembayaran" id="metode_pembayaran" required>
                                    </div>

                                    <button type="submit">Tambah Transaksi</button>
                                </form>

                                </div>
                            </div>
                        </div>
                    </div> -->
                    </div>
@endsection
