@extends('layouts.template-2')

@section('title', $ourName)

@section('content')

@if (session('error'))
    <x-alert-danger class="mb-0 text-center position-fixed left-1/2 top-60px" />
@endif

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                <h1>{!! wordwrap($aboutUs->slogan, 20, '<br>') !!}</h1>
                <h2>{{ $aboutUs->sub_slogan }}</h2>
                @include('partials.search-tracking', ['errorText' => 'pink'])
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img position-relative" 
            data-aos="zoom-in" data-aos-delay="200">
                @if ($isProfileVideoExist)
                    <a href="{{ $aboutUs->our_video }}"
                    class="glightbox btn-watch-video hero-img__btn-center">
                        <i class="bi bi-play-circle me-0"></i>
                    </a>
                @endif
                <img src="{{ asset('template2/img/hero-img.png') }}"
                class="img-fluid animated" alt="">
            </div>
        </div>
    </div>

</section>

<main id="main">

    @if (session('trackingstatus'))
        @include('partials.result-tracking', ['templateUsing' => 2])
    @endif

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <x-template2.section-title 
            heading="{{ $landingSection[0]->section_name }}" />`

            <div class="content row">
                <div class="col-lg-6">
                    {!! $landingSection[0]->first_desc !!}
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0">
                    {!! $landingSection[0]->second_desc !!}
                    <a href="#" class="btn-learn-more">Learn More</a>
                </div>
            </div>

        </div>
    </section>

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us section-bg">
        <div class="container-fluid" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

                    <div class="content mb-4">
                        <h3><strong>VISI & MISI KAMI</strong></h3>
                    </div>

                    <div class="accordion-list">
                        <ul id="load-vision-mission">

                            <x-template2.accordion-list
                            heading="Visi Kami" icon-title="bx-help-circle icon-help"
                            parent-list="accordion-list" :is-open="true">
                                <p>{{ $aboutUs->our_vision }}</p>
                            </x-template2.accordion-list>

                            <x-template2.accordion-list
                            heading="Misi Kami" icon-title="bx-help-circle icon-help"
                            parent-list="accordion-list">
                                {!! $aboutUs->our_mission !!}
                            </x-template2.accordion-list>

                        </ul>
                    </div>

                </div>

                <div class="col-lg-5 order-1 order-lg-2 align-items-stretch d-flex"
                data-aos="zoom-in" data-aos-delay="150">
                    <div class="img w-100 rounded" style='background-image: url(
                        "{{ asset($aboutUs->cover_vision_mission) }}"
                    );height: 100%'></div>
                </div>
            </div>

        </div>
    </section>

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
        <div class="container" data-aos="fade-up">

            <x-template2.section-title heading="{{ $landingSection[1]->section_name }}" />

            <div class="row" id="load-our-service">
                
                @foreach ($ourService as $service)
                <div class="col-xl-3 col-md-6 d-flex align-items-stretch mb-5"
                data-aos="zoom-in" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="icon-box w-100">
                        <i class="{{ $service->icon }} h1"></i>
                        <h4 class="card__name text-capitalize mt-2">{{ $service->title }}</h4>
                        <p class="card__short-desc">{{ $service->desc }}</p>
                    </div>
                </div>
                @endforeach
                
            </div>

        </div>
    </section>

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
        <div class="container" data-aos="zoom-in">

            <div class="row">
                <div class="col-lg-9 text-center text-lg-start">
                    <h2 class="text-white">{{ $landingSection[2]->section_name }}</h2>
                    <p>{!! $landingSection[2]->first_desc !!}</p>
                </div>
                <div class="col-lg-3 cta-btn-container text-center">
                    <a class="cta-btn align-middle" id="cta-email">
                        Email To Action
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
        <div class="container" data-aos="fade-up">

            <x-template2.section-title heading="{{ $landingSection[3]->section_name }}"
            desc="Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas." />

            <div class="row">

                @foreach ($ourTeam as $team)
                <div class="col-lg-6 mb-4 member-item">
                    <div class="member d-flex align-items-start"
                    data-aos="zoom-in" data-aos-delay="{{ 100 * $loop->iteration }}">
                        <div class="pic">
                            <img src="{{ $team->avatar }}" alt=""
                            class="img-fluid member-info__avatar" />
                        </div>
                        <div class="member-info">
                            <h4 class="member-info__name">{{ $team->name }}</h4>
                            <span class="member-info__position">
                                {{ $team->position->name }}
                            </span>
                            <p class="member-info__desc">{{ $team->short_desc }}</p>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

        </div>
    </section>

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
        <div class="container" data-aos="fade-up">

            <x-template2.section-title heading="{{ $landingSection[4]->section_name }}" />

            <div class="faq-list">
                <ul id="load-faq">
                    {{-- get faq using ajax [this is shadow element] --}}
                    <x-template2.accordion-list class="accordion-faq"
                    heading="" parent-list="accordion-list"
                    icon-title="bx-help-circle icon-help" parent-list="faq-list">
                        <p></p>
                    </x-template2.accordion-list>
                    {{-- end of that --}}
                </ul>
            </div>

        </div>
    </section>

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <x-template2.section-title heading="{{ $landingSection[5]->section_name }}" />

            <div class="row">

                <div class="col-lg-6 d-flex align-items-stretch">
                    <ul class="info">
                        <li id="location">
                            <i class="bi bi-geo-alt"></i>
                            <h4 class="list-group-simple__text">Location</h4>
                            <p class="list-group-simple__subtext">
                                <a href="https://goo.gl/maps/rqzr6U6AZnDLdedQ6" target="__blank"></a>
                            </p>
                        </li>
                        <li id="email">
                            <i class="bi bi-envelope"></i>
                            <h4 class="list-group-simple__text">Email</h4>
                            <p class="list-group-simple__subtext">
                                <a href="mailto:" target="__blank"></a>
                            </p>
                        </li>
                        <li id="phone">
                            <i class="bi bi-phone"></i>
                            <h4 class="list-group-simple__text">Call</h4>
                            <p class="list-group-simple__subtext">
                                <a href="tel:" target="__blank"></a>
                            </p>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-6 d-flex align-items-stretch shadow embeded-full">
                    {!! $aboutUs->address_embed !!}
                </div>
            </div>

        </div>
    </section>

</main>
@endsection
