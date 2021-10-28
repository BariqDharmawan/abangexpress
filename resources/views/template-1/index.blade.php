@extends('layouts.template-1')

@section('title', $ourName)

@section('content')

@if (session('error'))
    <x-alert-danger class="mb-0 text-center" />
@endif

<section id="hero">
    <div class="hero-content row mx-0" data-aos="fade-up">
        @include('partials.search-tracking', ['errorText' => 'danger'])
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

    @if (session('trackingstatus'))
        @include('partials.result-tracking', ['templateUsing' => 1])
    @endif

    <!-- ======= About Section ======= -->
    <section id="about">
        <div class="container" data-aos="fade-up" id="fade-up-about">
            <div class="row">
                <div class="col-lg-6 about-img">
                    @isset($aboutUs)
                    <img src="{{ asset('storage/' .
                    str_replace('public/', '', $aboutUs->cover_vision_mission)) }}" alt="">
                    @endisset
                </div>

                <div class="col-lg-6 content">
                    <x-section-header text="{{ $landingSection[0]->section_name }}"
                    desc="{!! $landingSection[0]->first_desc !!}" />
                    <div class="row mt-4">
                        @isset($aboutUs)
                            <div class="col-lg">
                                <h5 class="fw-bold text-primary">Visi Kami</h5>
                                <p>{{ $aboutUs->our_vision }}</p>
                            </div>
                            <div class="col-lg">
                                <h5 class="fw-bold text-primary">Misi Kami</h5>
                                {!! $aboutUs->our_mission  !!}
                            </div>
                        @endisset
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
                            <img src="{{ asset('storage/' .
                            str_replace('public/', '', $team->avatar)) }}"
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
            class="text-white text-center no-before" />

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
            @isset($aboutUs)
                {!! $aboutUs->address_embed !!}
            @endisset
        </div>
    </section><!-- End Contact Section -->
</main><!-- End #main -->
@endsection
