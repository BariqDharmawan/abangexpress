@extends('layouts.template-1')

@section('title', $ourName)

@section('content')

<section id="hero">
    <div class="hero-content row mx-0" data-aos="fade-up">
        <h2 class="w-100">{!! wordwrap($aboutUs->slogan, 20, '<br>') !!}</h2>
        <form method="GET" class="col-lg-8">
            @csrf
            <div class="row align-items-center justify-content-center position-relative">
                <div class="col-12">
                    <input type="text" class="form-control py-3 ps-lg-4 py-lg-4 shadow input--btn-inside" minlength="11" maxlength="11"
                    placeholder="Ketik nomor resi disini" required>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary 
                    btn--inside-input py-lg-2">
                        <i class="fas fa-search"></i>
                        <span class="d-none d-lg-block" style="margin-left: 10px">
                            Cari resi
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="hero-slider swiper-container">
        <div class="swiper-wrapper">
            @foreach ($heroCarousel as $carousel)
                <div class="swiper-slide" 
                style="background-image: url('{{ asset($carousel->img) }}"></div>    
            @endforeach
        </div>
    </div>
</section>

<main id="main">
    <section>
        <div class="container" data-aos="fade-up">
            <x-section-header text="Hasil pencarian" />
            <div class="row panel-scroll border p-3">
                <ul class="col-lg-3">
                    @for ($i = 0; $i < 4; $i++)
                    <li class="panel-scroll__item {{ $i == 0 ? 'current-day' : '' }}">
                        <time datetime="{{ date('d M Y H:i') }}" class="fw-bold">
                            {{ date('d M Y - H:i') }}
                        </time>
                    </li>
                    @endfor
                </ul>
                <ul class="col-lg-9">
                    @for ($i = 0; $i < 4; $i++)
                        <li class="panel-scroll__text px-5">
                            <p class="mb-1">
                                Shipment Received at Warehouse Origin Facility.
                            </p>
                            <address class="m-0">
                                Jl. Condet Raya No.27 B, RT.5/RW.3, Balekambang, Kec. Kramat jati, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13530
                            </address>
                        </li>
                    @endfor
                </ul>
            </div>
        </div>
    </section>
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
                <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="box d-flex align-items-center">
                        <span class="h1">
                            <i class="{{ $service->icon }}"></i>
                        </span>
                        <div>
                            <h4 class="title">{{ $service->title }}</h4>
                            <p class="description">{{ $service->desc }}</p>
                        </div>
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
                    <p class="cta-text">{!! $landingSection[2]->first_desc !!}</p>
                </div>
                <div class="col-lg-3 cta-btn-container text-center">
                    <a class="cta-btn align-middle" href="#" id="cta-email">CTA</a>
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
                                <img src="{{ asset(
                                    'template1/img/quote-sign-left.png'
                                ) }}" class="quote-sign-left" alt="">
                                <span>{{ $team->short_desc }}</span>
                                <img src="{{ asset(
                                    'template1/img/quote-sign-right.png'
                                ) }}" class="quote-sign-right" alt="">
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
                    <a class="accordion-button accordion__heading collapsed toggler-accordion" type="button" data-bs-toggle="collapse"
                    data-bs-target="#accordion-list" aria-expanded="false" 
                    aria-controls="accordion-list"></a>
                    <div id="accordion-list" 
                        class="collapse accordion__text" 
                        aria-labelledby="flush-faq"
                        data-bs-parent="#load-faq">
                        <div class="accordion-body">
                            <p></p>
                        </div>
                    </div>
                </div>
                {{-- end of that --}}
            </div>

        </div>
    </section>

    <!-- ======= Contact Section ======= -->
    <section id="contact">
        <div class="container" data-aos="fade-up">
            <x-section-header text="{{ $landingSection[5]->section_name }}"/>

            <div class="row contact-info">

                {{-- get contact using ajax --}}
                <div class="col-md-4">
                    <x-template1.list-group-simple icon="bi-geo-alt" id="location" 
                    text="" subtext="" link="" class="contact-address" subtext-class="contact-value" />
                </div>

                <div class="col-md-4">
                    <x-template1.list-group-simple icon="bi-phone" id="phone" 
                    text="" subtext="" link="" class="contact-phone" subtext-class="contact-value" />
                </div>

                <div class="col-md-4">
                    <x-template1.list-group-simple icon="bi-envelope" id="email" 
                    text="" subtext="" link="" class="contact-email" subtext-class="contact-value" />
                </div>
                {{-- end of that --}}
                
            </div>
        </div>

        <div class="container mb-4 embeded-full">
            {!! $aboutUs->address_embed !!}
        </div>
    </section><!-- End Contact Section -->
</main><!-- End #main -->
@endsection
