@extends('layouts.template-1')
@section('content')
<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex justify-content-between">

        <div id="logo">
            <h1 class="fs-3">
                <a href="index.html">
                    {{ strtok($aboutUs->our_name, ' ') }}
                    <span>
                        {{ Str::after(
                            $aboutUs->our_name, strtok($aboutUs->our_name, ' ')
                        ) }}
                    </span>
                </a>
            </h1>
            {{-- Uncomment below if you prefer to use an image logo
                <a href="index.html"><img src="{{
                asset('template1/img/logo.png') }}" alt=""></a> 
            --}}
        </div>

        <nav id="navbar" class="navbar">
            <ul>
                @foreach ($menus as $menu)
                <li>
                    <a href="{{ $menu->url }}" 
                        class="nav-link scrollto @if($loop->first) active @endif">
                        {{ $menu->text }}
                    </a>
                </li>
                @endforeach
                <li>
                    <a href="/landingTemplate/admin/login" style="cursor: pointer;"
                        class="border border-dark text-center mx-2 py-2 px-4 rounded-50"> 
                        Masuk
                    </a>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
    </div>
</header>

<!-- ======= hero Section ======= -->
<section id="hero">

    <div class="hero-content" data-aos="fade-up">
        <h2>{!! wordwrap($aboutUs->slogan, 20, '<br>') !!}</h2>
        <div>
            <a href="#about" class="btn-get-started scrollto">Get Started</a>
            <a href="#portfolio" class="btn-projects scrollto">Our Projects</a>
        </div>
    </div>

    <div class="hero-slider swiper-container">
        <div class="swiper-wrapper">
            @foreach ($heroCarousel as $carousel)
                <div class="swiper-slide" 
                style="background-image: url('{{ asset($carousel->img) }}"></div>    
            @endforeach
        </div>
    </div>

</section><!-- End Hero Section -->

