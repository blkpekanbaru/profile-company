@extends('admin.layouts.layoutMaster')

@section('title', $post->title)

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/animate-css/animate.css') }}">
@endsection

@section('page-style')
    <style>
        /* Membuat grid gambar dengan rasio 1:1 (kotak) */
        .image-grid-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            aspect-ratio: 1 / 1;
            /* Menjaga gambar tetap kotak */
        }

        .image-grid-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Gambar akan terpotong rapi di tengah */
            transition: transform 0.4s ease;
            cursor: pointer;
        }

        /* Efek Zoom saat mouse lewat */
        .image-grid-item:hover img {
            transform: scale(1.1);
        }

        /* Overlay halus saat dihover */
        .image-grid-item::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.1);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .image-grid-item:hover::after {
            opacity: 1;
        }
    </style>

@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item"><a href="{{ route('admin.information.index') }}">Informasi</a></li>
                    <li class="breadcrumb-item active">
                        {{ $post->categories->first() && $post->categories->first()->category ? $post->categories->first()->category->label() : 'Informasi' }}
                    </li>
                </ol>
            </nav>

            <div class="card overflow-hidden">
                @if ($post->image)
                    <img class="img-fluid w-100" src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                        style="max-height: 450px; object-fit: cover;">
                @endif

                <div class="card-body">
                    <div class="mb-4">
                        @foreach ($post->categories as $item)
                            <span class="badge bg-label-primary me-1">{{ $item->category->label() }}</span>
                        @endforeach
                    </div>

                    <h2 class="fw-bold mb-4">{{ $post->title }}</h2>

                    <h5 class="my-4"><i class="ti ti-camera me-2"></i> Galeri Foto</h5>
                    <div class="row g-3 mb-5">
                        @foreach ($post->images as $img)
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="image-grid-item shadow-sm border">
                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                        data-bs-target="#imageModal{{ $loop->index }}">
                                        <img src="{{ asset('storage/' . $img->path) }}" alt="Gallery Image">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="article-content">
                        {!! $post->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($post->images as $img)
        <div class="modal fade" id="imageModal{{ $loop->index }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-transparent border-0">
                    <div class="modal-body p-0 text-center">
                        <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-2"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                        <img src="{{ asset('storage/' . $img->path) }}" class="img-fluid rounded shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
