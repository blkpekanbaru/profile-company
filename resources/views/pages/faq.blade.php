@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">Frequenty Asked Questions</h1>
                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec
                            ullamcorper mattis, pulvinar dapibus leo.</p>
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
