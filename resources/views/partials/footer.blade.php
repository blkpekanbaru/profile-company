<footer id="footer" class="footer-16 footer position-relative pb-4">

    <div class="container">

        <div class="footer-main" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-start justify-content-between">

                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div class="brand-section">
                        <a href="{{ route('home') }}" class="logo d-flex align-items-center mb-3">
                            <img src="{{ asset('assets/img/logo-putih.png') }}" alt="logo-satpel">
                        </a>
                        <p class="brand-description mb-0">SATUAN PELAYANAN PELATIHAN VOKASI DAN PRODUKTIVITAS PEKANBARU</p>

                        <!-- Bagian Alamat (Telepon dan Email dihapus) -->
                        <div class="contact-info mt-4 d-flex flex-column gap-2">
                            <div class="d-flex align-items-start gap-2 text-white">
                                <i class="bi bi-geo-alt flex-shrink-0" style="width: 20px; margin-top: 2px;"></i>
                                <span>Jl. Terubuk No.4, Wonorejo, Kec. Marpoyan Damai, Kota Pekanbaru, Riau 28125</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="footer-nav-wrapper">
                        <div class="row">

                            <div class="col-6 col-md-4">
                                <div class="nav-column">
                                    <h6>Tentang Kami</h6>
                                    <nav class="footer-nav d-flex flex-column gap-2">
                                        <a href="{{ route('about') }}" class="m-0">Profil</a>
                                        <a href="{{ route('facilities') }}" class="m-0">Sarana & Prasarana</a>
                                        <a href="{{ route('registration.guide') }}" class="m-0">Tata Cara Pendaftaran</a>
                                        <a href="{{ route('public.faq') }}" class="m-0">Pertanyaan Umum (FAQ)</a>
                                    </nav>
                                </div>
                            </div>

                            <div class="col-6 col-md-4">
                                <div class="nav-column">
                                    <h6>Jelajahi Pelatihan</h6>
                                    <nav class="footer-nav d-flex flex-column gap-2">
                                        @foreach ($departments as $dept)
                                            <a href="{{ route('workshop.detail', $dept->slug) }}" class="m-0">
                                                Kejuruan {{ $dept->name }}
                                            </a>
                                        @endforeach
                                    </nav>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 mt-4 mt-md-0">
                                <div class="nav-column">
                                    <h6>Kontak Kami</h6>
                                    <nav class="footer-nav d-flex flex-column gap-2">
                                        <a href="https://www.instagram.com/blkpekanbaru" target="_blank" class="d-flex align-items-center gap-2 m-0">
                                            <i class="fab fa-instagram text-center" style="width: 18px;"></i>
                                            <span>blkpekanbaru</span>
                                        </a>
                                        <a href="https://www.tiktok.com/@blkpekanbaru" target="_blank" class="d-flex align-items-center gap-2 m-0">
                                            <i class="fab fa-tiktok text-center" style="width: 18px;"></i>
                                            <span>blkpekanbaru</span>
                                        </a>
                                        <a href="https://wa.me/6282364267742" target="_blank" class="d-flex align-items-center gap-2 m-0">
                                            <i class="fab fa-whatsapp text-center" style="width: 18px;"></i>
                                            <span>082364267742</span>
                                        </a>
                                        <a href="https://bpvppekanbaru.kemnaker.go.id/" class="d-flex align-items-center gap-2 m-0">
                                            <i class="fas fa-globe text-center" style="width: 18px;"></i>
                                            <span>bpvppekanbaru.kemnaker.go.id</span>
                                        </a>
                                        <a href="mailto:satpelblkpekanbaru@gmail.com" class="d-flex align-items-center gap-2 m-0">
                                            <i class="fas fa-envelope text-center" style="width: 18px;"></i>
                                            <span>satpelblkpekanbaru@gmail.com</span>
                                        </a>
                                    </nav>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Garis Hak Cipta & Lisensi Legal Template -->
    <div class="container mt-4 pt-3" style="border-top: 1px solid rgba(255, 255, 255, 0.1);">
        <div class="row align-items-center gy-2">
            <!-- Hak Cipta Resmi Satpel PVP Pekanbaru -->
            <div class="col-md-6 text-center text-md-start">
                <span class="text-white-50 small">
                    © Satpel PVP Pekanbaru. Hak Cipta Dilindungi.
                </span>
            </div>

            <!-- Kredit Lisensi Asli (Sesuai Syarat Free License BootstrapMade) -->
            <div class="col-md-6 text-center text-md-end">
                <span class="small" style="color: #00154c; opacity: 0.8;">
                    Designed by <a href="https://bootstrapmade.com/" target="_blank" style="color: #00154c; text-decoration: none;">BootstrapMade</a>.
                    Distributed by <a href="https://themewagon.com" target="_blank" style="color: #00154c; text-decoration: none;">ThemeWagon</a>
                </span>
            </div>
        </div>
    </div>

</footer>
