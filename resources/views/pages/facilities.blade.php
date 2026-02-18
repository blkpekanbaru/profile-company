@extends('layouts.app')

@section('title', 'Profil - BLK Pekanbaru')

@section('content')
    <div class="page-title">
        <div class="heading">
            <div class="container" data-aos="fade-up">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">Sarana dan Prasarana</h1>
                        <p class="mb-0">Dukungan fasilitas terbaik untuk menunjang proses pelatihan vokasi yang maksimal.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="current">Sarana dan Prasarana</li>
                </ol>
            </div>
        </nav>
    </div>

    <section id="services" class="services section">
        <div class="container" data-aos="fade-up">

            <div class="row gy-4">
                @forelse($facilities as $facility)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="service-item">
                            <div class="service-image" style="height: 250px;">
                                <img src="{{ $facility->image_url }}" alt="{{ $facility->name }}" class="img-fluid">
                                <div class="service-overlay">
                                    <i class="fas fa-building"></i>
                                </div>
                            </div>
                            <div class="service-content text-center">
                                <h3 class="mb-0">{{ $facility->name }}</h3>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Kondisi jika data belum diupload --}}
                    <div class="col-12 text-center py-5" data-aos="fade-up">
                        <div class="alert alert-light shadow-sm py-5 border-0" style="border-radius: 15px;">
                            <i class="fas fa-images fa-4x mb-3 text-muted"></i>
                            <h4 class="text-muted">Sarana dan Prasarana belum diunggah</h4>
                            <p class="text-secondary">Mohon maaf, saat ini kami sedang memperbarui data fasilitas Satpel PVP
                                Pekanbaru.</p>
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

        .service-item {
            border-radius: 20px !important;
            /* Membuat sudut lengkung khas seperti di SS */
            overflow: hidden;
            border: 1px solid #f0f0f0;
        }

        .service-image {
            position: relative;
            overflow: hidden;
        }

        .service-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.5s;
        }

        .service-item:hover img {
            transform: scale(1.1);
        }

        .service-content h3 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #00154c;
            padding: 10px 10px;
        }
    </style>
@endpush
