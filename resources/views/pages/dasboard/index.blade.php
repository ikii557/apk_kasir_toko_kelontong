@extends('layouts.app')
@section('content')
  <!--**********************************
            Content body start
        ***********************************-->


            <div class="container-fluid mt-4">
                <div class="row ">
                    <div class="col-lg-4 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h3 class="card-title text-white">Produk terjual</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $produkTerjual }}</h2>
                                    <p class="text-white mb-0">Jan - March 2024</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <h3 class="card-title text-white">Daftar Barang</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $stokBarang }}</h2>
                                    <p class="text-white mb-0">Jan - March 2024</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <h3 class="card-title text-white">Pendapatan</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">Rp.{{$detail}}</h2>
                                    <p class="text-white mb-0">Jan - March 2024</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body pb-0 d-flex justify-content-between">
                                        <div>
                                            <h4 class="mb-1">Pendapatan  Penjualan</h4>
                                            <p>total barang terjual dalam bulan ini</p>
                                            <h3 class="m-0">Rp.{{$detail}}</h3>
                                        </div>
                                        <div>
                                            <ul>
                                                <li class="d-inline-block mr-3"><a class="text-dark" href="#">harian</a></li>
                                                <li class="d-inline-block mr-3"><a class="text-dark" href="#">mingguan</a></li>
                                                <li class="d-inline-block"><a class="text-dark" href="#">bulanan</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chart-wrapper">
                                        <canvas id="chart_widget_2"></canvas>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="w-100 mr-2">
                                                <h6>Pixel 2</h6>
                                                <div class="progress" style="height: 6px">
                                                    <div class="progress-bar bg-danger" style="width: 40%"></div>
                                                </div>
                                            </div>
                                            <div class="ml-2 w-100">
                                                <h6>iPhone X</h6>
                                                <div class="progress" style="height: 6px">
                                                    <div class="progress-bar bg-primary" style="width: 80%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Order Summary</h4>
                                    <div id="morris-bar-chart"></div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="card">
                                <div id="world-map" style="height: 470px;"></div>

                            </div>
                        </div>
                    </div>





            </div>
            <!-- #/ container -->

            <!--**********************************
            Content body end
        ***********************************-->

@endsection










