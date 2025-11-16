<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - SIAKAD SMA</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text-css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body.login-background {
            background-image: url("{{ asset('img/background_login.jpg') }}");
            background-position: center;
            background-size: cover;
            position: relative;
        }

        body.login-background::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(38, 80, 204, 0.4);
            z-index: 1;
        }

        .login-container {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 1rem;
        }

        .login-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #ffffff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .login-logo {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 100px;
            margin-bottom: 1rem;
        }

        .form-control-login {
            border-radius: 10rem;
            padding: 1.5rem 1rem;
        }

        .btn-login-green {
            background-color: #28a745;
            border-color: #28a745;
            font-size: 1rem;
            border-radius: 10rem;
            padding: 0.75rem 1rem;
        }
        .btn-login-green:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .forgot-password {
            text-align: right;
            display: block;
            font-size: 0.8rem;
            margin-top: -10px;
            margin-bottom: 15px;
            margin-right: 10px;
        }
    </style>
</head>

<body class="login-background">

    <div class="login-container">

        <h1 class="login-title">Selamat Datang Kembali di SIAKAD</h1>

        <img src="{{ asset('img/logo_sekolah.png') }}" alt="Logo Sekolah" class="login-logo">

        <div class="login-box">

            <div class="text-center">
                <h2 class="h4 text-gray-900 mb-4">Login</h2>
            </div>

            @if($errors->any())
                <div class="alert alert-danger text-sm p-2" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <form class="user" action="{{ route('login.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-login"
                        placeholder="Nama/NIS (Email Anda)" required value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-login"
                        placeholder="Password" required>
                </div>

                <a href="#" class="forgot-password">Lupa password? Ganti</a>

                <button type="submit" class="btn btn-primary btn-user btn-block btn-login-green">
                    Login
                </button>
            </form>
            </div>
        </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>
</html>
