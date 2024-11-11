@extends('layouts.app')

@section('content')
    <div class="container">
    <div class=""><a href="/barang"><i class="bi bi-arrow-left-circle">Kembali ke data Barang</i></a></div>
    <br>
        <h2>Edit Barang </h2>

        <div class="card">
            <div class="p-4 mt-4 me-4">
            <form action="/updatebarang/{{$dataBarang->id}}" method="POST">
            @csrf
            <div class=" mb-3">
                <span class="" id="basic-addon1">Nama Barang</span>
                <input name="nama_barang" value="{{$dataBarang->nama_barang}}" type="text" class="form-control" placeholder="masukan nama_barang" aria-label="nama_barang" aria-describedby="basic-addon1">
                @error('nama_barang')
                <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class=" mb-3">
                    <span class="" id="basic-addon1">Harga barang</span>
                    <input name="harga_barang" value="{{$dataBarang->harga_barang}}" type="text" class="form-control" placeholder="masukan harga_barang" aria-label="harga_barang" aria-describedby="basic-addon2">
                    @error('harga_barang')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class=" mb-3">
                    <span class="" id="basic-addon1">Stok Barang</span>
                    <input name="stok_barang" value="{{$dataBarang->stok_barang}}" type="text" class="form-control" placeholder="masukan stok_barang" aria-label="stok_barang" aria-describedby="basic-addon3">
                    @error('stok_barang')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary">Edit Barang</button>
        </form>
            </div>
        </div>
    </div>
@endsection
