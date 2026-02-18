@extends('layouts.app')

@section('title', 'Profil - BLK Pekanbaru')

@section('content')
    <div class="page-title">
        <div class="heading">
            <div class="container" data-aos="fade-up">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">Profil</h1>
                        <p class="mb-0">Mengenal lebih dekat Satuan Pelayanan Pelatihan Vokasi dan Produktivitas Pekanbaru.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="/">Home</a></li>
                    <li class="current">About</li>
                </ol>
            </div>
        </nav>
    </div>

    <section id="history" class="section bg-light">
        <div class="container" data-aos="fade-up">
            <div class="text-center mb-5">
                <h2 class="fw-bold">{{ $profiles['history']->title ?? 'Sejarah & Transformasi' }}</h2>
                <p>Mengenal perjalanan panjang Satpel PVP Pekanbaru dari masa ke masa.</p>
            </div>

            <div class="timeline">
                @forelse($history as $index => $item)
                    <div class="timeline-item {{ $index % 2 == 0 ? 'left' : 'right' }}"
                        data-aos="{{ $index % 2 == 0 ? 'fade-right' : 'fade-left' }}">
                        <div class="timeline-content shadow-sm">
                            <span class="timeline-year">{{ $item->year }}</span>
                            <h4>{{ $item->title }}</h4>
                            <p>{{ $item->description }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center">Data sejarah belum diinput.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="vision-mission" class="section">
        <div class="container" data-aos="fade-up">
            <div class="text-center mb-5">
                <h2 class="fw-bold">{{ $profiles['vision_mission']->title }}</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-9">

                    <div class="vm-wrapper mb-4">
                        <h5 class="mb-3 fw-bold text-primary">Visi</h5>
                        <div class="vm-card shadow-sm" data-aos="fade-up">
                            <div class="vm-number">V</div>
                            <div class="vm-content">
                                <p>{{ $visi }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="vm-wrapper">
                        <h5 class="mb-3 fw-bold text-primary">Misi</h5>
                        <div class="row g-3">
                            @foreach ($misiPoin as $index => $poin)
                                <div class="col-12" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 50 }}">
                                    <div class="vm-card shadow-sm">
                                        <div class="vm-number">{{ sprintf('%02d', $index + 1) }}</div>
                                        <div class="vm-content">
                                            <p>{{ $poin }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="values-section section light-background">
        <div class="container" data-aos="fade-up">
            <div class="row text-center mb-5">
                <div class="col-lg-12">
                    <h3 class="fw-bold">Nilai-Nilai Organisasi</h3>
                    <p>Berdasarkan Peraturan Menteri Ketenagakerjaan No. 37 Tahun 2015</p>
                </div>
            </div>
            <div class="row g-4 justify-content-center text-center">
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="value-item shadow-sm h-100">
                        <div class="value-icon"><i class="fas fa-star"></i></div>
                        <h4>Jujur</h4>
                        <p class="small">Integritas di atas Segalanya</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="value-item shadow-sm h-100">
                        <div class="value-icon"><i class="fas fa-star"></i></div>
                        <h4>Professional</h4>
                        <p class="small">Hasil Kerja Akuntabel</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="value-item shadow-sm h-100">
                        <div class="value-icon"><i class="fas fa-star"></i></div>
                        <h4>Solid</h4>
                        <p class="small">Satu untuk Semua, Semua untuk Satu</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="value-item shadow-sm h-100">
                        <div class="value-icon"><i class="fas fa-star"></i></div>
                        <h4>Kreatif</h4>
                        <p class="small">Kaya Gagasan</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="value-item shadow-sm h-100">
                        <div class="value-icon"><i class="fas fa-star"></i></div>
                        <h4>Melayani</h4>
                        <p class="small">Pemangku Kepentingan adalah Raja</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container text-center" data-aos="fade-up">
            <h3 class="fw-bold">{{ $profiles['structure']->title }}</h3>
            <div class="mt-3">{!! $profiles['structure']->content !!}</div>
            <div class="row justify-content-center mt-4">
                <div class="col-lg-10">
                    @if ($profiles['structure']->image)
                        <a href="{{ $profiles['structure']->image_url }}" class="glightbox">
                            <img src="{{ $profiles['structure']->image_url }}" class="img-fluid shadow"
                                alt="Struktur Organisasi">
                        </a>
                    @else
                        <div class="alert alert-info">Bagan struktur organisasi belum diunggah.</div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-light">
        <div class="container">
            <div class="row g-4 justify-content-center">

                <div class="col-lg-10 mb-2" data-aos="fade-up">
                    <div class="tupoksi-card-white shadow-sm p-4 p-md-5 rounded-4 bg-white">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="tupoksi-icon-blue">
                                <i class="bi bi-briefcase-fill"></i>
                            </div>
                            <h4 class="fw-bold mb-0" style="color: var(--heading-color);">
                                {{ $profiles['main_task']->title }}</h4>
                        </div>
                        <div class="tupoksi-text-dark">
                            {!! strip_tags($profiles['main_task']->content) !!}
                        </div>
                    </div>
                </div>

                <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">
                    <div class="functions-wrapper bg-white shadow-sm p-4 p-md-5 rounded-4">
                        <div class="text-center mb-4">
                            <h4 class="fw-bold">{{ $profiles['functions']->title }}</h4>
                            <div class="header-line mx-auto"></div>
                        </div>
                        <div class="row g-2"> @php
                            $dom = new DOMDocument();
                            @$dom->loadHTML($profiles['functions']->content);
                            $items = $dom->getElementsByTagName('li');
                        @endphp

                            @foreach ($items as $index => $item)
                                <div class="col-md-6">
                                    <div class="function-item-compact">
                                        <span class="function-check">
                                            <i class="bi bi-check-circle-fill"></i>
                                        </span>
                                        <p>{{ $item->nodeValue }}</p>
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

        .timeline {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 0;
        }

        .timeline::after {
            content: '';
            position: absolute;
            width: 4px;
            background-color: var(--heading-color);
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -2px;
            border-radius: 10px;
            opacity: 0.2;
        }

        .timeline-item {
            padding: 10px 40px;
            position: relative;
            background-color: inherit;
            width: 50%;
        }

        .timeline-item::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            right: -10px;
            background-color: var(--background-color);
            border: 4px solid var(--accent-color);
            top: 20px;
            border-radius: 50%;
            z-index: 1;
        }

        .left {
            left: 0;
        }

        .right {
            left: 50%;
        }

        .right::after {
            left: -10px;
        }

        .timeline-content {
            padding: 25px;
            background-color: var(--surface-color);
            position: relative;
            border-radius: 15px;
            transition: 0.3s;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .timeline-content:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
        }

        .timeline-year {
            font-family: var(--heading-font);
            font-weight: 700;
            color: var(--accent-color);
            font-size: 0.9rem;
            margin-bottom: 8px;
            display: block;
        }

        .timeline-content h4 {
            margin-top: 0;
            font-size: 1.25rem;
            font-weight: 700;
        }

        .timeline-content p {
            margin-bottom: 0;
            color: var(--default-color);
            line-height: 1.6;
            text-align: justify;
        }

        @media screen and (max-width: 768px) {
            .timeline::after {
                left: 31px;
            }

            .timeline-item {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }

            .timeline-item::after {
                left: 21px;
            }

            .right {
                left: 0%;
            }

            .timeline-content p {
                text-align: left;
            }
        }

        .vm-card {
            background: var(--surface-color);
            padding: 15px 25px;
            /* Padding dikecilkan sesuai ss */
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 20px;
            position: relative;
            overflow: hidden;
            transition: 0.3s;
            border-left: 5px solid var(--accent-color);
            /* Border sedikit lebih tipis */
        }

        .vm-card:hover {
            transform: translateX(8px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08) !important;
        }

        /* Nomor Transparan lebih proporsional */
        .vm-number {
            font-size: 1.8rem;
            /* Ukuran angka dikecilkan agar tidak mendominasi */
            font-weight: 800;
            color: color-mix(in srgb, var(--accent-color), transparent 85%);
            font-family: var(--heading-font);
            line-height: 1;
            min-width: 45px;
            text-align: center;
        }

        /* Text Content lebih rapat */
        .vm-content p {
            margin: 0;
            font-size: 1rem;
            /* Ukuran font standar poppins */
            font-weight: 500;
            color: var(--default-color);
            line-height: 1.5;
        }

        /* Judul Kecil (Visi/Misi) */
        h5.text-primary {
            color: var(--heading-color) !important;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }

        /* Responsive Mobile */
        @media (max-width: 576px) {
            .vm-card {
                padding: 12px 18px;
                gap: 15px;
            }

            .vm-number {
                font-size: 1.5rem;
                min-width: 35px;
            }
        }

        .value-item {
            background: var(--surface-color);
            padding: 40px 20px;
            border-radius: 20px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-align: center;
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        .value-item::before {
            content: "";
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 4px;
            background: var(--accent-color);
            transition: 0.3s;
        }

        .value-item:hover::before {
            width: 100%;
        }

        .value-item:hover {
            transform: translateY(-12px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
        }

        .value-icon {
            width: 70px;
            height: 70px;
            background: color-mix(in srgb, var(--accent-color), transparent 92%);
            color: var(--accent-color);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 20px auto;
            font-size: 28px;
            transition: 0.3s;
        }

        .value-item:hover .value-icon {
            background: var(--accent-color);
            color: #fff;
        }

        .value-item h4 {
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }

        .value-item .small {
            color: #666;
            font-style: italic;
        }

        .tupoksi-card-white {
            border-top: 5px solid var(--accent-color);
            position: relative;
        }

        .tupoksi-icon-blue {
            font-size: 2rem;
            color: var(--accent-color);
            line-height: 1;
        }

        .tupoksi-text-dark {
            font-size: 1.05rem;
            line-height: 1.6;
            color: var(--default-color);
            text-align: justify;
        }

        /* Styling Fungsi Utama - Versi Rapat */
        .functions-wrapper {
            border-top: 5px solid var(--accent-color);
        }

        .function-item-compact {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 6px 10px;
            /* Padding dikecilkan agar lebih rapat */
            transition: 0.2s;
        }

        .function-item-compact:hover {
            background: var(--light-background);
            border-radius: 8px;
        }

        .function-check {
            color: var(--accent-color);
            font-size: 1.1rem;
            flex-shrink: 0;
            /* Mencegah ikon mengecil */
        }

        .function-item-compact p {
            margin: 0;
            font-size: 0.95rem;
            color: var(--default-color);
            line-height: 1.4;
            text-align: justify;
            /* Line height dirapatkan */
        }

        .header-line {
            width: 50px;
            height: 3px;
            background: var(--accent-color);
            margin-top: 8px;
            border-radius: 10px;
        }
    </style>
@endpush
