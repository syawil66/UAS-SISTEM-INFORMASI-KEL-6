<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistem Informasi Akademik SMA">
    <meta name="author" content="">

    <title>@yield('title', 'SIAKAD SMA')</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-school"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SIAKAD</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Menu Utama
            </div>

            @if(Auth::check() && Auth::user()->role == 'admin')

                <li class="nav-item {{ request()->routeIs('profilSekolah.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('profilSekolah.index') }}">
                        <i class="fas fa-fw fa-school"></i>
                        <span>Profil Sekolah</span></a>
                </li>

                <li class="nav-item {{ request()->routeIs('tahunPelajaran') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('tahunPelajaran') }}">
                        <i class="fas fa-fw fa-calendar-alt"></i>
                        <span>Tahun Pelajaran</span></a>
                </li>

                <li class="nav-item {{ request()->routeIs('akademik.*') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAkademik"
                        aria-expanded="true" aria-controls="collapseAkademik">
                        <i class="fas fa-fw fa-book"></i>
                        <span>Data Akademik</span>
                    </a>
                    <div id="collapseAkademik" class="collapse {{ request()->routeIs('akademik.*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Komponen Akademik:</h6>
                            <a class="collapse-item {{ request()->routeIs('akademik.matapelajaran.*') ? 'active' : '' }}" href="{{ route('akademik.matapelajaran.index') }}">Mata Pelajaran</a>
                            <a class="collapse-item {{ request()->routeIs('akademik.kelas.*') ? 'active' : '' }}" href="{{ route('akademik.kelas.index') }}">Data Kelas</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item {{ request()->routeIs('guru.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('guru.index') }}">
                        <i class="fas fa-fw fa-chalkboard-teacher"></i>
                        <span>Data Guru</span></a>
                </li>

                <li class="nav-item {{ request()->routeIs('siswa.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('siswa.index') }}">
                        <i class="fas fa-fw fa-user-graduate"></i>
                        <span>Data Siswa</span></a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.nilai') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('rekapNilai') }}">
                        <i class="fas fa-fw fa-file-alt"></i>
                        <span>Rekap Nilai</span></a>
                </li>

            @elseif(Auth::check() && Auth::user()->role == 'guru')

                <li class="nav-item {{ request()->routeIs('guru.siswa.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('guru.siswa.index') }}">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Data Siswa Ajar</span></a>
                </li>

                <li class="nav-item {{ request()->routeIs('guru.jadwal.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('guru.jadwal.index') }}">
                        <i class="fas fa-fw fa-calendar-week"></i>
                        <span>Jadwal Pelajaran</span></a>
                </li>

                <li class="nav-item {{ request()->routeIs('guru.nilai.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('guru.nilai.index') }}">
                        <i class="fas fa-fw fa-edit"></i>
                        <span>Input Nilai</span></a>
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

                    @php
                        $ta_aktif = \App\Models\TahunPelajaran::where('status', 'Aktif')->first();
                    @endphp

                    <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">
                        @if($ta_aktif)
                            <span class="badge badge-success px-3 py-2 shadow-sm" style="font-size: 0.9rem;">
                                <i class="fas fa-calendar-check mr-2"></i>
                                Tahun Ajaran: {{ $ta_aktif->tahun_pelajaran }} ({{ $ta_aktif->semester }})
                            </span>
                        @else
                            <span class="badge badge-danger px-3 py-2 shadow-sm">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Tahun Ajaran Belum Diatur
                            </span>
                        @endif
                    </div>
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ Auth::user()->name ?? 'User' }}
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="{{ Auth::user()->foto ? asset('storage/'.Auth::user()->foto) : asset('img/undraw_profile.svg') }}">
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="{{ route('profile.index') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile Saya
                                </a>

                                <div class="dropdown-divider"></div>

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">@yield('page-title')</h1>
                        @yield('action-button')
                    </div>

                    @yield('content')

                </div>
                </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SIAKAD SMA 2025</span>
                    </div>
                </div>
            </footer>
            </div>
        </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    @stack('scripts')

</body>

</html>
