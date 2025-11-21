<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SIAKAD GURU</title>

    {{-- Bootstrap / CSS --}}
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">

    <div id="wrapper">

        {{-- Sidebar Guru --}}
        <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <div class="sidebar-brand d-flex align-items-center justify-content-center mt-3 mb-4">
                <div class="sidebar-brand-text mx-3">SIAKAD</div>
            </div>



            <li class="nav-item">
                <a class="nav-link" href="{{ route('guru.siswa.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Data Siswa</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('guru.nilai.index') }}">
                    <i class="fas fa-edit"></i>
                    <span>Input Nilai</span>
                </a>
            </li>

        </ul>
        {{-- END SIDEBAR --}}

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content" class="p-4">
                <h4 class="mb-4">@yield('page-title')</h4>
                @yield('content')
            </div>

        </div>

    </div>
</body>
</html>
