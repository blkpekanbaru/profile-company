@extends('layouts.app')

@section('title', 'Kejuruan ' . $department->name . ' - BLK Pekanbaru')

@section('content')
    <div class="page-title">
        <div class="heading">
            <div class="container" data-aos="fade-up">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">Kejuruan {{ $department->name }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="current">Detail Kejuruan</li>
                </ol>
            </div>
        </nav>
    </div>

    <section id="services" class="services section">
        <div class="container" data-aos="fade-up">
            <div class="section-title text-center mb-5">
                <h2>Program Pelatihan Tersedia</h2>
                <p>Jelajahi berbagai program pelatihan kejuruan {{ strtolower($department->name) }} untuk meningkatkan
                    kompetensi Anda.</p>
            </div>

            <div class="row gy-4">
                @forelse($department->workshops as $workshop)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="service-item">
                            <div class="service-image">
                                {{-- Menggunakan Accessor image_url dari Model --}}
                                <img src="{{ $workshop->image_url }}" alt="{{ $workshop->name }}" class="img-fluid">
                                <div class="service-overlay">
                                    <i class="fas fa-tools"></i>
                                </div>
                            </div>
                            <div class="service-content text-center">
                                <h3>{{ $workshop->name }}</h3>
                                <p>Program pelatihan berbasis kompetensi untuk mencetak tenaga kerja terampil di bidang
                                    {{ strtolower($department->name) }}.</p>

                                <div class="service-features mb-3">
                                    <span class="feature-item"><i class="fas fa-check"></i> Sertifikat BNSP/Kemnaker</span>
                                    <span class="feature-item"><i class="fas fa-check"></i> Pelatihan Gratis</span>
                                </div>

                                <a href="{{ $workshop->external_link }}" target="_blank" class="service-btn">
                                    <span>Pelajari Lebih Lanjut</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <div class="alert alert-info py-5">
                            <i class="fas fa-info-circle fa-3x mb-3"></i>
                            <p class="mb-0">Mohon maaf, saat ini belum ada program pelatihan aktif untuk kejuruan ini.</p>
                        </div>
                    </div>
                @endforelse
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
    </style>
@endpush
