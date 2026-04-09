<footer id="footer" class="footer-16 footer position-relative">

    <div class="container">

        <div class="footer-main" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-start">

                <div class="col-lg-5">
                    <div class="brand-section">
                        <a href="{{ route('home') }}" class="logo d-flex align-items-center mb-4">
                            <img src="{{ asset('assets/img/logo-putih.png') }}" alt="logo-satpel">
                        </a>
                        <p class="brand-description">SATUAN PELAYANAN PELATIHAN VOKASI DAN PRODUKTIVITAS PEKANBARU</p>

                        <div class="contact-info mt-5">
                            <div class="contact-item">
                                <i class="bi bi-geo-alt"></i>
                                <span>Jl. Terubuk No.4, Wonorejo, Kec. Marpoyan Damai, Kota Pekanbaru, Riau 28125</span>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-telephone"></i>
                                <span>082364267742</span>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-envelope"></i>
                                <span>satpelpvppekanbaru@gmail.com</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="footer-nav-wrapper">
                        <div class="row">

                            <div class="col-6 col-lg-3">
                                <div class="nav-column">
                                    <h6>Tentang Kami</h6>
                                    <nav class="footer-nav">
                                        <a href="{{ route('about') }}">Profil</a>
                                        <a href="{{ route('facilities') }}">Sarana & Prasarana</a>
                                    </nav>
                                </div>
                            </div>

                            <div class="col-6 col-lg-3">
                                <div class="nav-column">
                                    <h6>Jelajahi Pelatihan</h6>
                                    <nav class="footer-nav">
                                        @foreach ($departments as $dept)
                                            <a href="{{ route('workshop.detail', $dept->slug) }}">
                                                Kejuruan {{ $dept->name }}
                                            </a>
                                        @endforeach
                                    </nav>
                                </div>
                            </div>

                            <div class="col-6 col-lg-3">
                                <div class="nav-column">
                                    <h6>Kontak Kami</h6>
                                    <nav class="footer-nav">
                                        <a href="#!"><i class="fab fa-instagram me-2"></i>blkpekanbaru</a>
                                        <a href="#!"><i class="fab fa-tiktok me-2"></i>blkpekanbaru</a>
                                        <a href="#!"><i class="fab fa-whatsapp me-2"></i>082364267742</a>
                                        <a href="#!"><i class="fas fa-globe me-2"></i>bpvppekanbaru.kemnaker.go.id</a>
                                    </nav>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="bottom-content" data-aos="fade-up" data-aos-delay="300">
                <div class="row align-items-center">

                    <div class="col-lg-6">
                        <div class="copyright">
                            <p>© <span class="sitename">Clinic</span>. All rights reserved.</p>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="legal-links">
                            <a href="#!">Privacy Policy</a>
                            <a href="#!">Terms of Service</a>
                            <a href="#!">Cookie Policy</a>
                            <div class="credits">
                                <!-- All the links in the footer should remain intact. -->
                                <!-- You can delete the links only if you've purchased the pro version. -->
                                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>. Distributed by <a
                                    href="https://themewagon.com" target="_blank">ThemeWagon</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</footer>
