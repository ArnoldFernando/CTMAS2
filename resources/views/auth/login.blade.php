{{-- resources/views/auth/custom_login.blade.php --}}
@extends('adminlte::master')

@section('title', 'CSU-APARRI LIBRARY')

@section('adminlte_css')

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('IMG/csulogo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito';
        }

        .font {
            font-family: 'Poppins', sans-serif;
            font-size: 3rem;
            font-weight: 900;
            color: #FFC219;
        }

        .font-text {
            font-family: 'Poppins', sans-serif;
        }

        .text-shadow {
            text-shadow: 3px 3px 2px rgba(121, 24, 0, 0.6);
        }

        .background {
            background-image: url('{{ asset('assets/img/bg.png') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            min-height: 100vh;
            min-width: 100vw;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .background::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            /* Adjust overlay opacity */
            z-index: 1;
        }

        .background>* {
            position: relative;
            z-index: 2;
        }

        /* Animation */
        @keyframes pop {
            0% {
                transform: scale(0.5);
                opacity: 0.5;
            }

            70%,
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .popping-card {
            animation: pop 0.5s ease-out;
            width: 850px;
            background-color: #fff;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .background {

                background-color: #fff;
            }

            .popping-card {
                width: 90%;
                padding: 1.5rem;
            }

            .font {
                font-size: 2rem;
            }

            img {
                width: 80px;
                height: 80px;
            }
        }

        @media (max-width: 375px) {
            .popping-card {
                width: 100%;
                padding: 1rem;
            }

            .font {
                font-size: 1.5rem;
            }
        }
    </style>
@stop

@section('classes_body', 'login-page')

@section('body')
    <div class="background">
        <div class="shadow-lg popping-card">
            <div class="row">
                <div class="col-md-6 text-center">
                    <img src="{{ asset('IMG/csulogo.png') }}" alt="CSU Logo" class="mt-3" height="200">
                    <h3 class="font text-shadow mt-3">CSU-APARRI</h3>
                </div>
                <div class="col-md-6 mt-2">
                    <p class="text-center font-text fs-5 fw-bold">
                        Welcome to <b style="color: #FFC219; text-shadow: 1px 1px 1px rgba(121, 24, 0, 0.6);">LIBRARY</b>
                    </p>
                    <hr>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="email" name="email"
                                class="form-control border-secondary @error('email') is-invalid @enderror"
                                placeholder="Email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password"
                                class="form-control border-secondary @error('password') is-invalid @enderror"
                                placeholder="Password" required>
                            @error('password')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="icheck-primary">
                                    <input type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember" class="fw-bold">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <a href="{{ route('password.request') }}"
                                    class="text-danger text-decoration-none fs-6 fw-bold">
                                    I forgot my password
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary text-light fw-bold w-100">Login</button>
                            </div>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <a href="{{ route('register') }}" class="text-decoration-none fw-bold">Create a New Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


@section('adminlte_js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
@stop
