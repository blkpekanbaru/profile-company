@php
    $customizerHidden = 'customizer-hide';
    $configData = \App\Helpers\Helpers::appClasses();
@endphp

@extends('admin/layouts/layoutMaster')

@section('title', 'Login Admin - BLK Pekanbaru')

@section('vendor-style')
    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/pages/page-auth.css') }}">
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            max-width: 600px;
        }

        /* Animasi Logo agar lebih "eye-catching" */
        .auth-logo-animate {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        /* Elemen dekoratif cahaya di belakang */
        .auth-shape-1 {
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            top: -100px;
            left: -100px;
            z-index: 1;
        }

        .auth-shape-2 {
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 50%;
            bottom: -50px;
            right: -50px;
            z-index: 1;
        }
    </style>
@endsection

@section('vendor-script')
    <script src="{{ asset('admin/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('admin/assets/js/pages-auth.js') }}"></script>
@endsection

@section('content')
    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg d-flex justify-content-center align-items-center w-100"
                    style="background: linear-gradient(135deg, rgba(0, 21, 76, 0.9) 0%, rgba(0, 40, 120, 0.7) 100%), url('{{ asset('assets/img/blk-pekanbaru-front.jpg') }}'); background-size: cover; background-position: center; position: relative;">

                    <div class="auth-shape-1"></div>
                    <div class="auth-shape-2"></div>

                    <div class="text-center p-5 position-relative" style="z-index: 5;">
                        <div class="glass-card p-5">
                            <img src="{{ asset('assets/img/logo-satpel.png') }}" alt="Logo"
                                class="mb-4 auth-logo-animate" style="height: 100px; filter: brightness(0) invert(1);">
                            <h2 class="text-white fw-bolder mb-3 display-6">Satuan Pelayanan PVP Pekanbaru</h2>
                            <div class="mx-auto mb-4"
                                style="width: 60px; height: 4px; background: #fff; border-radius: 10px;"></div>
                            <p class="text-white-50 fs-5 fw-light">Sistem Manajemen Informasi & Pelatihan Berbasis
                                Kompetensi</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Login -->
            <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
                <div class="w-px-400 mx-auto">
                    <!-- Logo -->
                    <div class="app-brand mb-4">
                        <a href="{{ url('/') }}" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="{{ asset('assets/img/logo-kemnaker.png') }}" alt="logo-satpel">
                            </span>
                            <span class="app-brand-text demo menu-text fw-bold" style="color: #5D596C">Satpel PKU</span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h3 class=" mb-1 fw-bold">Welcome!👋</h3>
                    <p class="mb-4">Silahkan login untuk melanjutkan pengaturan!</p>

                    <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Masukkan Email" autofocus>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me">
                                <label class="form-check-label" for="remember-me">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <button class="btn btn-primary d-grid w-100">
                            Sign in
                        </button>
                    </form>
                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>
@endsection
