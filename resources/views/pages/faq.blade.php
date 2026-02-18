@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
    <div class="page-title">
        <div class="heading">
            <div class="container" data-aos="fade-up">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">Frequenty Asked Questions</h1>
                        <p class="mb-0">Temukan jawaban cepat untuk pertanyaan yang sering diajukan seputar layanan kami.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li class="current">Faq</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Faq Section -->
    <section id="faq" class="faq section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row justify-content-center">
                <div class="col-lg-9">

                    <div class="faq-wrapper">

                        @forelse ($faqs as $index => $faq)
                            {{-- Item pertama akan mendapatkan class 'faq-active' secara otomatis --}}
                            <div class="faq-item {{ $index == 0 ? 'faq-active' : '' }}" data-aos="fade-up"
                                data-aos-delay="{{ 150 + $index * 50 }}">

                                <div class="faq-header">
                                    {{-- Format nomor menjadi 01, 02, dst --}}
                                    <span class="faq-number">{{ sprintf('%02d', $index + 1) }}</span>
                                    <h4>{{ $faq->question }}</h4>
                                    <div class="faq-toggle">
                                        <i class="bi bi-plus"></i>
                                        <i class="bi bi-dash"></i>
                                    </div>
                                </div>

                                <div class="faq-content">
                                    <div class="content-inner">
                                        {{-- Gunakan nl2br jika jawaban diinput lewat textarea biasa --}}
                                        <p>{!! nl2br(e($faq->answer)) !!}</p>
                                    </div>
                                </div>
                        </div>@empty
                            <div class="text-center py-5">
                                <p class="text-muted">Belum ada pertanyaan yang tersedia saat ini.</p>
                            </div>
                        @endforelse

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
    </style>
@endpush
