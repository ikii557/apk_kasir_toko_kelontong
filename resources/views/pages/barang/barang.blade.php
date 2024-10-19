@extends('layouts.app')

@section('content')


            <div class="row">
                <div class="col-lg-6 mt-4">
                <div class="card">
                    <h2>Tambah Barang</h2>
                        <div class="p-2 me-4">
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
                                            <td>{{ $no +1}}</td>
                                            <td>{{ $barang->nama_barang }}</td>
                                            <td>{{ $barang->stok_barang }}</td>
                                            <td>Rp.{{ $barang->harga_barang }}</td>
                                            <td>
                                                <a href="/editbarang/{{$barang->id}}" class="btn btn-warning">Edit</a>
                                                <a href="/destroy/{{$barang->id}}" class="btn btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
@endsection
