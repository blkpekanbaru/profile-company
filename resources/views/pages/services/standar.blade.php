@extends('layouts.app')

@section('title', 'Standar Pelayanan Publik - Satpel PVP Pekanbaru')

@section('content')
    <main class="main">
        <div class="page-title">
            <div class="heading">
                <div class="container text-center">
                    <h1 class="heading-title">Standar Pelayanan Publik</h1>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="container" data-aos="fade-up">
                <div class="row align-items-center gy-4">
                    <div class="col-lg-7">
                        <h2 style="color: #00154c; font-weight: 700;">Standar Pelayanan Satpel PVP Pekanbaru</h2>
                        <p class="mt-4">Segala puji bagi Allah SWT, Tuhan maha semesta alam yang telah memberikan rahmat
                            dan hidayah-Nya. Satpel PVP Pekanbaru berkomitmen memberikan pelayanan terbaik bagi masyarakat.
                        </p>

                        <p>Penetapan Standar Pelayanan Publik dibuat berdasarkan:</p>
                        <ul class="list-unstyled mt-3">
                            <li><i class="bi bi-check-circle-fill text-primary me-2"></i> Undang-Undang Nomor 25 Tahun 2009
                                tentang Pelayanan Publik</li>
                            <li><i class="bi bi-check-circle-fill text-primary me-2"></i> Peraturan Pemerintah Nomor 96
                                Tahun 2012</li>
                            <li><i class="bi bi-check-circle-fill text-primary me-2"></i> Peraturan Menteri PAN-RB Nomor 15
                                Tahun 2014</li>
                        </ul>

                        <a href="#" class="btn btn-primary mt-4 rounded-pill px-4">
                            <i class="bi bi-download me-2"></i> Unduh Dokumen Lengkap
                        </a>
                    </div>

                    <div class="col-lg-5">
                        <div class="image-wrapper shadow-lg p-2" style="border-radius: 15px;">
                            <img src="{{ asset('assets/img/public-service-book.jpg') }}" class="img-fluid rounded"
                                alt="Buku Standar Pelayanan">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
