@extends('layout.berita')

@section('content')
    <link href="{{ asset('blog/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('blog/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('blog/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('blog/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('blog/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('blog/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('blog/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('blog/assets/css/main.css') }}" rel="stylesheet">

    <div class="container">
        <div class="row">

            <div class="col-lg-8">

                <!-- Blog Details Section -->
                <section id="blog-details" class="blog-details section">
                    <div class="container" data-aos="fade-up">

                        <article class="article">

                            <div class="hero-img" data-aos="zoom-in">
                                <img src="assets/img/blog/blog-post-3.webp" alt="Featured blog image" class="img-fluid"
                                    loading="lazy">
                                <div class="meta-overlay">
                                    <div class="meta-categories">
                                        <a href="#" class="category">Web Development</a>
                                        <span class="divider">•</span>
                                        <span class="reading-time"><i class="bi bi-clock"></i> 6 min read</span>
                                    </div>
                                </div>
                            </div>

                            <div class="article-content" data-aos="fade-up" data-aos-delay="100">
                                <div class="content-header">
                                    <h1 class="title">Modern Web Development: Best Practices and Future Trends for 2025
                                    </h1>

                                    <div class="author-info">
                                        <div class="author-details">
                                            <img src="assets/img/person/person-f-8.webp" alt="Author" class="author-img">
                                            <div class="info">
                                                <h4>Michael Chen</h4>
                                                <span class="role">Senior Web Developer</span>
                                            </div>
                                        </div>
                                        <div class="post-meta">
                                            <span class="date"><i class="bi bi-calendar3"></i> Mar 15, 2025</span>
                                            <span class="divider">•</span>
                                            <span class="comments"><i class="bi bi-chat-text"></i> 18 Comments</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="content">
                                    <p class="lead">
                                        The landscape of web development continues to evolve at an unprecedented pace,
                                        bringing new technologies, frameworks, and methodologies that reshape how we build
                                        modern web applications.
                                    </p>

                                    <p>
                                        As we delve into 2025, the web development ecosystem has transformed dramatically,
                                        introducing innovative approaches to building faster, more secure, and highly
                                        engaging web experiences. This comprehensive guide explores the latest trends and
                                        best practices that are defining the future of web development.
                                    </p>

                                    <div class="content-image right-aligned">
                                        <img src="assets/img/blog/blog-hero-2.webp" class="img-fluid"
                                            alt="Modern web development tools" loading="lazy">
                                        <figcaption>Modern development environments emphasize collaboration and efficiency
                                        </figcaption>
                                    </div>

                                    <h2>The Rise of Web Components</h2>
                                    <p>
                                        Web Components have become increasingly crucial in modern web development, offering
                                        a standardized way to create reusable custom elements. Key advantages include:
                                    </p>
                                    <ul>
                                        <li>Enhanced code reusability across different frameworks</li>
                                        <li>Better encapsulation of functionality</li>
                                        <li>Improved maintenance and scalability</li>
                                        <li>Framework-agnostic component development</li>
                                    </ul>


                                </div>
                            </div>



                            <section id="blog-comment-form" class="blog-comment-form section">

                                <div class="container" data-aos="fade-up" data-aos-delay="100">

                                    <form method="post" role="form">

                                        <div class="section-header">
                                            <h3>Share Your Thoughts</h3>
                                            <p>Your email address will not be published. Required fields are marked *</p>
                                        </div>

                                        <div class="row gy-3">
                                            <div class="col-md-6 form-group">
                                                <label for="name">Full Name *</label>
                                                <input type="text" name="name" class="form-control" id="name"
                                                    placeholder="Enter your full name" required="">
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label for="email">Email Address *</label>
                                                <input type="email" name="email" class="form-control" id="email"
                                                    placeholder="Enter your email address" required="">
                                            </div>

                                            <div class="col-12 form-group">
                                                <label for="website">Website</label>
                                                <input type="url" name="website" class="form-control" id="website"
                                                    placeholder="Your website (optional)">
                                            </div>

                                            <div class="col-12 form-group">
                                                <label for="comment">Your Comment *</label>
                                                <textarea class="form-control" name="comment" id="comment" rows="5"
                                                    placeholder="Write your thoughts here..." required=""></textarea>
                                            </div>

                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn-submit">Post Comment</button>
                                            </div>
                                        </div>

                                    </form>

                                </div>

                            </section><!-- /Blog Comment Form Section -->

                        </article>

                    </div>
                    <!-- Blog Comment Form Section -->

            </div>

            <div class="col-lg-4 sidebar">

                <div class="widgets-container" data-aos="fade-up" data-aos-delay="200">

                    <!-- Search Widget -->
                    <div class="search-widget widget-item">

                        <h3 class="widget-title">Search</h3>
                        <form action="">
                            <input type="text">
                            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                        </form>

                    </div><!--/Search Widget -->

                    <!-- Categories Widget -->
                    <div class="categories-widget widget-item">

                        <h3 class="widget-title">Categories</h3>
                        <ul class="mt-3">
                            <li><a href="#">General <span>(25)</span></a></li>
                            <li><a href="#">Lifestyle <span>(12)</span></a></li>
                            <li><a href="#">Travel <span>(5)</span></a></li>
                            <li><a href="#">Design <span>(22)</span></a></li>
                            <li><a href="#">Creative <span>(8)</span></a></li>
                            <li><a href="#">Educaion <span>(14)</span></a></li>
                        </ul>

                    </div><!--/Categories Widget -->



                    <!-- Recent Posts Widget -->
                    <div class="recent-posts-widget widget-item">

                        <h3 class="widget-title">Recent Posts</h3>

                        <div class="post-item">
                            <img src="assets/img/blog/blog-post-square-1.webp" alt="" class="flex-shrink-0">
                            <div>
                                <h4><a href="blog-details.html">Nihil blanditiis at in nihil autem</a></h4>
                                <time datetime="2020-01-01">Jan 1, 2020</time>
                            </div>
                        </div><!-- End recent post item-->

                        <div class="post-item">
                            <img src="assets/img/blog/blog-post-square-2.webp" alt="" class="flex-shrink-0">
                            <div>
                                <h4><a href="blog-details.html">Quidem autem et impedit</a></h4>
                                <time datetime="2020-01-01">Jan 1, 2020</time>
                            </div>
                        </div><!-- End recent post item-->

                        <div class="post-item">
                            <img src="assets/img/blog/blog-post-square-3.webp" alt="" class="flex-shrink-0">
                            <div>
                                <h4><a href="blog-details.html">Id quia et et ut maxime similique occaecati ut</a></h4>
                                <time datetime="2020-01-01">Jan 1, 2020</time>
                            </div>
                        </div><!-- End recent post item-->

                        <div class="post-item">
                            <img src="assets/img/blog/blog-post-square-4.webp" alt="" class="flex-shrink-0">
                            <div>
                                <h4><a href="blog-details.html">Laborum corporis quo dara net para</a></h4>
                                <time datetime="2020-01-01">Jan 1, 2020</time>
                            </div>
                        </div><!-- End recent post item-->


                        <div class="post-item">
                            <img src="assets/img/blog/blog-post-square-5.webp" alt="" class="flex-shrink-0">
                            <div>
                                <h4><a href="blog-details.html">Et dolores corrupti quae illo quod dolor</a></h4>
                                <time datetime="2020-01-01">Jan 1, 2020</time>
                            </div>
                        </div><!-- End recent post item-->

                        <div class="post-item">
                            <img src="assets/img/blog/blog-post-square-5.webp" alt="" class="flex-shrink-0">
                            <div>
                                <h4><a href="blog-details.html">Et dolores corrupti quae illo quod dolor</a></h4>
                                <time datetime="2020-01-01">Jan 1, 2020</time>
                            </div>
                        </div><!-- End recent post item-->

                        <div class="post-item">
                            <img src="assets/img/blog/blog-post-square-5.webp" alt="" class="flex-shrink-0">
                            <div>
                                <h4><a href="blog-details.html">Et dolores corrupti quae illo quod dolor</a></h4>
                                <time datetime="2020-01-01">Jan 1, 2020</time>
                            </div>
                        </div><!-- End recent post item-->

                    </div><!--/Recent Posts Widget -->

                    <!-- Tags Widget -->
                    <div class="tags-widget widget-item">

                        <h3 class="widget-title">Tags</h3>
                        <ul>
                            <li><a href="#">App</a></li>
                            <li><a href="#">IT</a></li>
                            <li><a href="#">Business</a></li>
                            <li><a href="#">Mac</a></li>
                            <li><a href="#">Design</a></li>
                            <li><a href="#">Office</a></li>
                            <li><a href="#">Creative</a></li>
                            <li><a href="#">Studio</a></li>
                            <li><a href="#">Smart</a></li>
                            <li><a href="#">Tips</a></li>
                            <li><a href="#">Marketing</a></li>
                        </ul>

                    </div><!--/Tags Widget -->


                    !-- Archive Widget -->
                    <div class="archive-widget widget-item">
                        <h3 class="widget-title">Archives</h3>
                        <div class="list-group list-group-flush">
                            <a href="#"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                January 2024
                                <span class="badge bg-secondary rounded-pill">12</span>
                            </a>
                            <a href="#"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                December 2023
                                <span class="badge bg-secondary rounded-pill">18</span>
                            </a>
                            <a href="#"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                November 2023
                                <span class="badge bg-secondary rounded-pill">15</span>
                            </a>
                            <a href="#"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                October 2023
                                <span class="badge bg-secondary rounded-pill">22</span>
                            </a>
                        </div>
                    </div><!--/Archive Widget -->

                    <!-- Popular Posts Widget -->
                    <div class="popular-posts-widget widget-item">
                        <h3 class="widget-title">Popular Posts</h3>

                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex align-items-start border-0 px-0">
                                <span class="badge bg-primary rounded-pill me-3 mt-1">1</span>
                                <div>
                                    <h6 class="mb-1"><a href="#" class="text-decoration-none">The Ultimate Guide
                                            to Web Design</a></h6>
                                    <small class="text-muted">2.4k views</small>
                                </div>
                            </div>

                            <div class="list-group-item d-flex align-items-start border-0 px-0">
                                <span class="badge bg-primary rounded-pill me-3 mt-1">2</span>
                                <div>
                                    <h6 class="mb-1"><a href="#" class="text-decoration-none">10 Tips for Better
                                            Content Marketing</a></h6>
                                    <small class="text-muted">1.8k views</small>
                                </div>
                            </div>

                            <div class="list-group-item d-flex align-items-start border-0 px-0">
                                <span class="badge bg-primary rounded-pill me-3 mt-1">3</span>
                                <div>
                                    <h6 class="mb-1"><a href="#" class="text-decoration-none">Mobile-First Design
                                            Principles</a></h6>
                                    <small class="text-muted">1.5k views</small>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="social-widget widget-item">
                            <h3 class="widget-title">Follow Us</h3>
                            <div class="d-grid gap-2">
                                <a href="#" class="btn btn-primary btn-sm">
                                    <i class="bi bi-facebook me-2"></i>Facebook
                                </a>
                                <a href="#" class="btn btn-info btn-sm">
                                    <i class="bi bi-twitter me-2"></i>Twitter
                                </a>
                                <a href="#" class="btn btn-danger btn-sm">
                                    <i class="bi bi-instagram me-2"></i>Instagram
                                </a>
                            </div>
                        </div><!--/Social Media Widget -->
                </div>

            </div>
        </div>
        <script src="{{ asset('blog/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('blog/assets/vendor/php-email-form/validate.js') }}"></script>
        <script src="{{ asset('blog/assets/vendor/aos/aos.js') }}"></script>
        <script src="{{ asset('blog/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('blog/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
        <script src="{{ asset('blog/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>

        <!-- Main JS File -->
        <script src="{{ asset('blog/assets/js/main.js') }}"></script>
    @endsection
