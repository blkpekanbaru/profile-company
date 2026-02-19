@extends('layouts.app')

@section('title', 'Tata Cara Pendaftaran - Satpel PVP Pekanbaru')

@section('content')
    <div class="page-title">
        <div class="heading">
            <div class="container" data-aos="fade-up">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">Tata Cara Pendaftaran</h1>
                        <p class="mb-0">Pelajari alur pendaftaran pelatihan berbasis kompetensi di Satpel PVP
                            Pekanbaru.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="current">Tata Cara Daftar</li>
                </ol>
            </div>
        </nav>
    </div>

    <section class="section">
        <div class="container" data-aos="fade-up">
            <div class="row gy-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="content-header mb-4 text-center text-lg-start">
                        <h2 class="fw-bold" style="color: #00154c;">Poster Alur Pendaftaran</h2>
                        <p class="text-secondary">Klik gambar untuk memperbesar informasi alur SIAPkerja.</p>
                    </div>

                    <div class="poster-container shadow-lg p-3 bg-white rounded-4 border-top border-5"
                        style="border-color: #00154c !important;">
                        <a href="{{ asset('assets/img/alur-daftar.jpg') }}" class="glightbox">
                            <img src="{{ asset('assets/img/alur-daftar.jpg') }}" class="img-fluid rounded-3"
                                alt="Poster Tata Cara Daftar">
                        </a>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left">
                    <div class="registration-steps mb-5">
                        <h3 class="fw-bold mb-4 h4" style="color: #00154c;">Tahapan Pendaftaran:</h3>

                        <div class="step-item d-flex gap-3 mb-4">
                            <div class="step-num shadow-sm">1</div>
                            <div>
                                <h5 class="fw-bold mb-1">Registrasi Akun</h5>
                                <p class="small text-muted mb-0">Buka portal <strong>siapkerja.kemnaker.go.id</strong> dan
                                    buat akun menggunakan NIK KTP Anda.</p>
                            </div>
                        </div>

                        <div class="step-item d-flex gap-3 mb-4">
                            <div class="step-num shadow-sm">2</div>
                            <div>
                                <h5 class="fw-bold mb-1">Lengkapi Profil</h5>
                                <p class="small text-muted mb-0">Unggah foto profil, ijazah terakhir, dan isi riwayat
                                    pendidikan/pengalaman kerja.</p>
                            </div>
                        </div>

                        <div class="step-item d-flex gap-3 mb-4">
                            <div class="step-num shadow-sm">3</div>
                            <div>
                                <h5 class="fw-bold mb-1">Cari Pelatihan</h5>
                                <p class="small text-muted mb-0">Cari "Satpel PVP Pekanbaru" pada kolom pencarian lembaga di
                                    menu Pelatihan.</p>
                            </div>
                        </div>
                    </div>

                    <div class="info-card p-4 rounded-4 shadow-sm border-0" style="background: #f0f4ff;">
                        <h5 class="fw-bold text-primary mb-3"><i class="bi bi-info-circle-fill me-2"></i>Informasi Penting
                        </h5>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex align-items-start mb-2">
                                <i class="bi bi-check-lg text-primary me-2"></i>
                                <span class="small">Seluruh proses pelatihan di Satpel PVP Pekanbaru
                                    <strong>GRATIS</strong>.</span>
                            </li>
                            <li class="d-flex align-items-start">
                                <i class="bi bi-check-lg text-primary me-2"></i>
                                <span class="small">Seleksi dilakukan secara transparan melalui sistem SIAPkerja.</span>
                            </li>
                        </ul>
                    </div>

                    <div class="mt-4">
                        <a href="https://siapkerja.kemnaker.go.id" target="_blank"
                            class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm"
                            style="background: #00154c; border: none;">
                            Daftar Sekarang di SIAPkerja <i class="bi bi-arrow-right ms-2"></i>
                        </a>
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

        .step-num {
            width: 45px;
            height: 45px;
            background: #00154c;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            flex-shrink: 0;
            font-size: 1.2rem;
        }

        .step-item {
            position: relative;
        }

        .step-item:not(:last-child)::after {
            content: "";
            position: absolute;
            left: 22px;
            top: 50px;
            width: 2px;
            height: calc(100% - 40px);
            background: #e0e0e0;
        }

        .poster-container img {
            transition: 0.4s;
        }

        .poster-container:hover img {
            transform: scale(1.01);
        }

        .info-card {
            border-left: 6px solid #00154c !important;
        }
    </style>
@endpush
