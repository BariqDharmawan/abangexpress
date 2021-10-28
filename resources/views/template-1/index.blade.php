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

    <!-- ======= Services Section ======= -->
    @if (count($ourService) > 0)
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
    @endif


    @if (count($ourTeam) > 0)
    <section id="our-team">
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
    @endif

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
    @include('partials.contact')
</main><!-- End #main -->
@endsection