<main id="main">
    <!-- ======= About Section ======= -->
    <section id="about">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-6 about-img">
                    <img src="{{ asset($aboutUs->cover_vision_mission) }}" alt="">
                </div>

                <div class="col-lg-6 content">
                    <x-section-header text="{{ $landingSection[0]->section_name }}" 
                    desc="{{ $landingSection[0]->first_desc }}" />
                    <div class="row mt-4">
                        <div class="col-lg">
                            <h5 class="fw-bold text-primary">Visi Kami</h5>
                            <p>{{ $aboutUs->our_vision }}</p>
                        </div>
                        <div class="col-lg">
                            <h5 class="fw-bold text-primary">Misi Kami</h5>
                            {!! $aboutUs->our_mission  !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <section id="services">
        <div class="container" data-aos="fade-up">
            <x-section-header text="{{ $landingSection[1]->section_name }}"/>

            <div class="row gy-4">
                @foreach ($ourService as $service)
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="box">
                        <div class="icon">
                            <img src="{{ $service->icon }}" height="64px"
                            alt="{{ $aboutUs->our_name . ' ' . 'Service' }}" >
                        </div>
                        <h4 class="title">{{ $service->title }}</h4>
                        <p class="description">{{ $service->desc }}</p>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- ======= Call To Action Section ======= -->
    <section id="call-to-action">
        <div class="container" data-aos="zoom-out">
            <div class="row">
                <div class="col-lg-9 text-center text-lg-start">
                    <h3 class="cta-title">{{ $landingSection[2]->section_name }}</h3>
                    <p class="cta-text">{{ $landingSection[2]->first_desc }}</p>
                </div>
                <div class="col-lg-3 cta-btn-container text-center">
                    <a class="cta-btn align-middle" href="#" id="cta-email">Call To Action</a>
                </div>
            </div>
        </div>
    </section><!-- End Call To Action Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials">
        <div class="container" data-aos="fade-up">
            <x-section-header text="{{ $landingSection[3]->section_name }}"/>

            <div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">
                    @foreach ($ourTeam as $team)
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <p>
                                <img src="{{ asset('template1/img/quote-sign-left.png') }}" class="quote-sign-left" alt="">
                                {{ $team->short_desc }}
                                <img src="{{ asset('template1/img/quote-sign-right.png') }}" class="quote-sign-right" alt="">
                            </p>
                            <img src="{{ asset($team->avatar) }}" 
                            class="testimonial-img" alt="">
                            <h3>{{ $team->name }}</h3>
                            <h4>{{ $team->position->name }}</h4>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section>

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg my-4 bg-primary">
        <div class="container" data-aos="fade-up">

            <x-section-header text="{{ $landingSection[4]->section_name }}" 
            class="text-white text-center" />

            <div class="accordion accordion-flush shadow p-4 bg-white parent-load-data" 
            id="load-faq">
                {{-- get faq using ajax [this is 'shadow' element] --}}
                <div class="accordion-item accordion-faq">
                    <h2 class="accordion-header" id="flush-faq">
                        <button class="accordion-button accordion__heading collapsed toggler-accordion" type="button" data-bs-toggle="collapse"
                        data-bs-target="#accordion-list" aria-expanded="false" 
                        aria-controls="accordion-list"></button>
                    </h2>
                    <div id="accordion-list" 
                        class="accordion-collapse collapse accordion__text" 
                        aria-labelledby="flush-faq"
                        data-bs-parent="#list-faq">
                        <div class="accordion-body">
                            <p></p>
                        </div>
                    </div>
                </div>
                {{-- end of that --}}
            </div>

        </div>
    </section>


    <!-- ======= Team Section ======= -->
        <!--<section id="team">-->
        <!--  <div class="container" data-aos="fade-up">-->
        <!--    <div class="section-header">-->
        <!--      <h2>Our Team</h2>-->
        <!--    </div>-->
        <!--    <div class="row">-->
        <!--      <div class="col-lg-3 col-md-6">-->
        <!--        <div class="member">-->
        <!--          <div class="pic"><img src="{{ asset('template1/img/team-1.jpg') }}" alt=""></div>-->
        <!--          <div class="details">-->
        <!--            <h4>Walter White</h4>-->
        <!--            <span>Chief Executive Officer</span>-->
        <!--            <div class="social">-->
        <!--              <a href=""><i class="bi bi-twitter"></i></a>-->
        <!--              <a href=""><i class="bi bi-facebook"></i></a>-->
        <!--              <a href=""><i class="bi bi-instagram"></i></a>-->
        <!--              <a href=""><i class="bi bi-linkedin"></i></a>-->
        <!--            </div>-->
        <!--          </div>-->
        <!--        </div>-->
        <!--      </div>-->

        <!--      <div class="col-lg-3 col-md-6">-->
        <!--        <div class="member">-->
        <!--          <div class="pic"><img src="{{ asset('template1/img/team-2.jpg') }}" alt=""></div>-->
        <!--          <div class="details">-->
        <!--            <h4>Sarah Jhinson</h4>-->
        <!--            <span>Product Manager</span>-->
        <!--            <div class="social">-->
        <!--              <a href=""><i class="bi bi-twitter"></i></a>-->
        <!--              <a href=""><i class="bi bi-facebook"></i></a>-->
        <!--              <a href=""><i class="bi bi-instagram"></i></a>-->
        <!--              <a href=""><i class="bi bi-linkedin"></i></a>-->
        <!--            </div>-->
        <!--          </div>-->
        <!--        </div>-->
        <!--      </div>-->

        <!--      <div class="col-lg-3 col-md-6">-->
        <!--        <div class="member">-->
        <!--          <div class="pic"><img src="{{ asset('template1/img/team-3.jpg') }}" alt=""></div>-->
        <!--          <div class="details">-->
        <!--            <h4>William Anderson</h4>-->
        <!--            <span>CTO</span>-->
        <!--            <div class="social">-->
        <!--              <a href=""><i class="bi bi-twitter"></i></a>-->
        <!--              <a href=""><i class="bi bi-facebook"></i></a>-->
        <!--              <a href=""><i class="bi bi-instagram"></i></a>-->
        <!--              <a href=""><i class="bi bi-linkedin"></i></a>-->
        <!--            </div>-->
        <!--          </div>-->
        <!--        </div>-->
        <!--      </div>-->

        <!--      <div class="col-lg-3 col-md-6">-->
        <!--        <div class="member">-->
        <!--          <div class="pic"><img src="{{ asset('template1/img/team-4.jpg') }}" alt=""></div>-->
        <!--          <div class="details">-->
        <!--            <h4>Amanda Jepson</h4>-->
        <!--            <span>Accountant</span>-->
        <!--            <div class="social">-->
        <!--              <a href=""><i class="bi bi-twitter"></i></a>-->
        <!--              <a href=""><i class="bi bi-facebook"></i></a>-->
        <!--              <a href=""><i class="bi bi-instagram"></i></a>-->
        <!--              <a href=""><i class="bi bi-linkedin"></i></a>-->
        <!--            </div>-->
        <!--          </div>-->
        <!--        </div>-->
        <!--      </div>-->
        <!--    </div>-->

        <!--  </div>-->
    <!--</section>  -->

    <!-- ======= Contact Section ======= -->
    <section id="contact">
        <div class="container" data-aos="fade-up">
            <x-section-header text="{{ $landingSection[5]->section_name }}"/>

            <div class="row contact-info">

                {{-- get contact using ajax --}}
                <div class="col-md-4">
                    <x-template1.list-group-simple icon="bi-geo-alt" id="location" 
                    text="" subtext="" link="" class="contact-address" />
                </div>

                <div class="col-md-4">
                    <x-template1.list-group-simple icon="bi-phone" id="phone" 
                    text="" subtext="" link="" class="contact-phone" />
                </div>

                <div class="col-md-4">
                    <x-template1.list-group-simple icon="bi-envelope" id="email" 
                    text="" subtext="" link="" class="contact-email" />
                </div>
                {{-- end of that --}}
                
            </div>
        </div>

        <div class="container mb-4">
            {!! $aboutUs->address_embed !!}
        </div>
    </section><!-- End Contact Section -->
</main><!-- End #main -->
@endsection
