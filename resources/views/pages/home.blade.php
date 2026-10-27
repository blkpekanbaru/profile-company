@extends('layouts.app')

@section('title', 'Beranda - Satpel PVP Pekanbaru')

@section('content')

    <section id="hero" class="hero section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-center">
                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="hero-content">
                        <h1 data-aos="fade-right" data-aos-delay="300">
                            Siap Kerja dengan <span class="highlight">Pelatihan Terbaik</span> Bersama Satpel PVP
                            Pekanbaru!
                        </h1>

                        <p class="hero-description" data-aos="fade-right" data-aos-delay="400">
                            Ikuti beragam pelatihan yang dirancang khusus untuk membekali Anda dengan keterampilan yang
                            dibutuhkan di dunia kerja. Jadilah tenaga kerja profesional dan siap bersaing!
                        </p>

                        <div class="hero-stats mb-4" data-aos="fade-right" data-aos-delay="500">
                            <div class="stat-item">
                                <h3><span data-purecounter-start="0" data-purecounter-end="1000"
                                        data-purecounter-duration="2" class="purecounter"></span>+</h3>
                                <p>Alumni Pelatihan</p>
                            </div>
                            <div class="stat-item">
                                <h3><span data-purecounter-start="0" data-purecounter-end="{{ $totalDepartments }}"
                                        data-purecounter-duration="2" class="purecounter"></span>+</h3>
                                <p>Kejuruan</p>
                            </div>
                            <div class="stat-item">
                                <h3><span data-purecounter-start="0" data-purecounter-end="{{ $totalWorkshops }}"
                                        data-purecounter-duration="2" class="purecounter"></span>+</h3>
                                <p>Program Pelatihan</p>
                            </div>
                        </div>

                        <div class="hero-actions" data-aos="fade-right" data-aos-delay="600">
                            <a href="https://paskerid.kemnaker.go.id/" target="_blank" class="btn btn-primary">Lihat Peluang Kerja</a>
                            <a href="{{ route('public.training') }}" class="btn btn-outline">Lihat Jadwal Pelatihan</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 order-1 order-lg-2">
                    <div class="hero-visual" data-aos="fade-left" data-aos-delay="400">
                        <div class="main-image">
                            <img src="{{ asset('assets/img/blk-3d.jpg') }}" alt="Bangunan Satpel PVP Pekanbaru"
                                class="img-fluid">
                        </div>
                        <div class="background-elements">
                            <div class="element element-1"></div>
                            <div class="element element-2"></div>
                            <div class="element element-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="departments" class="departments section light-background">
        <div class="container section-title news-section-header" data-aos="fade-up">
            <div class="news-title-group text-center text-md-start">
                <h2>Info & Pengumuman</h2>
                <p>Baca informasi terbaru seputar Satpel PVP Pekanbaru.</p>
            </div>
            <!-- Tombol versi Desktop (Sembunyi di HP, Muncul di PC) -->
            <a href="{{ Route::has('public.news') ? route('public.news') : url('/berita') }}" class="btn-see-all-news d-none d-md-inline-flex">
                <span>Lihat Semua Berita</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row g-4 justify-content-center">
                @forelse ($posts as $post)
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                        <div class="department-card h-100 shadow-sm border-0 d-flex flex-column w-100">
                            <div class="department-image">
                                <img src="{{ $post->images->isNotEmpty() ? $post->images->first()->url : asset('assets/img/posts/blk-3d.jpg') }}"
                                    alt="{{ $post->title }}" class="img-fluid w-100">
                            </div>

                            <div class="department-content d-flex flex-column flex-grow-1">
                                <div class="mb-2 d-flex align-items-center flex-wrap gap-1">
                                    @foreach ($post->categories as $cat)
                                        <span class="badge bg-light text-primary border border-primary">
                                            {{ $cat->category->label() }}
                                        </span>
                                    @endforeach
                                    <small class="text-muted ms-auto"><i class="far fa-calendar-alt me-1"></i>
                                        {{ $post->created_at->format('d M Y') }}</small>
                                </div>

                                <h3 class="h5 fw-bold mb-2">{{ Str::limit($post->title, 60) }}</h3>
                                <p class="mb-3">{{ Str::limit(strip_tags($post->content), 115) }}</p>

                                <a href="{{ route('public.post.show', $post->slug) }}" class="learn-more mt-auto">
                                    <span>Baca Selengkapnya</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <img src="{{ asset('assets/img/empty.svg') }}" style="width: 180px" alt="Kosong">
                        <p class="mt-3 text-muted">Belum ada artikel yang diterbitkan di kategori ini.</p>
                    </div>
                @endforelse
            </div>

            <!-- Tombol versi Mobile (Muncul di HP, Sembunyi di PC) -->
            <div class="text-center mt-5 d-md-none" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ Route::has('public.news') ? route('public.news') : url('/berita') }}" class="btn-see-all-news">
                    <span>Lihat Semua Berita</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <section id="kejuruan" class="section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Kejuruan Pelatihan</h2>
            <p>Pilih kejuruan untuk melihat daftar program pelatihan berbasis kompetensi yang tersedia.</p>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            @php
                $iconMap = [
                    'pariwisata' => 'bi-cup-hot',
                    'refrigerasi' => 'bi-snow2',
                    'pendingin' => 'bi-snow2',
                    'tik' => 'bi-laptop',
                    'bangunan' => 'bi-building-gear',
                    'otomotif' => 'bi-gear-wide-connected',
                    'php' => 'bi-basket2',
                    'perkebunan' => 'bi-basket2',
                    'listrik' => 'bi-lightning-charge',
                    'las' => 'bi-fire',
                ];
            @endphp

            <div class="row g-4 justify-content-center">
                @foreach ($departments as $dept)
                    @php
                        $slugKey = strtolower($dept->name);
                        $deptIcon = 'bi-tools';
                        foreach ($iconMap as $keyword => $iconClass) {
                            if (str_contains($slugKey, $keyword)) {
                                $deptIcon = $iconClass;
                                break;
                            }
                        }
                    @endphp
                    <div class="col-xl-3 col-lg-4 col-md-6 d-flex align-items-stretch">
                        <a href="{{ route('workshop.detail', $dept->slug) }}" class="home-kejuruan-card w-100">
                            <div class="kejuruan-card-top">
                                <div class="kejuruan-icon-box">
                                    <i class="bi {{ $deptIcon }}"></i>
                                </div>
                                <span class="kejuruan-badge">
                                    {{ $dept->total_workshops ?? 0 }} Program
                                </span>
                            </div>
                            <h3 class="kejuruan-title">Kejuruan {{ $dept->name }}</h3>
                            <p class="kejuruan-desc">
                                {{ Str::limit($dept->description ?? 'Program pelatihan berbasis kompetensi sesuai standar kebutuhan industri.', 105) }}
                            </p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="call-to-action" class="call-to-action section light-background">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="hero-content">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="content-wrapper" data-aos="fade-up" data-aos-delay="200">
                            <h2>Tentang Satpel PVP Pekanbaru</h2>
                            <p>Satpel PVP Pekanbaru merupakan satuan pelatihan kerja yang berada di bawah koordinasi BBPVP
                                Medan, yang berfokus pada peningkatan kompetensi dan daya saing tenaga kerja.</p>

                            <div class="cta-wrapper">
                                <a href="{{ route('about') }}" class="primary-cta">
                                    <span>Lihat Lebih Banyak</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                                <a href="{{ route('facilities') }}" class="secondary-cta">
                                    <span>Lihat Fasilitas</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="image-container" data-aos="fade-left" data-aos-delay="300">
                            <img src="{{ asset('assets/img/blk-3d.jpg') }}" alt="Bangunan Satpel PVP Pekanbaru"
                                class="img-fluid rounded-4">
                        </div>
                    </div>
                </div>
            </div>

            <div class="features-section">
                <div class="row g-0">
                    <div class="col-lg-4">
                        <div class="feature-block" data-aos="fade-up" data-aos-delay="200">
                            <div class="feature-icon">
                                <i class="bi bi-award"></i>
                            </div>
                            <h3>Pelatihan Berbasis Kompetensi</h3>
                            <p>Program pelatihan dirancang sesuai standar kompetensi kerja dan kebutuhan dunia industri
                                untuk meningkatkan keterampilan peserta.</p>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="feature-block" data-aos="fade-up" data-aos-delay="300">
                            <div class="feature-icon">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <h3>Pelatihan Terjadwal & Terstruktur</h3>
                            <p>Jadwal pelatihan disusun secara terencana dengan metode pembelajaran yang sistematis dan
                                berbasis praktik.</p>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="feature-block" data-aos="fade-up" data-aos-delay="400">
                            <div class="feature-icon">
                                <i class="bi bi-people"></i>
                            </div>
                            <h3>Instruktur Berpengalaman</h3>
                            <p>Didukung oleh instruktur profesional serta fasilitas pelatihan yang memadai untuk
                                menunjang proses belajar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="survei-layanan" class="section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Survei & Layanan Masyarakat</h2>
            <p>Ayo berpartisipasi untuk meningkatkan kualitas pelayanan dan penyelenggaraan pelatihan di Satpel PVP Pekanbaru.</p>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="survey-service-card w-100">
                        <div class="survey-icon-circle">
                            <i class="bi bi-emoji-smile"></i>
                        </div>
                        <h3>Survei Kepuasan Masyarakat</h3>
                        <p>Bantu kami dalam mengevaluasi dan meningkatkan mutu pelayanan publik kepada masyarakat.</p>
                        <a href="{{ url('/pelayanan/survei-kepuasan') }}" class="btn-survey-action mt-auto">
                            <span>Isi Survei</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="survey-service-card w-100">
                        <div class="survey-icon-circle">
                            <i class="bi bi-clipboard2-pulse"></i>
                        </div>
                        <h3>Pelayanan & Pengaduan Masyarakat</h3>
                        <p>Sampaikan saran, masukan, maupun pengaduan Anda terkait layanan di Satpel PVP Pekanbaru.</p>
                        <a href="{{ url('/pelayanan/pengaduan') }}" class="btn-survey-action mt-auto">
                            <span>Laporkan Masalah</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="survey-service-card w-100">
                        <div class="survey-icon-circle">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                        <h3>Survei Alumni Pelatihan</h3>
                        <p>Pendataan penelusuran alumni dan evaluasi kebermanfaatan program pelatihan di dunia kerja.</p>
                        <a href="{{ url('/pelayanan/survei-alumni') }}" class="btn-survey-action mt-auto">
                            <span>Isi Form Alumni</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')
    <style>
        /* Kartu Kejuruan */
        .home-kejuruan-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 26px 24px;
            border: 1px solid #e2e8f0;
            text-decoration: none !important;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(0, 21, 76, 0.04);
        }

        .home-kejuruan-card:hover {
            transform: translateY(-5px);
            border-color: #00154c;
            box-shadow: 0 12px 28px rgba(0, 21, 76, 0.1);
        }

        .kejuruan-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .kejuruan-icon-box {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: #f0f4ff;
            color: #00154c;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.45rem;
            transition: all 0.3s ease;
        }

        .home-kejuruan-card:hover .kejuruan-icon-box {
            background: #00154c;
            color: #ffffff;
        }

        .kejuruan-badge {
            font-size: 0.75rem;
            font-weight: 600;
            color: #00154c;
            background: #f0f4ff;
            padding: 5px 12px;
            border-radius: 50px;
        }

        .kejuruan-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #00154c;
            margin-bottom: 10px;
        }

        .kejuruan-desc {
            font-size: 0.86rem;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 0;
        }

        .call-to-action .content-wrapper h2 {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--heading-color);
            margin-bottom: 1rem;
        }

        /* Kartu Survei & Layanan Masyarakat */
        .survey-service-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 36px 28px 32px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 6px 24px rgba(0, 21, 76, 0.05);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: all 0.3s ease;
        }

        .survey-service-card:hover {
            transform: translateY(-6px);
            border-color: #00154c;
            box-shadow: 0 14px 32px rgba(0, 21, 76, 0.1);
        }

        .survey-icon-circle {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            background: #f0f4ff;
            color: #00154c;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.1rem;
            margin-bottom: 22px;
            transition: all 0.3s ease;
        }

        .survey-service-card:hover .survey-icon-circle {
            background: #00154c;
            color: #ffffff;
            transform: scale(1.05);
        }

        .survey-service-card h3 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #00154c;
            margin-bottom: 12px;
            line-height: 1.35;
        }

        .survey-service-card p {
            font-size: 0.9rem;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .btn-survey-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 26px;
            border-radius: 50px;
            background: #00154c;
            color: #ffffff !important;
            font-size: 0.86rem;
            font-weight: 600;
            text-decoration: none !important;
            transition: all 0.25s ease;
        }

        .btn-survey-action:hover {
            background: #00237a;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 21, 76, 0.2);
        }

        /* Header Section Info & Pengumuman (Konsep 1 Diperbarui) */
        .news-section-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding-bottom: 40px;
        }

        @media (min-width: 768px) {
            .news-section-header {
                flex-direction: row;
                align-items: center; /* DIUBAH: Membuat tombol sejajar vertikal di tengah */
                text-align: left !important;
            }

            .news-section-header h2::before,
            .news-section-header h2::after {
                left: 0 !important;
                right: auto !important;
                margin: 0 !important;
            }

            .news-section-header p {
                margin: 0 !important;
            }
        }

        /* Gaya Tombol Ghost Link (Tanpa Kotak Kaku, Lebih Modern) */
        .btn-see-all-news {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            color: #00154c !important;
            font-size: 0.95rem;
            font-weight: 700;
            text-decoration: none !important;
            white-space: nowrap;
            transition: all 0.3s ease;
            border-radius: 8px;
        }

        .btn-see-all-news i {
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }

        .btn-see-all-news:hover {
            background-color: rgba(0, 21, 76, 0.05); /* Efek sorot latar belakang transparan */
            color: #0033b5 !important;
            transform: translateX(4px);
        }
    </style>
@endpush
