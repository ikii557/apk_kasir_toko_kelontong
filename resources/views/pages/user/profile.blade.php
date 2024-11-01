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
    </div>
</div>

@endsection
