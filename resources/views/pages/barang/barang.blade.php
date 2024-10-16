@extends('layouts.app')
@section('content')




            <div class="card">
                <p>DATA DATA BARANG</p>
            </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="active-member">
                                    <div class="table-responsive">
                                        <table class="table table-xs mb-0">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>Nama Barang</th>
                                                    <th>Harga barang</th>
                                                    <th>Stok Barang</th>
                                                    <th>Opsi<th>
                                                </tr>
                                            </thead>
                                            <tbody>@foreach ($barangs as $no=> $produk )

                                                <tr>
                                                    <td>{{$no +1 }}</td>
                                                    <td>{{$produk-> nama_barang}}</td>
                                                    <td>
                                                        <span>{{$produk-> harga_barang}}</span>
                                                    </td>
                                                    <td>{{$produk->jumblah_barang}}</td>
                                                    <td>
                                                        <!-- <div>
                                                            <div class="progress" style="height: 6px">
                                                                <div class="progress-bar bg-success" style="width: 50%"></div>
                                                            </div>
                                                        </div> -->
                                                    </td>
                                                    <td><span><a href="#" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="#" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                                </td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td><img src="./images/avatar/2.jpg" class=" rounded-circle mr-3" alt="">2</td>
                                                    <td>Pixel 2</td>
                                                    <td><span>Rp.4.404.000</span></td>
                                                    <td>
                                                        <div>
                                                            <!-- <div class="progress" style="height: 6px">
                                                                <div class="progress-bar bg-success" style="width: 50%"></div>
                                                            </div> -->
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img src="./images/avatar/3.jpg" class=" rounded-circle mr-3" alt="">3</td>
                                                    <td>OnePlus</td>
                                                    <td><span>Rp.300.000</span></td>
                                                    <td>
                                                        <div>
                                                            <!-- <div class="progress" style="height: 6px">
                                                                <div class="progress-bar bg-warning" style="width: 50%"></div>
                                                            </div> -->
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img src="./images/avatar/6.jpg" class=" rounded-circle mr-3" alt="">4</td>
                                                    <td>Galaxy</td>
                                                    <td><span>Rp.300.000</span></td>
                                                    <td>
                                                        <div>
                                                            <!-- <div class="progress" style="height: 6px">
                                                                <div class="progress-bar bg-success" style="width: 50%"></div>
                                                            </div> -->
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img src="./images/avatar/4.jpg" class=" rounded-circle mr-3" alt="">5</td>
                                                    <td>Moto Z2</td>
                                                    <td><span>Rp.300.000</span></td>
                                                    <td>
                                                        <div>
                                                            <!-- <div class="progress" style="height: 6px">
                                                                <div class="progress-bar bg-success" style="width: 50%"></div>
                                                            </div> -->
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img src="./images/avatar/5.jpg" class=" rounded-circle mr-3" alt="">6</td>
                                                    <td>Notebook Asus</td>
                                                    <td><span>Rp.300.000</span></td>
                                                    <td>
                                                        <div>
                                                            <!-- <div class="progress" style="height: 6px">
                                                                <div class="progress-bar bg-warning" style="width: 50%"></div>
                                                            </div> -->
                                                        </div>
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


@endsection
