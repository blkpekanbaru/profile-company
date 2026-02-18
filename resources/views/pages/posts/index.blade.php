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

    <section class="section">
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
                                        <span
                                            class="badge bg-light text-primary border-primary border">{{ $cat->category->name }}</span>
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
