@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <section class="section mt-5">
        <div class="container" data-aos="fade-up">
            <div class="row g-5">
                {{-- Konten Utama --}}
                <div class="col-lg-8">
                    <article class="blog-details">
                        <div class="post-img mb-4 rounded-4 overflow-hidden shadow">
                            <img src="{{ $post->images->isNotEmpty() ? $post->images->first()->url : asset('assets/img/posts/blk-3d.jpg') }}"
                                alt="" class="img-fluid w-100">
                        </div>

                        <h1 class="title fw-bold text-primary mb-3">{{ $post->title }}</h1>

                        <div class="meta-top mb-4 p-3 bg-light rounded-3">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item me-3"><i class="bi bi-person"></i> <small>Admin</small></li>
                                <li class="list-inline-item me-3"><i class="bi bi-calendar"></i>
                                    <small>{{ $post->created_at->format('d F Y') }}</small></li>
                                <li class="list-inline-item"><i class="bi bi-tags"></i>
                                    @foreach ($post->categories as $cat)
                                        <span class="badge bg-white text-primary border">{{ $cat->category->name }}</span>
                                    @endforeach
                                </li>
                            </ul>
                        </div>

                        <div class="content mt-4" style="line-height: 1.8; font-size: 1.1rem; text-align: justify">
                            {!! $post->content !!}
                        </div>
                    </article>

                    {{-- Jika ada Galeri Gambar Tambahan --}}
                    @if ($post->images->count() > 1)
                        <div class="mt-5">
                            <h4 class="fw-bold mb-3">Galeri Foto</h4>
                            <div class="row g-2">
                                @foreach ($post->images as $img)
                                    <div class="col-md-4">
                                        <a href="{{ $img->url }}" class="glightbox">
                                            <img src="{{ $img->url }}" class="img-fluid rounded border shadow-sm">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4">
                    <div class="sidebar p-4 bg-light rounded-4 shadow-sm">
                        <h5 class="fw-bold mb-4 border-bottom pb-2">Berita Terbaru Lainnya</h5>
                        @foreach ($relatedPosts as $rel)
                            <div class="post-item mb-4 d-flex">
                                <img src="{{ $rel->images->isNotEmpty() ? $rel->images->first()->url : asset('assets/img/posts/blk-3d.jpg') }}"
                                    class="rounded me-3" style="width: 80px; height: 60px; object-fit: cover;">
                                <div>
                                    <h6 class="mb-1 fw-bold" style="font-size: 0.9rem">
                                        <a
                                            href="{{ route('public.post.show', $rel->slug) }}">{{ Str::limit($rel->title, 50) }}</a>
                                    </h6>
                                    <small class="text-muted">{{ $rel->created_at->format('d M Y') }}</small>
                                </div>
                            </div>
                        @endforeach

                        <div class="mt-4 pt-4 border-top">
                            <a href="{{ route('public.news') }}" class="btn btn-primary w-100 rounded-pill">Lihat Semua
                                Berita</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
