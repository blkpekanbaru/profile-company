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

    @php
        $mediaUrl = ($guide && $guide->image) ? $guide->image_url : asset('assets/img/alur-daftar.jpg');
        $isVideo = $guide && $guide->image && preg_match('/\.(mp4|webm)$/i', $guide->image);
    @endphp

    <section class="section">
        <div class="container" data-aos="fade-up">
            <div class="row gy-5 gx-lg-4 align-items-stretch justify-content-center">

                <div class="{{ $isVideo ? 'col-lg-4' : 'col-lg-5' }} d-flex flex-column align-items-center align-items-lg-end" data-aos="fade-right">
                    <div class="guide-col-header mb-3 text-center text-lg-start w-100" style="{{ $isVideo ? 'max-width: 320px;' : '' }}">
                        <h3 class="fw-bold h4 mb-1" style="color: #00154c;">
                            {{ $isVideo ? 'Video Alur Pendaftaran' : 'Poster Alur Pendaftaran' }}
                        </h3>
                        <p class="text-secondary small mb-0">
                            {{ $isVideo ? 'Simak panduan visual pendaftaran melalui SIAPkerja.' : 'Klik gambar untuk memperbesar informasi alur SIAPkerja.' }}
                        </p>
                    </div>

                    <div class="poster-container shadow-lg p-2 bg-white rounded-4 border-top border-5 w-100"
                        style="border-color: #00154c !important; {{ $isVideo ? 'max-width: 320px;' : '' }}">
                        @if ($isVideo)
                            <div class="video-guide-frame rounded-3 overflow-hidden bg-dark">
                                <video src="{{ $mediaUrl }}"
                                    class="w-100 h-100 d-block"
                                    autoplay
                                    muted
                                    loop
                                    playsinline
                                    controls>
                                </video>
                            </div>
                        @else
                            <a href="{{ $mediaUrl }}" class="glightbox">
                                <img src="{{ $mediaUrl }}" class="img-fluid rounded-3 w-100"
                                    alt="Poster Tata Cara Daftar">
                            </a>
                        @endif
                    </div>
                </div>

                <div class="col-lg-7 d-flex flex-column" data-aos="fade-left">
                    <div class="guide-col-header mb-3 text-center text-lg-start">
                        <h3 class="fw-bold h4 mb-1" style="color: #00154c;">Tahapan Pendaftaran</h3>
                        <p class="text-secondary small mb-0">Ikuti langkah-langkah berikut secara berurutan untuk mendaftar pelatihan.</p>
                    </div>

                    <div class="steps-card-wrapper p-4 rounded-4 bg-white border shadow-sm d-flex flex-column flex-grow-1">
                        <div class="registration-steps mb-4">
                            @if (!empty($steps))
                                @foreach ($steps as $index => $step)
                                    <div class="step-item d-flex gap-3 {{ !$loop->last ? 'mb-4' : '' }}">
                                        <div class="step-num shadow-sm">{{ $index + 1 }}</div>
                                        <div class="pt-1">
                                            <h5 class="fw-bold mb-1 h6" style="color: #00154c;">{{ $step->title }}</h5>
                                            <p class="small text-muted mb-0">{{ $step->description }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="step-item d-flex gap-3 mb-4">
                                    <div class="step-num shadow-sm">1</div>
                                    <div class="pt-1">
                                        <h5 class="fw-bold mb-1 h6" style="color: #00154c;">Registrasi Akun</h5>
                                        <p class="small text-muted mb-0">Buka portal <strong>siapkerja.kemnaker.go.id</strong> dan
                                            buat akun menggunakan NIK KTP Anda.</p>
                                    </div>
                                </div>

                                <div class="step-item d-flex gap-3 mb-4">
                                    <div class="step-num shadow-sm">2</div>
                                    <div class="pt-1">
                                        <h5 class="fw-bold mb-1 h6" style="color: #00154c;">Lengkapi Profil</h5>
                                        <p class="small text-muted mb-0">Unggah foto profil, ijazah terakhir, dan isi riwayat
                                            pendidikan/pengalaman kerja.</p>
                                    </div>
                                </div>

                                <div class="step-item d-flex gap-3">
                                    <div class="step-num shadow-sm">3</div>
                                    <div class="pt-1">
                                        <h5 class="fw-bold mb-1 h6" style="color: #00154c;">Cari Pelatihan</h5>
                                        <p class="small text-muted mb-0">Cari "Satpel PVP Pekanbaru" pada kolom pencarian lembaga di
                                            menu Pelatihan.</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="mt-auto">
                            <div class="info-card p-3 px-4 rounded-4 border-0 mb-3" style="background: #f0f4ff;">
                                <h6 class="fw-bold text-primary mb-2"><i class="bi bi-info-circle-fill me-2"></i>Informasi Penting</h6>
                                <ul class="list-unstyled mb-0">
                                    <li class="d-flex align-items-start mb-1">
                                        <i class="bi bi-check-lg text-primary me-2"></i>
                                        <span class="small">Seluruh proses pelatihan di Satpel PVP Pekanbaru <strong>GRATIS</strong>.</span>
                                    </li>
                                    <li class="d-flex align-items-start">
                                        <i class="bi bi-check-lg text-primary me-2"></i>
                                        <span class="small">Seleksi dilakukan secara transparan melalui sistem SIAPkerja.</span>
                                    </li>
                                </ul>
                            </div>

                            <a href="https://siapkerja.kemnaker.go.id" target="_blank"
                                class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm"
                                style="background: #00154c; border: none;">
                                Daftar Sekarang di SIAPkerja <i class="bi bi-arrow-right ms-2"></i>
                            </a>
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

        .step-num {
            width: 42px;
            height: 42px;
            background: #00154c;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            flex-shrink: 0;
            font-size: 1.05rem;
        }

        .step-item {
            position: relative;
        }

        .step-item:not(:last-child)::after {
            content: "";
            position: absolute;
            left: 20px;
            top: 46px;
            width: 2px;
            height: calc(100% - 34px);
            background: #e2e8f0;
        }

        .video-guide-frame {
            aspect-ratio: 9 / 16;
            width: 100%;
        }

        .video-guide-frame video {
            object-fit: cover;
        }

        .video-guide-frame video:fullscreen,
        .video-guide-frame video:-webkit-full-screen {
            object-fit: contain !important;
            background-color: #000000;
        }

        .steps-card-wrapper {
            border-color: #eef2f6 !important;
        }

        .poster-container img {
            transition: 0.4s;
        }

        .poster-container:hover img {
            transform: scale(1.01);
        }

        .info-card {
            border-left: 5px solid #00154c !important;
        }

        @media (max-width: 991px) {
            .guide-col-header,
            .poster-container {
                max-width: 360px !important;
            }
        }
    </style>
@endpush
