@extends('layouts.app')

@section('content')


            <div class="row">
                <div class="col-lg-6 mt-4">
                <div class="card">
                    <div class="p-2 me-4">
                            <h2>Tambah Barang</h2>
                            <form action="/store/barang" method="post">
                            @csrf

                            <!-- Nama Barang -->
                            <div class="form-group">
                                <label for="nama_barang">Nama Barang:</label>
                                <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="{{ old('nama_barang') }}" placeholder="isi nama barang">

                            </div>

                            <!-- Stok -->
                            <div class="form-group">
                                <label for="stok">Jumlah Stok:</label>
                                <input type="number" name="stok_barang" id="stok" class="form-control" value="{{ old('stok') }}" placeholder="isi jumlah stok">
                            </div>

                            <!-- Harga Barang -->
                            <div class="form-group">
                                <label for="harga_barang">Harga Barang (Rp):</label>
                                <input type="number" name="harga_barang" id="harga_barang" class="form-control" value="{{ old('harga_barang') }}" step="0.01" placeholder="isi harga barang">
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary mt-3">Tambah Barang</button>
                        </form>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 mt-4">
                <div class="card">
                    <div class="p-2 mt-4 me-4">

                        <h1>Daftar Barang</h1>
                        <form action="/barang" method="get">
                            <div class="input-group">
                                <input type="text"  class="text-control" name=search value=" {{request('search')}}">
                                <button class="btn btn-primary">cari</button>
                            </div>
                        </form>
                            <table class="table table-bordered mt-2">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Stok</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($barangs as $no=> $barang)
                                    <tr>
                                            <td>{{ $barangs->firstItem() + $no}}</td>
                                            <td>{{ $barang->nama_barang }}</td>
                                            <td>
                                                <h6>Sisa Barang <span class="pull-right">{{ $barang->stok_barang }}</span></h6>
                                                <div class="progress mb-3" style="height: 7px">
                                                    @if ($barang->stok_barang > 100)
                                                        <!-- Warna gradient-1 jika stok lebih dari 100 -->
                                                        <div class="progress-bar gradient-1" style="width: 100%;" role="progressbar">
                                                            <span class="sr-only">{{ $barang->stok_barang }}% Stok</span>
                                                        </div>
                                                    @elseif ($barang->stok_barang > 50)
                                                        <!-- Warna gradient-2 jika stok antara 51 dan 100 -->
                                                        <div class="progress-bar gradient-2" style="width: {{ $barang->stok_barang }}%;" role="progressbar">
                                                            <span class="sr-only">{{ $barang->stok_barang }}% Stok</span>
                                                        </div>
                                                    @else
                                                        <!-- Warna gradient-3 jika stok 50 atau kurang -->
                                                        <div class="progress-bar gradient-3" style="width: {{ $barang->stok_barang }}%;" role="progressbar">
                                                            <span class="sr-only">{{ $barang->stok_barang }}% Stok</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>





                                            <td>Rp.{{ $barang->harga_barang }}</td>
                                            <td>
                                                <a href="/editbarang/{{$barang->id}}" class="btn btn-info">Edit</a>
                                                <a href="/destroy/barang/{{$barang->id}}" class="btn btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div>
                                {{$barangs->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
