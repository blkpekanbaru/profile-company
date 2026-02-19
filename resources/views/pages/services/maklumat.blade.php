@extends('layouts.app')

@section('title', 'Maklumat Pelayanan - Satpel PVP Pekanbaru')

@section('content')
    <div class="page-title">
        <div class="heading">
            <div class="container" data-aos="fade-up">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">Maklumat Pelayanan</h1>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li class="current">Maklumat Pelayanan</li>
                </ol>
            </div>
        </nav>
    </div>

    <section class="section">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card maklumat-card border-0 shadow-lg p-4 p-md-5 text-center">

                        <div class="card-decoration"></div>
                        <div class="mb-4">
                            <img src="{{ asset('assets/img/logo-satpel.png') }}" alt="Logo"
                                style="height: 70px; width: auto;">
                        </div>

                        <h2 class="maklumat-title mb-5">MAKLUMAT PELAYANAN</h2>

                        <div class="maklumat-body px-md-5 position-relative">
                            <i class="bi bi-quote quote-icon-left"></i>

                            <p class="maklumat-quote mb-5">
                                "Dengan ini, Kami menyatakan sanggup menyelenggarakan pelayanan sesuai standar pelayanan
                                yang telah ditetapkan dan apabila tidak menepati janji ini, kami siap menerima sanksi
                                sesuai peraturan perundang-undangan yang berlaku".
                            </p>

                            <i class="bi bi-quote quote-icon-right"></i>

                            <div class="maklumat-footer mt-5">
                                <div class="header-line mx-auto mb-4"></div>
                                <p class="mb-1 text-muted">Pekanbaru, 2026</p>
                                <h5 class="fw-bold mb-0" style="color: #00154c;">Koordinator Satpel PVP Pekanbaru</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-lg-10" data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="commitment-wrapper p-4 p-md-5 bg-white shadow-sm rounded-4 border-5">
                        <h4 class="fw-bold mb-4" style="color: #00154c;">
                            Komitmen Pelayanan Informasi Publik
                        </h4>
                        <p class="text-muted mb-4">
                            Satuan Pelayanan Pelatihan Vokasi dan Produktivitas (Satpel PVP) Pekanbaru berkomitmen dalam
                            menyelenggarakan Pelayanan Informasi Publik sesuai dengan amanat perundang-undangan dengan
                            tekad:
                        </p>

                        <div class="row g-3">
                            @php
                                $commitments = [
                                    'Melayani permohonan informasi publik dengan tanggap dan tepat waktu',
                                    'Menyediakan informasi publik yang benar, terpercaya, dan dapat dipertanggungjawabkan',
                                    'Memberikan kemudahan akses informasi publik melalui berbagai fasilitas dan media',
                                    'Menyiapkan dan mengumumkan Daftar Informasi Publik',
                                    'Memberikan pelayanan terbaik oleh petugas informasi publik',
                                    'Menyiapkan sistem informasi yang ramah bagi pengguna dan senantiasa diperbarui',
                                    'Mengevaluasi kinerja petugas pelaksana secara rutin demi pelayanan informasi yang maksimal',
                                ];
                            @endphp

                            @foreach ($commitments as $item)
                                <div class="col-md-6">
                                    <div class="commitment-item d-flex align-items-start gap-3 p-2">
                                        <div class="commitment-icon">
                                            <i class="bi bi-check-circle-foundation"></i>
                                        </div>
                                        <p class="mb-0 text-dark fw-medium">{{ $item }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .page-title {
            background: linear-gradient(135deg, var(--surface-color) 0%, color-mix(in srgb, var(--accent-color), transparent 95%) 100%) !important;
            overflow: hidden;
        }

        .page-title::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("/assets/img/bg/abstract-bg-3.webp") center/cover;
            opacity: 0.08;
            z-index: 0;
        }

        .page-title .heading,
        .page-title nav {
            position: relative;
            z-index: 1;
        }

        .page-title .heading h1 {
            font-weight: 700 !important;
            color: var(--heading-color);
        }

        .maklumat-card {
            border-radius: 30px;
            position: relative;
            overflow: hidden;
            /* Aksen border atas seperti desain Fungsi Utama */
            border-top: 8px solid #00154c !important;
        }

        /* Watermark logo di background */
        .maklumat-card::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            height: 400px;
            background: url("{{ asset('assets/img/logo-satpel.png') }}") no-repeat center;
            background-size: contain;
            opacity: 0.03;
            z-index: 0;
        }

        .maklumat-title {
            color: #00154c;
            font-weight: 800;
            letter-spacing: 2px;
            position: relative;
            display: inline-block;
        }

        .maklumat-quote {
            font-family: 'Poppins', sans-serif;
            font-style: italic;
            font-size: 1.6rem;
            color: #333;
            line-height: 1.6;
            font-weight: 500;
            z-index: 1;
            position: relative;
        }

        /* Dekorasi Quote */
        .quote-icon-left,
        .quote-icon-right {
            font-size: 4rem;
            color: rgba(0, 21, 76, 0.1);
            position: absolute;
        }

        .quote-icon-left {
            top: -30px;
            left: 0;
        }

        .quote-icon-right {
            bottom: -10px;
            right: 0;
        }

        .header-line {
            width: 80px;
            height: 4px;
            background: #00154c;
            border-radius: 2px;
        }

        .commitment-wrapper {
            position: relative;
            overflow: hidden;
        }

        .commitment-item {
            transition: all 0.3s ease;
        }

        .commitment-item:hover {
            background-color: color-mix(in srgb, var(--accent-color), transparent 95%);
            border-radius: 10px;
            transform: translateX(5px);
        }

        .commitment-icon {
            width: 24px;
            height: 24px;
            background-color: #00154c;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 0.8rem;
        }

        .bi-check-circle-foundation::before {
            content: "\f26b";
            font-family: "bootstrap-icons";
            font-weight: 900;
        }

        .commitment-item p {
            font-size: 0.95rem;
            line-height: 1.5;
        }
    </style>
@endpush
