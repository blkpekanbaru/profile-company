@extends('layouts.app')

@section('title', 'Kejuruan ' . $department->name . ' - Satpel PVP Pekanbaru')

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

    @php
        // Pemetaan ikon dinamis sesuai logo kejuruan di beranda
        $slugKey = strtolower($department->name . ' ' . $department->slug);
        $iconMap = [
            'pariwisata' => 'bi-cup-hot',
            'refrigerasi' => 'bi-snow2',
            'pendingin' => 'bi-snow2',
            'tik' => 'bi-laptop',
            'komputer' => 'bi-laptop',
            'bangunan' => 'bi-building-gear', 
            'otomotif' => 'bi-gear-wide-connected',
            'php' => 'bi-basket2',
            'perkebunan' => 'bi-basket2',
            'listrik' => 'bi-lightning-charge',
            'las' => 'bi-fire',
        ];

        $deptIcon = 'bi-tools';
        foreach ($iconMap as $keyword => $iconClass) {
            if (str_contains($slugKey, $keyword)) {
                $deptIcon = $iconClass;
                break;
            }
        }
    @endphp

    <section id="services" class="services section">
        <div class="container" data-aos="fade-up">
            <div class="section-title text-center mb-5">
                <h2>Program Pelatihan Tersedia</h2>
                <p>Jelajahi berbagai program pelatihan kejuruan {{ strtolower($department->name) }} untuk meningkatkan
                    kompetensi Anda.</p>
            </div>

            <div class="row gy-4 justify-content-center">
                @forelse($department->workshops as $workshop)
                    @php
                        $benefits = !empty($workshop->benefits) && is_array($workshop->benefits)
                            ? $workshop->benefits
                            : ['Biaya pelatihan GRATIS!', 'Sertifikasi BNSP'];
                        $siapKerjaUrl = !empty($workshop->registration_link)
                            ? $workshop->registration_link
                            : 'https://siapkerja.kemnaker.go.id';
                    @endphp
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="service-item workshop-card w-100 d-flex flex-column">
                            <div class="service-image position-relative overflow-hidden">
                                <img src="{{ $workshop->image_url }}" alt="{{ $workshop->name }}" class="img-fluid w-100">
                                <div class="service-overlay">
                                    <i class="bi {{ $deptIcon }}"></i>
                                </div>
                            </div>

                            <div class="service-content d-flex flex-column flex-grow-1">
                                <h3 class="workshop-title">{{ $workshop->name }}</h3>
                                <p class="workshop-desc">Program pelatihan berbasis kompetensi untuk mencetak tenaga kerja terampil di bidang
                                    {{ strtolower($department->name) }}.</p>

                                <div class="workshop-benefits-box text-start">
                                    <div class="workshop-benefits-grid">
                                        @foreach ($benefits as $benefit)
                                            <div class="benefit-badge-item">
                                                <i class="fas fa-check-circle"></i>
                                                <span>{{ $benefit }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="workshop-action-buttons mt-auto">
                                    <a href="{{ $workshop->external_link }}" target="_blank" class="btn-workshop-proglat">
                                        <span>Detail Program Pelatihan</span>
                                        <i class="fas fa-book-open"></i>
                                    </a>
                                    <a href="{{ $siapKerjaUrl }}" target="_blank" class="btn-workshop-siapkerja">
                                        <span>Daftar SIAPkerja</span>
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </div>
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

        /* Kartu Pelatihan */
        .workshop-card {
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 6px 24px rgba(0, 21, 76, 0.07);
            border: 1px solid #eef2f6;
        }

        /* Gambar & Overlay Ikon Dinamis */
        .service-image {
            height: 220px;
            background: #f1f5f9;
        }

        .service-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .service-image:hover img {
            transform: scale(1.05);
        }

        .service-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 21, 76, 0.72);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            backdrop-filter: blur(2px);
        }

        .service-overlay i {
            color: #ffffff;
            font-size: 3rem;
            transform: scale(0.7);
            transition: transform 0.3s ease;
        }

        .service-image:hover .service-overlay {
            opacity: 1;
        }

        .service-image:hover .service-overlay i {
            transform: scale(1);
        }

        /* Konten Kartu */
        .workshop-card .service-content {
            padding: 24px 20px !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: flex-start !important;
            align-items: stretch !important;
            text-align: center;
            height: 100%;
        }

        .workshop-card .workshop-title {
            font-size: 1.25rem !important;
            font-weight: 700 !important;
            color: #00154c !important;
            line-height: 1.35 !important;
            margin-bottom: 10px !important;
            min-height: 3.4rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .workshop-card .workshop-desc {
            font-size: 0.88rem !important;
            color: #64748b !important;
            line-height: 1.55 !important;
            margin-bottom: 18px !important;
            flex-grow: 0 !important;
        }

        /* Kotak Benefit */
        .workshop-benefits-box {
            background: #f8faff;
            padding: 14px 14px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            margin-bottom: 20px;
            width: 100%;
        }

        .workshop-benefits-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px 12px;
            align-content: start;
        }

        .benefit-badge-item:last-child:nth-child(odd) {
            grid-column: span 2;
        }

        .benefit-badge-item {
            display: flex;
            align-items: flex-start;
            gap: 7px;
            font-size: 0.78rem;
            line-height: 1.35;
            color: #334155;
            font-weight: 500;
        }

        .benefit-badge-item i {
            color: #00154c;
            font-size: 0.85rem;
            margin-top: 2px;
            flex-shrink: 0;
        }

        /* Tombol Aksi */
        .workshop-action-buttons {
            display: flex;
            align-items: stretch;
            gap: 8px;
            width: 100%;
            margin-top: auto !important;
            padding-top: 4px;
        }

        .btn-workshop-proglat,
        .btn-workshop-siapkerja {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 10px 10px !important;
            border-radius: 8px !important;
            font-size: 0.75rem !important;
            font-weight: 600 !important;
            text-decoration: none !important;
            transition: all 0.25s ease;
            white-space: nowrap;
            margin: 0 !important;
        }

        .btn-workshop-proglat {
            flex: 1.25;
            background-color: #ffffff !important;
            color: #00154c !important;
            border: 1.5px solid #00154c !important;
        }

        .btn-workshop-proglat:hover {
            background-color: #f0f4ff !important;
            color: #00154c !important;
            transform: translateY(-2px);
        }

        .btn-workshop-siapkerja {
            flex: 1;
            background-color: #00154c !important;
            color: #ffffff !important;
            border: 1.5px solid #00154c !important;
        }

        .btn-workshop-siapkerja:hover {
            background-color: #00237a !important;
            border-color: #00237a !important;
            color: #ffffff !important;
            transform: translateY(-2px);
        }

        /* Penyesuaian Responsif Layar */
        @media (max-width: 991px) {
            .workshop-card .workshop-title {
                min-height: auto;
            }
        }

        @media (max-width: 576px) {
            .workshop-benefits-grid {
                grid-template-columns: 1fr;
                gap: 9px;
            }

            .benefit-badge-item:last-child:nth-child(odd) {
                grid-column: span 1;
            }

            .benefit-badge-item {
                font-size: 0.84rem;
            }

            .workshop-action-buttons {
                flex-direction: column;
                gap: 10px;
            }

            .btn-workshop-proglat,
            .btn-workshop-siapkerja {
                width: 100% !important;
                flex: none !important;
                padding: 11px 14px !important;
                font-size: 0.84rem !important;
            }
        }
    </style>
@endpush
