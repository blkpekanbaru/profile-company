@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="page-title">
            <div class="heading">
                <div class="container text-center">
                    <h1>{{ $title }}</h1>
                    <p>Silakan isi formulir di bawah ini dengan data yang sebenar-benarnya.</p>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="container text-center">
                {{-- Menggunakan iframe agar GForm tampil di dalam web --}}
                <div class="ratio ratio-16x9" style="min-height: 800px;">
                    <iframe src="{{ $form_url }}" width="100%" height="800" frameborder="0" marginheight="0"
                        marginwidth="0">
                        Memuat…
                    </iframe>
                </div>
            </div>
        </section>
    </main>
@endsection
