<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard 2</title>

    <!-- Fontfaces CSS-->
    <!-- Fontfaces CSS-->
    <link href="{{ asset('template/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('template/vendor/fontawesome-6.7.2/css/all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('template/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
        media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('template/vendor/bootstrap-5.3.7.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('template/css/aos.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('template/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('template/css/swiper-bundle.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('template/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Leaflet CSS-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <!-- Main CSS-->
    <link href="{{ asset('template/css/theme.css') }}" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        @yield('content')
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop2">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap2">
                            <div class="logo d-block d-lg-none">
                                <a href="#">
                                    <img src="{{ asset('template/images/icon/logo-white.png') }}" alt="CoolAdmin" />
                                </a>
                            </div>
                            <div class="header-button2">
                                <div class="header-button-item js-item-menu">
                                    <i class="zmdi zmdi-search"></i>
                                    <div class="search-dropdown js-dropdown">
                                        <form action="">
                                            <input class="au-input au-input--full au-input--h65" type="text"
                                                placeholder="Search for datas &amp; reports..." />
                                            <span class="search-dropdown__icon">
                                                <i class="zmdi zmdi-search"></i>
                                            </span>
                                        </form>
                                    </div>
                                </div>
                                <div class="header-button-item has-noti js-item-menu">
                                    <i class="zmdi zmdi-notifications"></i>
                                    <div class="notifi-dropdown js-dropdown">
                                        <div class="notifi__title">
                                            <p>You have 3 Notifications</p>
                                        </div>
                                        <div class="notifi__item">
                                            <div class="bg-c1 img-cir img-40">
                                                <i class="zmdi zmdi-email-open"></i>
                                            </div>
                                            <div class="content">
                                                <p>You got a email notification</p>
                                                <span class="date">January 15, 2025 14:30</span>
                                            </div>
                                        </div>
                                        <div class="notifi__item">
                                            <div class="bg-c2 img-cir img-40">
                                                <i class="zmdi zmdi-account-box"></i>
                                            </div>
                                            <div class="content">
                                                <p>Your account has been blocked</p>
                                                <span class="date">January 15, 2025 14:30</span>
                                            </div>
                                        </div>
                                        <div class="notifi__item">
                                            <div class="bg-c3 img-cir img-40">
                                                <i class="zmdi zmdi-file-text"></i>
                                            </div>
                                            <div class="content">
                                                <p>You got a new file</p>
                                                <span class="date">January 15, 2025 14:30</span>
                                            </div>
                                        </div>
                                        <div class="notifi__footer">
                                            <a href="#">All notifications</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="header-button-item me-0 js-sidebar-btn">
                                    <i class="zmdi zmdi-menu"></i>
                                </div>
                                <div class="setting-menu js-right-sidebar d-none d-lg-block">
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-account"></i>Account</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-settings"></i>Setting</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-money-box"></i>Billing</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-globe"></i>Language</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-pin"></i>Location</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-email"></i>Email</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-notifications"></i>Notifications</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
                <div class="logo">
                    <a href="#">
                        <img src="{{ asset('template/images/icon/logo-white.png') }}" alt="Cool Admin" />
                    </a>
                </div>
                <div class="menu-sidebar2__content js-scrollbar2">
                    <div class="account2">
                        <div class="image img-cir img-120">
                            <img src="{{ asset('template/images/icon/avatar-big-01.jpg') }}" alt="John Doe" />
                        </div>
                        <h4 class="name">john doe</h4>
                        <a href="#">Sign out</a>
                    </div>
                    <nav class="navbar-sidebar2">
                        <ul class="list-unstyled navbar__list">
                            <li class="active has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-tachometer-alt"></i>Dashboard
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="index.html">
                                            <i class="fas fa-tachometer-alt"></i>Dashboard 1</a>
                                    </li>
                                    <li>
                                        <a href="index2.html">
                                            <i class="fas fa-tachometer-alt"></i>Dashboard 2</a>
                                    </li>
                                    <li>
                                        <a href="index3.html">
                                            <i class="fas fa-tachometer-alt"></i>Dashboard 3</a>
                                    </li>
                                    <li>
                                        <a href="index4.html">
                                            <i class="fas fa-tachometer-alt"></i>Dashboard 4</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="inbox.html">
                                    <i class="fas fa-chart-bar"></i>Inbox</a>
                                <span class="inbox-num">3</span>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fas fa-shopping-basket"></i>eCommerce</a>
                            </li>
                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-trophy"></i>Features
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="table.html">
                                            <i class="fas fa-table"></i>Tables</a>
                                    </li>
                                    <li>
                                        <a href="form.html">
                                            <i class="far fa-check-square"></i>Forms</a>
                                    </li>
                                    <li>
                                        <a href="calendar.html">
                                            <i class="fas fa-calendar-alt"></i>Calendar</a>
                                    </li>
                                    <li>
                                        <a href="map.html">
                                            <i class="fas fa-map-marker-alt"></i>Maps</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-copy"></i>Pages
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="login.html">
                                            <i class="fas fa-sign-in-alt"></i>Login</a>
                                    </li>
                                    <li>
                                        <a href="register.html">
                                            <i class="fas fa-user"></i>Register</a>
                                    </li>
                                    <li>
                                        <a href="forget-pass.html">
                                            <i class="fas fa-unlock-alt"></i>Forget Password</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-desktop"></i>UI Elements
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="button.html">
                                            <i class="fab fa-flickr"></i>Button</a>
                                    </li>
                                    <li>
                                        <a href="badge.html">
                                            <i class="fas fa-comment-alt"></i>Badges</a>
                                    </li>
                                    <li>
                                        <a href="tab.html">
                                            <i class="far fa-window-maximize"></i>Tabs</a>
                                    </li>
                                    <li>
                                        <a href="card.html">
                                            <i class="far fa-id-card"></i>Cards</a>
                                    </li>
                                    <li>
                                        <a href="alert.html">
                                            <i class="far fa-bell"></i>Alerts</a>
                                    </li>
                                    <li>
                                        <a href="progress-bar.html">
                                            <i class="fas fa-tasks"></i>Progress Bars</a>
                                    </li>
                                    <li>
                                        <a href="modal.html">
                                            <i class="far fa-window-restore"></i>Modals</a>
                                    </li>
                                    <li>
                                        <a href="switch.html">
                                            <i class="fas fa-toggle-on"></i>Switchs</a>
                                    </li>
                                    <li>
                                        <a href="grid.html">
                                            <i class="fas fa-th-large"></i>Grids</a>
                                    </li>
                                    <li>
                                        <a href="fontawesome.html">
                                            <i class="fab fa-font-awesome"></i>FontAwesome</a>
                                    </li>
                                    <li>
                                        <a href="typo.html">
                                            <i class="fas fa-font"></i>Typography</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
  
        </div>

    </div>

    <!-- Jquery JS--><!-- Jquery JS -->
    <script src="{{ asset('UI/js/vanilla-utils.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('UI/vendor/bootstrap-5.3.7.bundle.min.js') }}"></script>

    <!-- Vendor JS -->
    <script src="{{ asset('UI/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('UI/vendor/chartjs/Chart.bundle.min.js') }}"></script>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Main JS -->
    <script src="{{ asset('UI/js/bootstrap5-init.js') }}"></script>
    <script src="{{ asset('UI/js/main-vanilla.js') }}"></script>
    <script src="{{ asset('UI/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('UI/js/aos.js') }}"></script>
    <script src="{{ asset('UI/js/modern-plugins.js') }}"></script>


    <!-- Initialize Leaflet Map for index2.html only -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Only initialize if this is index2.html and the vmap container exists
            const mapContainer = document.getElementById('vmap');
            const isIndex2 = window.location.pathname.includes('index2.html') || document.title.includes(
                'Dashboard 2');

            if (mapContainer && typeof L !== 'undefined' && isIndex2 && !mapContainer._leaflet_id) {
                try {
                    // Initialize the map
                    const map = L.map('vmap', {
                        center: [20, 0], // Center of the world
                        zoom: 2,
                        zoomControl: true,
                        scrollWheelZoom: false,
                        doubleClickZoom: true,
                        attributionControl: false
                    });

                    // Add tile layer (OpenStreetMap)
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '',
                        maxZoom: 10,
                        minZoom: 1
                    }).addTo(map);

                    // Sample data points for major cities/regions
                    const worldData = [{
                            name: 'United States',
                            lat: 39.8283,
                            lng: -98.5795,
                            value: 45000,
                            color: '#00b5e9'
                        },
                        {
                            name: 'United Kingdom',
                            lat: 55.3781,
                            lng: -3.4360,
                            value: 32000,
                            color: '#4caf50'
                        },
                        {
                            name: 'Germany',
                            lat: 51.1657,
                            lng: 10.4515,
                            value: 28000,
                            color: '#ff9800'
                        },
                        {
                            name: 'Japan',
                            lat: 36.2048,
                            lng: 138.2529,
                            value: 35000,
                            color: '#e91e63'
                        },
                        {
                            name: 'Australia',
                            lat: -25.2744,
                            lng: 133.7751,
                            value: 22000,
                            color: '#9c27b0'
                        },
                        {
                            name: 'Brazil',
                            lat: -14.2350,
                            lng: -51.9253,
                            value: 18000,
                            color: '#f44336'
                        },
                        {
                            name: 'India',
                            lat: 20.5937,
                            lng: 78.9629,
                            value: 25000,
                            color: '#3f51b5'
                        },
                        {
                            name: 'China',
                            lat: 35.8617,
                            lng: 104.1954,
                            value: 40000,
                            color: '#00bcd4'
                        }
                    ];

                    // Add markers for each data point
                    worldData.forEach(point => {
                        const marker = L.circleMarker([point.lat, point.lng], {
                            radius: Math.sqrt(point.value / 1000) + 5, // Size based on value
                            fillColor: point.color,
                            color: '#fff',
                            weight: 2,
                            opacity: 1,
                            fillOpacity: 0.7
                        }).addTo(map);

                        // Add popup with country info
                        marker.bindPopup(`
                        <div style="text-align: center; padding: 5px;">
                            <strong>${point.name}</strong><br>
                            <span style="color: ${point.color}; font-weight: bold;">$${point.value.toLocaleString()}</span>
                        </div>
                    `);

                        // Hover effects
                        marker.on('mouseover', function() {
                            this.setStyle({
                                fillOpacity: 0.9,
                                weight: 3
                            });
                        });

                        marker.on('mouseout', function() {
                            this.setStyle({
                                fillOpacity: 0.7,
                                weight: 2
                            });
                        });
                    });

                    // Add custom controls
                    const info = L.control({
                        position: 'topright'
                    });
                    info.onAdd = function() {
                        const div = L.DomUtil.create('div', 'info');
                        div.innerHTML =
                            '<div style="background: rgba(255,255,255,0.9); padding: 8px; border-radius: 4px; font-size: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">Global Revenue Distribution</div>';
                        return div;
                    };
                    info.addTo(map);

                    console.log('Leaflet world map initialized successfully');
                } catch (error) {
                    console.error('Error initializing world map:', error);
                    // Fallback content
                    mapContainer.innerHTML = `
                    <div style="height: 100%; display: flex; align-items: center; justify-content: center; background: #f8f9fa; color: #666; border-radius: 8px;">
                        <div style="text-align: center;">
                            <i class="fas fa-globe-americas" style="font-size: 32px; margin-bottom: 10px;"></i>
                            <div>Map loading failed</div>
                        </div>
                    </div>
                `;
                }
            }
        });
    </script>

</body>

</html>
