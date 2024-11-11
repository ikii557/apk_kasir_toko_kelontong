@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 col-xl-3">
            <div class="card">
                <!-- Profile Background Section with Cover Image -->
                <div class="profile-background position-relative" style="background-image: url('{{ asset('assets/images/imgs/6.png') }}'); background-size: cover; background-position: center; height: 150px; border-radius: 0.375rem 0.375rem 0 0;">
                    <div class="profile-image-container" style="position: absolute; bottom: -40px; left: 50%; transform: translateX(-50%);">
                        <img class="rounded-circle border border-white" src="{{ asset('assets/images/avatar/11.png') }}" width="80" height="80" alt="">
                    </div>
                </div>

                <!-- Profile Info Section -->
                <div class="card-body text-center" style="margin-top: 40px;">
                    <h3 class="mb-0">{{ Auth::user()->nama }}</h3>
                    <p class="text-muted mb-1">Madura</p>
                    <p><ul class="list-unstyled text-start mt-3">
                        <li class="mb-1"><strong class="text-dark">Jabatan:</strong> <span>{{ Auth::user()->role }}</span></li>
                    </ul></p>

                    <ul class="list-unstyled text-start mt-3">
                        <li class="mb-1"><strong class="text-dark">Mobile:</strong> <span>{{ Auth::user()->no_hp }}</span></li>
                        <li><strong class="text-dark">Email:</strong> <span>{{ Auth::user()->email }}</span></li>
                    </ul>

                    <!-- Edit Profile Button -->
                    <button class="btn btn-primary mt-3">Edit Profile</button>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xl-9">
            <div class="card">
                <h4 class="p-4">Data kasir

                @if(Auth::user()->role == 'superadmin')
                <span class="float-right"><a href="/tambahkasir" class="btn btn-primary">Tambah Kasir</a></span>
                @endif
                </h4>

                <div class="p-2">
                <table class="table table-bordered ">
                    <thead>
                        <tr class="table-active">
                            <th>No</th>
                            <th>Nama</th>
                            <th>No Hp</th>
                            @if(Auth::user()->role == 'superadmin')
                                <th>Email</th>
                            @endif
                            <th>Jabatan</th>
                            @if(Auth::user()->role == 'superadmin')
                                <th>opsi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $no=> $kasir )
                        <tr>
                            <td>{{$no +1}}</td>
                            <td>{{$kasir->nama}}</td>
                            <td><i class="bi bi-whatsapp"></i> {{$kasir->no_hp}}</td>
                            @if(Auth::user()->role == 'superadmin')
                            <td><i class="bi bi-envelope-dash"></i> {{$kasir->email}}</td>
                            @endif
                            <td>{{$kasir->role}}</td>
                            @if(Auth::user()->role == 'superadmin')
                            <td>
                                <span>
                                    <a href="/editprofile/{{$kasir->id}}" class="btn btn-info btn-sm" style="border-radius: 5px;">Edit</a>
                                    <a href="" class="btn btn-danger btn-sm" style="border-radius: 5px;">Hapus</a>
                                </span>
                            </td>


                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
