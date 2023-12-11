<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="assets/" data-template="vertical-menu-template-free">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>SIMPATI | Sistem Informasi Panti Asuhan</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.jpg') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">

    <!-- SweetAlert 2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.cdnfonts.com/css/quicksand" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        #dataTable_wrapper .dataTables_paginate .paginate_button .dataTables_length label {
            font-family: Satoshi-Variable;
            src: url('{{ asset('assets/font/Satoshi-Variable.ttf') }}');
        }

        .quick-sand {
            font-family: Satoshi-Variable;
            src: url('{{ asset('assets/font/Satoshi-Variable.ttf') }}');
        }

        .w-90 {
            width: 95%;
        }

        .rounded-search {
            border: black 2px solid;
            border-radius: 20px;
            padding-left: 8px;
            padding-right: 8px;
        }

        .swal2-container {
            z-index: 9999;
            /* Atur nilai z-index sesuai kebutuhan */
        }

        .pad-rem {
            padding: 0 1.5rem;
        }
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <img src="{{ asset('logo.jpg') }}" alt="" width="50px" height="50px">
                    <span class="app-brand-text demo menu-text fw-bold ms-2">SIMPATI</span>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>
                <ul class="menu-inner py-1">
                    <!-- Dashboards -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Dashboard</span></li>
                    <!-- Cards -->
                    <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Basic">Dashboard</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('pengurus-panti/data-pengurus') ? 'active' : '' }}">
                        <a href="{{ route('data-pengurus.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bxs-user-voice"></i>
                            <div data-i18n="Basic">Pengurus Panti</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('artikel/data-artikel') ? 'active' : '' }}">
                        <a href="{{ route('data-artikel.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-box"></i>
                            <div data-i18n="Basic">Artikel</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Program Panti</span>
                    </li>
                    <li class="menu-item {{ request()->is('program-panti/jenis-program') ? 'active' : '' }}">
                        <a href="{{ route('jenis-program.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bxs-party"></i>
                            <div data-i18n="Documentation">Jenis Program Panti</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('program-panti/data-program') ? 'active' : '' }}">
                        <a href="{{ route('data-program.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bxs-calendar-event"></i>
                            <div data-i18n="Support">Program Panti</div>
                        </a>
                    </li>
                    <!-- Misc -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Anak Asuh</span></li>
                    <li class="menu-item {{ request()->is('anak-asuh/data-anak') ? 'active' : '' }}">
                        <a href="{{ route('data-anak.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-child"></i>
                            <div data-i18n="Support">Data Anak Asuh</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('anak-asuh/pendidikan-anak') ? 'active' : '' }}">
                        <a href="{{ route('pendidikan-anak.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bxs-school"></i>
                            <div data-i18n="Documentation">Pendidikan Anak Asuh</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('anak-asuh/kesehatan-anak') ? 'active' : '' }}">
                        <a href="{{ route('kesehatan-anak.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bxs-heart"></i>
                            <div data-i18n="Documentation">Kesehatan Anak Asuh</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('anak-asuh/prestasi-anak') ? 'active' : '' }}">
                        <a href="{{ route('prestasi-anak.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-medal"></i>
                            <div data-i18n="Documentation">Prestasi Anak Asuh</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center w-90">
                            <form class="w-100" id="searchForm">
                                <div class="nav-item d-flex align-items-center w-100 rounded-search">
                                    <div class="">
                                        <i class="bx bx-search fs-4 lh-0"></i>
                                    </div>
                                    <div class="w-90">
                                        <input type="text" class="form-control border-0 shadow-none ps-1 ps-sm-3"
                                            width="75%" name="q" placeholder="Search..."
                                            aria-label="Search..." id="search" />
                                    </div>
                                    <i class='bx bx-x' id="clearSearch" style="cursor: pointer;"></i>
                                </div>
                            </form>
                        </div>

                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Place this tag where you want the button to render. -->
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt
                                                            class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-medium d-block">John Doe</span>
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-cog me-2"></i>
                                            <span class="align-middle">Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" class="dropdown-item"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                            href="#">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none" hidden>
                    @csrf
                </form>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <!-- / Content -->
                    @yield('content')
                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <!-- Add these CDN links in your HTML head section -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    @yield('scripts')

</body>

</html>
