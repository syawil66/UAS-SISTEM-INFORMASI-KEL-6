<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'SIAKAD SMA')</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-text mx-3">SIAKAD</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item {{ request()->routeIs('profilSekolah.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('profilSekolah.index') }}">
                    <i class="fas fa-fw fa-school"></i>
                    <span>Profil Sekolah </span></a>
            </li>

            @if (Auth::user()->role === 'admin')

            <li class="nav-item {{ request()->routeIs('tahunPelajaran') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('tahunPelajaran') }}">
                    <i class="fas fa-fw fa-calendar-alt"></i>
                    <span>Tahun Pelajaran </span></a>
            </li>

            <li class="nav-item {{ request()->routeIs('akademik.matapelajaran.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('akademik.matapelajaran.index') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Data Akademik</span></a>
            </li>

            <li class="nav-item {{ request()->routeIs('guru.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('guru.index') }}">
                    <i class="fas fa-fw fa-chalkboard-teacher"></i>
                    <span>Data Guru</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa.index')}}">
                    <i class="fas fa-fw fa-user-graduate"></i>
                    <span>Data Siswa</span></a>
            </li>

            @elseif (Auth::user()->role === 'guru')

            <li class="nav-item"><a class="nav-link" href="#"></a>
                <i class="fas fa-fw fa-user-graduate"></i>
                <span>Data Siswa</span>
            </li>

            <li class="nav-item"><a class="nav-link" href="#"></a>
                <i class="fas fa-fw fa-edit"></i>
                <span>Input Nilai</span>
            </li>

            <li class="nav-item"><a class="nav-link" href="#"></a>
                <i class="fas fa-fw fa-calendar-week"></i>
                <span>Jadwal Pelajaran</span>
            </li>
            @endif

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">
                        <h5 class="mb-0 text-gray-800">
                            @if($tahunAktif)
                            Tahun Pelajaran {{ $tahunAktif->tahun_pelajaran }} ({{ $tahunAktif->semester }})
                            @else
                            Tidak ada Tahun Pelajaran Aktif
                            @endif
                        </h5>
                    </div>

                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin [cite: 3, 25]</span>
                                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
                            </a>
                            <div class="dropdown-menu ..." aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user ..."></i>
                                    Profile
                                </a>
                            <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">@yield('page-title')</h1>

                    @yield('content')
                </div>
                </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SIAKAD SMA {{ date('Y') }}</span>
                    </div>
                </div>
            </footer>
            </div>
        </div>
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    @stack('scripts')
</body>
</html>

