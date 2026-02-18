@extends('layouts.app')

@section('title', 'Maklumat Pelayanan - Satpel PVP Pekanbaru')

@section('content')
    <main class="main">
        <div class="page-title">
            <div class="heading">
                <div class="container text-center">
                    <h1 class="heading-title">Maklumat Pelayanan</h1>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="container" data-aos="fade-up">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="card border-0 shadow-sm p-4 p-md-5 text-center" style="border-radius: 20px;">
                            <img src="{{ asset('assets/img/logo-satpel.png') }}" alt="Logo" class="mb-4"
                                style="height: 60px; width: auto; object-fit: contain;">

                            <h2 class="mb-4" style="color: #00154c; font-weight: 800;">MAKLUMAT PELAYANAN</h2>

                            <div class="maklumat-text px-md-5">
                                <p class="lead mb-4" style="font-style: italic; font-size: 1.5rem;">
                                    "Dengan ini, Kami menyatakan sanggup menyelenggarakan pelayanan sesuai standar pelayanan
                                    yang telah ditetapkan dan apabila tidak menepati janji ini, kami siap menerima sanksi
                                    sesuai peraturan perundang-undangan yang berlaku".
                                </p>

                                <hr class="my-5 w-25 mx-auto">

                                <p class="mb-0">Pekanbaru, 2026</p>
                                <p class="fw-bold">Kepala Satpel PVP Pekanbaru</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('styles')
    <style>
        .maklumat-text p {
            color: #444;
            line-height: 1.8;
        }

        .heading-title {
            color: #00154c;
            font-weight: 700;
        }

        .image-wrapper img {
            transition: transform 0.3s ease;
        }

        .image-wrapper:hover img {
            transform: scale(1.02);
        }
    </style>
@endpush
