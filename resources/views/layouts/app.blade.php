<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

    <!-- navbar -->
     @include('layouts.navbar')
     <!-- endnavbar -->


     <!-- sidebar -->
      @include('layouts.sidebar')
    <!-- endsidebar -->

    <!-- content -->
    <div class="content-body">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    <!-- endcontent -->


    <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="{{asset('assets/https://themeforest.net/user/quixlab')}}">Quixlab</a> 2024</p>
            </div>
        </div>
        <!--**********************************
        Footer end
        ***********************************-->
    </div>
        @include('layouts.footer')


    @stack('custom-js')
</body>

</html>
