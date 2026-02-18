@extends('layouts.app')

@section('title', 'Tata Cara Pendaftaran - Satpel PVP Pekanbaru')

@section('content')
    <div class="page-title">
        <div class="heading">
            <div class="container">
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
            <div class="row gy-5 align-items-center">

                <div class="col-lg-7" data-aos="fade-right">
                    <div class="content-header mb-4">
                        <h2 class="fw-bold" style="color: #00154c;">Alur Pendaftaran Pelatihan</h2>
                        <p class="text-secondary">Simak poster di bawah ini untuk memahami tahapan pendaftaran melalui
                            portal SIAPkerja.</p>
                    </div>

                    <div class="poster-wrapper shadow-lg p-2 bg-white rounded-4">
                        {{-- Ganti 'alur-daftar.jpg' dengan nama file poster aslimu di folder public/assets/img/ --}}
                        <a href="{{ asset('assets/img/alur-daftar.jpg') }}" class="glightbox">
                            <img src="{{ asset('assets/img/struktur-organisasi.jpg') }}" class="img-fluid rounded-3"
                                alt="Poster Tata Cara Daftar">
                        </a>
                    </div>
                </div>

                <div class="col-lg-5" data-aos="fade-left">
                    <div class="info-box p-4 rounded-4 shadow-sm bg-white border-start border-primary border-5">
                        <h4 class="fw-bold"><i class="bi bi-info-circle me-2"></i>Informasi Penting</h4>
                        <ul class="list-unstyled mt-3">
                            <li class="mb-3"><i class="bi bi-check2-circle text-primary me-2"></i> Pendaftaran hanya
                                dilakukan melalui portal <strong>siapkerja.kemnaker.go.id</strong>.</li>
                            <li class="mb-3"><i class="bi bi-check2-circle text-primary me-2"></i> Pastikan profil
                                SIAPkerja Anda sudah lengkap (KTP, Ijazah, Foto).</li>
                            <li class="mb-3"><i class="bi bi-check2-circle text-primary me-2"></i> Seluruh proses
                                pelatihan ini <strong>GRATIS</strong> (Tidak dipungut biaya).</li>
                        </ul>
                    </div>

                    <div class="mt-4 text-center">
                        {{-- Gambar Dekoratif --}}
                        <img src="{{ asset('assets/img/kejuruan/pariwisata.jpg') }}" class="img-fluid rounded-5 shadow-sm"
                            alt="Staff">
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .poster-wrapper img {
            transition: 0.3s;
            cursor: zoom-in;
        }

        .poster-wrapper:hover img {
            opacity: 0.9;
        }

        .info-box {
            background-color: #f8faff;
        }
    </style>
@endpush
