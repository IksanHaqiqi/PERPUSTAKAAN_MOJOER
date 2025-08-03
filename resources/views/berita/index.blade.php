@extends($layout)

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-lg-8">

                <!-- Blog Details Section -->
                <section id="blog-details" class="blog-details section">
                    <div class="container" data-aos="fade-up">



                        <article class="article">

                            {{-- @forelse ($beritas as $b)
                                <div class="hero-img" data-aos="zoom-in">
                                    @if ($b->gambar)
                                        <img src="{{ asset('storage/images/' . $b->gambar) }}" alt="Featured blog image"
                                            class="img-fluid" loading="lazy">
                                    @endif
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
                                        <h1 class="title">
                                            <a href="{{ url('berita/' . $b->slug) }}">{{ $b->judul }}</a>
                                        </h1>

                                        <div class="author-info">
                                            <div class="author-details">
                                                <img src="{{ asset('blog/assets/img/blog/blog-post-square-1.webp') }}"
                                                    alt="Author" class="author-img">
                                                <div class="info">
                                                    <h4>{{ $b->penulis }}</h4>
                                                    <span class="role">Senior Web Developer</span>
                                                </div>
                                            </div>
                                            <div class="post-meta">
                                                <span class="date"><i class="bi bi-calendar3"></i>
                                                    {{ $b->tanggal_publish }}</span>
                                                <span class="divider">•</span>
                                                <span class="comments"><i class="fas fa-eye">{{ $b->views }}</i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="content">
                                        <p class="">
                                            {!! nl2br(e($b->isi)) !!}

                                        </p>

                                    </div>
                                </div>
                            @empty
                                <p class="text-center">Belum ada berita yang tersedia.</p>
                            @endforelse --}}
                            
                {{-- Jika ada berita yang dipilih --}}
                @if ($highlightBerita)
                    <div class="highlight-berita mb-4">
                        <h2>{{ $highlightBerita->judul }}</h2>
                        <img src="{{ asset('storage/images/' . $highlightBerita->gambar) }}" class="img-fluid rounded mb-3" alt="{{ $highlightBerita->judul }}">
                        <p>{!! nl2br(e($highlightBerita->isi)) !!}</p>
                        <small class="text-muted">Dipublish: {{ $highlightBerita->tanggal_publish->format('d M Y') }}</small>
                    </div>
                @else
                    {{-- Tampilkan semua berita --}}
                    @foreach ($beritas as $berita)
                        <div class="mb-5">
                            <h3>{{ $berita->judul }}</h3>
                            <img src="{{ asset('storage/images/' . $berita->gambar) }}" class="img-fluid rounded mb-2" alt="{{ $berita->judul }}">
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($berita->isi), 150) }}</p>
                            <a href="{{ route('berita.index', ['highlight' => $berita->id]) }}">Baca selengkapnya</a>
                        </div>
                    @endforeach
                @endif


                            <section id="blog-comment-form" class="blog-comment-form section">

                                <div class="container" data-aos="fade-up" data-aos-delay="100">

                                    <form method="post" role="form">

                                        <div class="section-header">
                                            <h3>Share Your Thoughts</h3>
                                            <p>Your email address will not be published. Required fields are marked *
                                            </p>
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
                                                <textarea class="form-control" name="comment" id="comment" rows="5" placeholder="Write your thoughts here..."
                                                    required=""></textarea>
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
                </section>
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

                        @foreach ($recentPosts as $post)
                            <div class="post-item mb-2 d-flex gap-3">
                                <img src="{{ asset('storage/images/' . $post->gambar) }}" alt="{{ $post->judul }}"
                                    class="flex-shrink-0" style="width: 80px; height: 80px; object-fit: cover;">
                                <div>
                                    <h4>
                                        <a href="{{ route('berita.index', ['highlight' => $post->id]) }}">
                                            {{ \Illuminate\Support\Str::limit($post->judul, 40) }}
                                        </a>
                                    </h4>
                                    <time datetime="{{ $post->tanggal_publish->toDateString() }}">
                                        {{ $post->tanggal_publish->format('M d, Y') }}
                                    </time>
                                </div>
                            </div>
                        @endforeach
                    </div>


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

    </div>
@endsection
