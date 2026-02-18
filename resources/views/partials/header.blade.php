<header id="header" class="header fixed-top">

    <div class="topbar d-flex align-items-center dark-background">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a
                        href="mailto:contact@example.com">satpelpvppekanbaru@gmail.com</a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="#!" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#!" class="tiktok"><i class="bi bi-tiktok"></i></a>
                <a href="#!" class="facebook"><i class="bi bi-facebook"></i></a>

            </div>
        </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-cente">

        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ asset('assets/img/logo-satpel.png') }}" alt="logo-satpel">
                {{-- <h1 class="sitename">Clinic</h1> --}}
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li>
                        <a href="{{ route('home') }}" class="{{ Route::is('home') ? 'active' : '' }}">Beranda</a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="{{ Route::is('about') ? 'active' : '' }}">Profil</a>
                    </li>
                    <li class="dropdown"><a href="#"
                            class="{{ Request::is('pelatihan*') || Request::is('fasilitas*') || Request::is('tata-cara-daftar*') ? 'active' : '' }}"><span>Pelatihan</span>
                            <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            @foreach ($departments as $dept)
                                <li>
                                    <a href="{{ route('workshop.detail', $dept->slug) }}">
                                        Kejuruan {{ $dept->name }}
                                    </a>
                                </li>
                            @endforeach
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a href="{{ route('facilities') }}">Sarana & Prasarana</a>
                            </li>
                            <li>
                                <a href="{{ route('registration.guide') }}">Tata Cara Daftar</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="{{ Request::is('pelayanan*') ? 'active' : '' }}">
                            <span>Pelayanan Publik</span>
                            <i class="bi bi-chevron-down toggle-dropdown"></i>
                        </a>
                        <ul>
                            <li><a href="{{ route('service.maklumat') }}">Maklumat Pelayanan</a></li>
                            <li><a href="{{ route('service.standar') }}">Standar Pelayanan Publik</a></li>
                            <li><a href="{{ route('service.survey') }}">Survei Kepuasan Masyarakat</a></li>
                            <li><a href="{{ route('service.complaint') }}">Pelayanan dan Pengaduan Masyarakat</a>
                            </li>
                            <li><a href="{{ route('service.alumni') }}">Survei Alumni Pelatihan</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#"><span>Info</span>
                            <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#">Berita Terbaru</a></li>
                            <li><a href="#">Informasi Pelatihan</a></li>
                            <li><a href="faq.html">Pertanyaan Umum (FAQ)</a></li>
                        </ul>
                    </li>
                    <li><a href="contact.html">PPID</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>

    </div>

</header>
