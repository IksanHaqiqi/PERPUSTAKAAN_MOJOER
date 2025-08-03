<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Mojoer Media</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">

    <!-- Favicons -->
    <link href="{{ asset('BookLanding/assets/img/MOJOER.png') }}" rel="icon">
    <link href="{{ asset('BookLanding/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('BookLanding/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('BookLanding/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('BookLanding/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('BookLanding/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('BookLanding/assets/css/main.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: BookLanding
  * Template URL: https://bootstrapmade.com/bootstrap-book-landing-page-template/
  * Updated: Mar 02 2025 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page" class="main w-100 ">
    <nav id="navmenu" class="navmenu">
        <ul>
            <li><a href=" #related-books">Produk</a></li>
            <li>
            </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list text-white "></i>
    </nav>
    <main>

        <!-- Hero Section -->
        <section id="hero" class="hero section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-center justify-content-center">
                    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">
                        <a href="#" class="navbar-brand d-flex align-items-center">
                            <img src="{{ asset('BookLanding/assets/img/MOJOER.png') }}" alt="Logo" height="40"
                                class="me-2">
                        </a>
                    </div>
                    <div class="col-lg-5">
                        <div class="book-hero-content" data-aos="fade-up" data-aos-delay="200">
                            <span class="book-genre text-white">Mojoer Media</span>
                            <h1>Perpustakaan Models Jurnalisme</h1>
                            <p class="book-subtitle">Informatif dan Inovatif
                                <br> Dikelola dengan semangat literasi 📸✒️
                            </p>
                            <p class="book-description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac diam sit amet
                                quam vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada.
                            </p>
                            <div class="hero-cta">
                                <a href="#related-books" class="btn-primary">Lihat Produk</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 d-flex justify-content-center justify-content-lg-end" data-aos="zoom-out"
                        data-aos-delay="300">
                        <div class="book-cover">
                            <img src="{{ asset('BookLanding/assets/img/book/book-1.webp') }}" alt="Book Cover"
                                class="img-fluid">

                            <div class="book-shadow"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Hero Section -->



        <!-- Related Books Section -->
        <section id="related-books" class="related-books section bg-light">
            <!-- Section Title -->
            <div class="container section-title text-dark" data-aos="fade-up">
                <h2 class="text-dark">Daftar Buku Yang Tersedia</h2>
                <p>Lorem ipsum dolor sit amet.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row  gy-4">
                    @foreach ($lemaris as $lemari)
                        <div class="col-lg-4 col-md-6 " data-aos="fade-up" data-aos-delay="100">
                            <div class="related-book-card">
                                <div class="book-image">
                                    <img src="{{ asset('storage/images/' . $lemari->image) }}" alt="Book Cover"
                                        class="img-fluid">
                                    <div class="book-category">{{ $lemari->kategori }}</div>
                                </div>
                                <div class="book-info">
                                    <h3 class="card-title">{{ $lemari->judul }}</h3>
                                    <div class="book-meta">
                                        <p class="card-text mb-1"><strong>Penerbit:</strong> {{ $lemari->penerbit }}
                                        </p>
                                    </div>
                                    <p class="card-text"><strong>Stok:</strong> {{ $lemari->stock }}</p>
                                    <div class="book-actions">
                                        @auth
                                            <a href="{{ route('peminjaman.create', ['lemari_id' => $lemari->id]) }}"
                                                class="btn-purchase">Pinjam</a>
                                        @else
                                            <a href="{{ route('login') }}"
                                                onclick="return confirm('Silakan login dulu untuk meminjam buku.')"
                                                class="btn-purchase text-white bg-dark">pinjam</a>
                                        @endauth
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- /Related Books Section -->
    </main>

    <footer id="footer" class="footer">
        <div class="container">
            <h3 class="sitename">MODELS</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. In, excepturi..</p>
            <div class="social-links d-flex justify-content-center">
                <a href=""><i class="bi bi-twitter-x"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-skype"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('BookLanding/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('BookLanding/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('BookLanding/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('BookLanding/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>



    <!-- Main JS File -->
    <script src="{{ asset('BookLanding/assets/js/main.js') }}"></script>

</body>

</html>
