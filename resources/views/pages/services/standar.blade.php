@extends('layouts.app')

@section('title', 'Standar Pelayanan Publik - Satpel PVP Pekanbaru')

@section('content')
    <div class="page-title">
        <div class="heading">
            <div class="container" data-aos="fade-up">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">Standar Pelayanan Publik</h1>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">Standar Pelayanan Publik</li>
                </ol>
            </div>
        </nav>
    </div>

    <section class="section">
        <div class="container" data-aos="fade-up">
            <div class="row align-items-center gy-5">
                <div class="col-lg-7">
                    <h2 class="section-title-custom">Standar Pelayanan Satpel PVP Pekanbaru</h2>
                    <p class="mt-4 text-justify">
                        Satuan Pelayanan Pelatihan Vokasi dan Produktivitas (Satpel PVP) Pekanbaru berkomitmen untuk
                        menyelenggarakan pelayanan publik yang transparan, akuntabel, dan berorientasi pada kepuasan
                        masyarakat sesuai dengan amanat undang-undang.
                    </p>

                    <div class="content-box mt-4">
                        <p class="fw-bold mb-3" style="color: var(--heading-color);">Landasan Penetapan Standar:</p>
                        <ul class="list-unstyled">
                            <li class="mb-3 d-flex align-items-start">
                                <i class="bi bi-shield-check me-3 fs-5" style="color: #00154c;"></i>
                                <span>Undang-Undang Nomor 25 Tahun 2009 tentang Pelayanan Publik</span>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="bi bi-shield-check me-3 fs-5" style="color: #00154c;"></i>
                                <span>Peraturan Pemerintah Nomor 96 Tahun 2012 tentang Pelaksanaan UU No. 25/2009</span>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="bi bi-shield-check me-3 fs-5" style="color: #00154c;"></i>
                                <span>Peraturan Menteri PAN-RB Nomor 15 Tahun 2014 tentang Pedoman Standar Pelayanan</span>
                            </li>
                        </ul>
                    </div>

                    {{-- Ganti tombol unduh menjadi tombol informasi jika file belum tersedia --}}
                    <div class="d-flex gap-3 mt-4">
                        <a href="#" class="btn-custom-donker">
                            <i class="bi bi-info-circle me-2"></i> Tanya Layanan Kami
                        </a>
                    </div>
                </div>

                <div class="col-lg-5" data-aos="zoom-in">
                    <div class="image-stack">
                        {{-- Gunakan foto pelayanan nyata atau ilustrasi kantor --}}
                        <div class="main-img-wrapper shadow-lg">
                            <img src="{{ asset('assets/img/blk-3d.jpg') }}" class="img-fluid rounded-4"
                                alt="Pelayanan Publik">
                        </div>
                        <div class="accent-box"></div>
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

        .section-title-custom {
            color: #00154c;
            /* Warna donker default Satpel */
            font-weight: 800;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title-custom::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 60px;
            height: 5px;
            background: #00154c;
            border-radius: 10px;
        }

        .btn-custom-donker {
            background-color: #00154c;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
            display: inline-block;
            border: 2px solid #00154c;
        }

        .btn-custom-donker:hover {
            background-color: transparent;
            color: #00154c;
        }

        .image-stack {
            position: relative;
            padding: 20px;
        }

        .accent-box {
            position: absolute;
            top: 0;
            right: 0;
            width: 85%;
            height: 85%;
            background: color-mix(in srgb, #00154c, transparent 90%);
            z-index: -1;
            border-radius: 30px;
        }

        .main-img-wrapper img {
            transition: transform 0.5s ease;
        }

        .main-img-wrapper:hover img {
            transform: scale(1.03);
        }
    </style>
@endpush
