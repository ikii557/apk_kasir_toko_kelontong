@extends('layouts.app')
@section('content')


            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center mb-4">
                                    <img class="mr-3" src="{{asset('assets/images/avatar/11.png')}}" width="80" height="80" alt="">
                                    <div class="media-body">
                                        <h3 class="mb-0">{{Auth::user()->nama}}</h3>
                                        <p class="text-muted mb-0">Madura</p>
                                    </div>
                                </div>

                                <div class="row mb-5">
                                    <div class="col">
                                        <div class="card card-profile text-center">
                                            <span class="mb-1 text-primary"><i class="icon-people"></i></span>
                                            <h3 class="mb-0">263</h3>
                                            <p class="text-muted px-4">Following</p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card card-profile text-center">
                                            <span class="mb-1 text-warning"><i class="icon-user-follow"></i></span>
                                            <h3 class="mb-0">263</h3>
                                            <p class="text-muted">Followers</p>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button class="btn btn-info px-5"><a href="/editprofile" class="text-white">Edit Profile</a>
                                        </button>
                                    </div>
                                </div>

                                <h4>Bio</h4>
                                <p class="text-muted">Hi, I'm Pikamy, has been the industry standard dummy text ever since the 1500s.</p>
                                <ul class="card-profile__info">
                                    <li class="mb-1"><strong class="text-dark mr-4">Mobile</strong> <span>{{Auth::user()->no_hp}}</span></li>
                                    <li><strong class="text-dark mr-4">Email</strong> <span>{{Auth::user()->email}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- #/ container -->


@endsection
