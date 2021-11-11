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
            <x-section-header text="{{ $sectionTitle->our_service }}"/>

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
            <x-section-header text="{{ $sectionTitle->our_team }}"/>

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

    @if (count($ourBranch) > 0)
    <section id="our-branch">
        <div class="container" data-aos="fade-up">
            <x-section-header text="{{ $sectionTitle->our_branch }}"/>

            <div class="testimonials-slider swiper-container"
            data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">
                    @foreach ($ourBranch as $branch)
                    <div class="swiper-slide h-auto">
                        <div class="card h-full">
                            <div class="card-body text-center">
                                <img src="{{ asset($branch->icon) }}" height="70px"
                                width="70px" alt="{{ $branch->name }}">
                            </div>
                            <div class="card-footer">
                                <p class="card-text mb-3 fw-bold">
                                    {{ $branch->telephone }}
                                </p>
                                <h3 class="card-title fs-5">{{ $branch->name }}</h3>
                                <p>{{ $branch->address }}</p>
                            </div>
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
    @if (count($faqs) > 0)
    <section id="faq" class="faq section-bg my-4 bg-primary">
        <div class="container" data-aos="fade-up">

            <x-section-header text="{{ $sectionTitle->faq }}"
            class="text-white text-center no-before" />

            <div class="accordion accordion-flush shadow p-4 bg-white parent-load-data"
            id="load-faq">
                @foreach ($faqs as $faq)
                <div class="accordion-item accordion-faq">
                    <a class="accordion-button accordion__heading collapsed toggler-accordion"
                    type="button" data-bs-toggle="collapse"
                    data-bs-target="#accordion-list-faq-{{ $loop->iteration }}"
                    aria-expanded="false" aria-controls="accordion-list-faq-{{ $loop->iteration }}">
                        {{ $faq->question }}
                    </a>
                    <div id="accordion-list-faq-{{ $loop->iteration }}"
                        class="collapse accordion__text"
                        aria-labelledby="flush-faq"
                        data-bs-parent="#load-faq">
                        <div class="accordion-body">
                            <p>{{ $faq->answer }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>
    @endif

    <!-- ======= Contact Section ======= -->
    @include('template-1.contact')

</main><!-- End #main -->
@endsection
