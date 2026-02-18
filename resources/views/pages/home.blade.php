@extends('layouts.app')

@section('title', 'Beranda - BLK Pekanbaru')

@section('content')

    <!-- Hero Section -->
    <section id="hero" class="hero section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row align-items-center">
                <div class="col-lg-6">
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
                                <p>Alumni Pelatihan </p>
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
                            <a href="#" class="btn btn-primary">Lihat Jadwal Pelatihan</a>
                            <a href="{{ route('about') }}" class="btn btn-outline glightbox">Tentang Kami</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
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
    </section><!-- /Hero Section -->

    <!-- Tentang BLK -->
    <section id="call-to-action" class="call-to-action section light-background">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="hero-content">
                <div class="row align-items-center">

                    <div class="col-lg-6">
                        <div class="content-wrapper" data-aos="fade-up" data-aos-delay="200">
                            <h1>Tentang BLK Pekanbaru</h1>
                            <p>BLK Pekanbaru merupakan satuan pelatihan kerja yang berada di bawah koordinasi BBPVP Medan,
                                yang berfokus pada peningkatan kompetensi dan daya
                                saing tenaga kerja.</p>

                            <div class="cta-wrapper">
                                <a href="{{ route('about') }}" class="primary-cta">
                                    <span>Lihat Lebih Banyak</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                                <a href="#" class="secondary-cta">
                                    <span>Lihat Fasilitas</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="image-container" data-aos="fade-left" data-aos-delay="300">
                            <img src="{{ asset('assets/img/blk-3d.jpg') }}" alt="Bangunan BLK Pekanbaru" class="img-fluid">
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
    </section><!-- /Call To Action Section -->

    <!-- Featured Departments Section -->
    <section id="departments-tabs" class="departments-tabs section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Informasi Pelatihan di Satpel PVP Pekanbaru</h2>
            <p>Temukan berbagai pelatihan siap kerja untuk meningkatkan skill dan meraih karier impianmu!</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="medical-specialties">
                <div class="row">
                    <div class="col-12">
                        <div class="specialty-navigation">
                            <div class="nav nav-pills d-flex" id="specialty-tabs" role="tablist" data-aos="fade-up"
                                data-aos-delay="400">
                                @foreach ($departments as $dept)
                                    <a class="nav-link department-tab {{ $loop->first ? 'active' : '' }}"
                                        id="{{ $dept->slug }}-tab" data-bs-toggle="pill"
                                        href="#departments-tabs-{{ $dept->slug }}" role="tab"
                                        aria-controls="departments-tabs-{{ $dept->slug }}"
                                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        {{ $dept->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="tab-content department-content" id="specialty-content" data-aos="fade-up"
                            data-aos-delay="500">

                            @foreach ($departments as $dept)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                    id="departments-tabs-{{ $dept->slug }}" role="tabpanel"
                                    aria-labelledby="{{ $dept->slug }}-tab">

                                    <div class="row department-layout">
                                        <div class="col-lg-6 order-lg-2">
                                            <div class="department-image">
                                                <img src="{{ $dept->image_url }}" alt="{{ $dept->name }}"
                                                    class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 order-lg-1">
                                            <div class="department-info">
                                                <h2 class="department-title">Kejuruan {{ $dept->name }}</h2>
                                                <p class="department-description">
                                                    {{ $dept->description ?? 'Deskripsi belum tersedia untuk kejuruan ini.' }}
                                                </p>
                                                <div class="mt-1">
                                                    <a href="#" class="btn btn-primary px-4 py-2"
                                                        style="background-color: #00154c; border: none; border-radius: 20px;">
                                                        <i class="fas fa-search me-2"></i> Lihat Pelatihan Ini
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section><!-- /Featured Departments Section -->

    <section id="departments" class="departments section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Info & Pengumuman</h2>
            <p>Baca informasi terbaru seputar Satpel PVP Pekanbaru.</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row g-5">

                @foreach ($posts as $post)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="department-card">
                            {{-- Ikon Kategori (Ambil kategori pertama) --}}
                            <div class="department-icon">
                                <i class="fas fa-bullhorn"></i>
                            </div>

                            <div class="department-image">
                                @if ($post->images->isNotEmpty())
                                    <img src="{{ $post->images->first()->url }}" alt="{{ $post->title }}"
                                        class="img-fluid">
                                @else
                                    <img src="{{ asset('assets/img/posts/blk-3d.jpg') }}" class="img-fluid">
                                @endif
                            </div>

                            <div class="department-content">
                                {{-- Menampilkan Label Kategori --}}
                                <div class="mb-2">
                                    @foreach ($post->categories as $cat)
                                        <span class="badge bg-light text-primary border">{{ $cat->category }}</span>
                                    @endforeach
                                </div>

                                <h3>{{ Str::limit($post->title) }}</h3>

                                <p>{{ Str::limit(strip_tags($post->content), 100) }}</p>

                                <a href="#" class="learn-more">
                                    <span>Selengkapnya</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!-- /Departments Section -->
@endsection
