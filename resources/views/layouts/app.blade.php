<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
    <style>
    /* Print-only CSS */
    @media print {
        /* Hide non-essential items */
        body * {
            visibility: hidden;
        }

        /* Only display the card content */
        .card, .card * {
            visibility: visible;
        }

        /* Center the card and make it full-width */
        .card {
            width: 100%;
            margin: 0 auto;
            border: none; /* Remove border */
            box-shadow: none;
        }

        /* Adjust spacing and remove colors */
        .card-body, .table {
            padding: 0;
            margin: 0;
            color: #000;
        }

        /* Set fonts for print readability */
        h4, p, th, td {
            font-size: 14px;
            line-height: 1.5;
        }

        /* Remove backgrounds and shadows */
        .card-body, .table thead th, .table tbody td, .table {
            background-color: #fff !important;
            -webkit-print-color-adjust: exact;
        }

        /* Borders for table */
        .table, .table thead th, .table tbody td {
            border: 1px solid #000;
        }

        /* Align items properly */
        .text-center {
            text-align: center;
        }

        .float-right {
            float: right;
        }

        /* Hide icons and unnecessary links */
        .float-right a {
            display: none;
        }
    }
</style>

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
