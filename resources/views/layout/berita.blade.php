<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>About - Blogy Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <!-- Favicon -->
    <link href="{{ asset('blog/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('blog/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <!-- Vendor CSS Files -->
    <link href="{{ asset('blog/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('blog/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('blog/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('blog/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('blog/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('blog/assets/css/main.css') }}" rel="stylesheet">




    <!-- =======================================================
  * Template Name: Blogy
  * Template URL: https://bootstrapmade.com/blogy-bootstrap-blog-template/
  * Updated: Feb 22 2025 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="about-page">

    <header id="header" class="header position-relative">
        <div class="container-fluid container-xl position-relative">
            <div class="top-row d-flex align-items-center justify-content-between">
                <a href="index.html" class="logo d-flex align-items-end text-decoration-none">
                    <!-- <img src="{{ asset('blog/assets/img/logo.webp') }}" alt=""> -->
                    <h1 class="sitename mb-0 text-dark">Blogy</h1><span class="text-dark fs-2">.</span>
                </a>

                <div class="d-flex align-items-center">
                    <!-- Ikon Sosial Media -->
                    <div class="social-links">
                        <a href="#" class="facebook text-dark me-2"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="twitter text-dark me-2"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="instagram text-dark me-2"><i class="bi bi-instagram"></i></a>
                    </div>

                    <!-- Form Pencarian -->
                    <form class="search-form ms-4 d-none d-md-flex">
                        <input type="text" placeholder="Search..." class="form-control">
                        <button type="submit" class="btn text-dark"><i class="bi bi-search"></i></button>
                    </form>

                    <!-- Tombol Toggle -->

                </div>

                <!-- Sidebar Kanan -->
                <!-- Tombol toggle bisa di navbar -->
                <!-- Tombol Toggle Sidebar -->
                <div class="ms-3 d-none d-xl-block">
                    <button id="sidebarToggle" class="btn border-0 bg-transparent">
                        <i class="bi bi-list fs-3 text-dark"></i>
                    </button>
                </div>

                <!-- Sidebar Menu di Kanan -->
                <div id="menu" class="menu collapsed-menu">
                    <button id="closeSidebar" class="btn-close" aria-label="Close"></button>
                    <div class="p-3 text-center">
                        <!-- FOTO PROFIL -->
                        @if (auth()->user()->image)
                            <img src="{{ asset('storage/profile/' . auth()->user()->image) }}"
                                class="rounded-circle mb-2" alt="Foto Profil" width="80" height="80">
                        @else
                            <img src="{{ asset('default-avatar.png') }}" class="rounded-circle mb-2" alt="Default Foto"
                                width="80" height="80">
                        @endif

                        <!-- NAMA USER -->
                        <h5 class="mt-2">Halo, {{ auth()->user()->name }}</h5>

                        <hr>

                        <!-- MENU -->
                        <ul class="nav flex-column text-center">
                            <li class="nav-item">
                                <a href="{{ route('profile.edit') }}" class="nav-link ">Pengaturan Profil</a>
                            </li>

                            <li>
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Log Out
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                        </ul>
                    </div>


                </div>
            </div>
            <div class="nav-wrap">
                <div class="container d-flex justify-content-center position-relative">
                    <nav id="navmenu" class="navmenu">
                        <ul>
                            <li><a href="{{ route('crud.index') }}">Beranda</a></li>
                            <li><a href="{{ route('peminjaman.index') }}">Status Pinjam</a></li>
                            <li><a href="#" class="active">Blog Details</a></li>
                            

                            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                    </nav>
                </div>
            </div>

    </header>
    <main class="main">
        @yield('content')
    </main>

    <footer id="footer" class="footer">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">Blogy</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>A108 Adam Street</p>
                        <p>New York, NY 535022</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                        <p><strong>Email:</strong> <span>info@example.com</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">Product Management</a></li>
                        <li><a href="#">Marketing</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Hic solutasetp</h4>
                    <ul>
                        <li><a href="#">Molestiae accusamus iure</a></li>
                        <li><a href="#">Excepturi dignissimos</a></li>
                        <li><a href="#">Suscipit distinctio</a></li>
                        <li><a href="#">Dilecta</a></li>
                        <li><a href="#">Sit quas consectetur</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Nobis illum</h4>
                    <ul>
                        <li><a href="#">Ipsam</a></li>
                        <li><a href="#">Laudantium dolorum</a></li>
                        <li><a href="#">Dinera</a></li>
                        <li><a href="#">Trodelas</a></li>
                        <li><a href="#">Flexo</a></li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Blogy</strong> <span>All Rights Reserved</span>
            </p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <!-- Vendor JS Files -->
    <script src="{{ asset('blog/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('blog/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('blog/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('blog/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('blog/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('blog/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('blog/assets/js/main.js') }}"></script>


</body>

</html>
