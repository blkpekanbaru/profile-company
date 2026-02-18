@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
    {{-- Header Halaman (Sama dengan style Profile sebelumnya) --}}
    <div class="page-title">
        <div class="heading">
            <div class="container" data-aos="fade-up">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">{{ $pageTitle }}</h1>
                        <p class="mb-0">Dapatkan informasi terpercaya dan terbaru seputar Satpel PVP Pekanbaru.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="current">{{ $pageTitle }}</li>
                </ol>
            </div>
        </nav>
    </div>

    <section id="departments" class="departments section">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                @forelse ($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="department-card h-100 shadow-sm border-0">
                            <div class="department-image">
                                <img src="{{ $post->images->isNotEmpty() ? $post->images->first()->url : asset('assets/img/posts/blk-3d.jpg') }}"
                                    alt="{{ $post->title }}" class="img-fluid">
                            </div>

                            <div class="department-content">
                                <div class="mb-2">
                                    @foreach ($post->categories as $cat)
                                        <span class="badge bg-light text-primary border border-primary me-1">
                                            {{ $cat->category->label() }}
                                        </span>
                                    @endforeach
                                    <small class="text-muted ms-2"><i class="far fa-calendar-alt"></i>
                                        {{ $post->created_at->format('d M Y') }}</small>
                                </div>

                                <h3 class="h5 fw-bold">{{ Str::limit($post->title, 60) }}</h3>
                                <p>{{ Str::limit(strip_tags($post->content), 120) }}</p>

                                <a href="{{ route('public.post.show', $post->slug) }}" class="learn-more">
                                    <span>Baca Selengkapnya</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <img src="{{ asset('assets/img/empty.svg') }}" style="width: 200px" alt="Kosong">
                        <p class="mt-3 text-muted">Belum ada artikel yang diterbitkan di kategori ini.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-5 d-flex justify-content-center">
                {{ $posts->links('pagination::bootstrap-5') }}
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
