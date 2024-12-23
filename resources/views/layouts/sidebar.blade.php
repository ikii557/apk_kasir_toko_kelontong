<!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    <li>
                        <a class="" href="/index" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                        <!-- <a class="has-arrow" href="/datatable" aria-expanded="false">
                            <i class="icon-globe-alt menu-icon"></i><span class="nav-text">Data table</span>
                        </a> -->
                    </li>
                    <!-- <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-globe-alt menu-icon"></i><span class="nav-text">Data Barang</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="">Blank</a></li>
                            <li><a href="">One Column</a></li>
                            <li><a href="">Two column</a></li>
                            <li><a href="">Compact Nav</a></li>
                            <li><a href="">Vertical</a></li>
                            <li><a href="">Horizontal</a></li>
                            <li><a href="">Boxed</a></li>
                            <li><a href="">Wide</a></li>


                            <li><a href="">Fixed Header</a></li>
                            <li><a href="">Fixed Sidebar</a></li>
                        </ul>
                    </li> -->
                    <li class="nav-label">Apps</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-grid menu-icon"></i> <span class="nav-text">Data Barang</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/barang">barang</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-envelope menu-icon"></i> <span class="nav-text">Data Transaksi</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/transaksi">transaksi</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Pages</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-screen-tablet menu-icon"></i><span class="nav-text">User</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/profile">Profile</a></li>
                            <!-- <li><a href="/tambahadmin">Tambah admin</a></li> -->
                            <a href="javascript:void(0);"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Logout"
                            onclick="confirmLogout();"
                            class="btn btn-sm btn-danger">
                            Logout
                            </a>

                            <!-- Formulir logout tersembunyi -->
                            <form id="logout-form" action="{{ '/logout' }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            <!-- SweetAlert2 -->
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                                function confirmLogout() {
                                    Swal.fire({
                                        title: 'Apakah Anda yakin?',
                                        text: "Anda akan logout dari sesi ini.",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Ya, logout',
                                        cancelButtonText: 'Batal'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Kirim formulir logout
                                            document.getElementById('logout-form').submit();
                                        }
                                    });
                                }
                            </script>


                        </ul>
                    </li>
                    <!-- <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="bi bi-flag-fill"> Data Laporan</i><span class="nav-text"></span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/logout">Pemasukan</a></li>
                            <li><a href="/report">Pengeluaran</a></li>

                        </ul>
                    </li> -->

                </ul>

            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
