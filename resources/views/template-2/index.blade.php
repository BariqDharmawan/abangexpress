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
                @isset($aboutUs)
                <h1>{!! wordwrap($aboutUs->slogan, 20, '<br>') !!}</h1>
                @endisset
                @include('partials.search-tracking', ['errorText' => 'pink'])
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img position-relative"
            data-aos="zoom-in" data-aos-delay="200">
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
            heading="{{ $sectionTitle->about_us }}" />`

            <div class="content row">
                <div class="col-lg-6">
                    {!! $sectionDesc->first_desc_about_us !!}
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0">
                    {!! $sectionDesc->second_desc_about_us !!}
                </div>
            </div>

        </div>
    </section>

    <!-- ======= Why Us Section ======= -->
    @isset($aboutUs)
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
                                heading="Visi Kami"
                                parent-list="accordion-list" :is-open="true">
                                    <p>{{ $aboutUs->our_vision }}</p>
                                </x-template2.accordion-list>

                                <x-template2.accordion-list
                                heading="Misi Kami"
                                parent-list="accordion-list">
                                    {!! $aboutUs->our_mission !!}
                                </x-template2.accordion-list>

                        </ul>
                    </div>

                </div>

                @isset($aboutUs)
                    <div class="col-lg-5 order-1 order-lg-2 align-items-stretch d-flex"
                    data-aos="zoom-in" data-aos-delay="150">
                        <div class="img w-100 rounded" style='background-image: url(
                            "{{ asset('storage/' . str_replace('public/', '', $aboutUs->cover_vision_mission)) }}"
                        );height: 100%'></div>
                    </div>
                @endisset

            </div>

        </div>
    </section>
    @endisset

    <!-- ======= Services Section ======= -->
    @if (count($ourService) > 0)
    <section id="services" class="services section-bg">
        <div class="container" data-aos="fade-up">

            <x-template2.section-title heading="{{ $sectionTitle->our_service }}" />

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
    @endif

    <!-- ======= Team Section ======= -->
    @if (count($ourTeam) > 0)
    <section id="team" class="team section-bg">
        <div class="container" data-aos="fade-up">

            <x-template2.section-title
            heading="{{ $sectionTitle->our_team }}" />

            <div class="row">
                @foreach ($ourTeam as $team)
                <div class="col-lg-6 mb-4 member-item">
                    <div class="member d-flex align-items-start"
                    data-aos="zoom-in" data-aos-delay="{{ 100 * $loop->iteration }}">
                        <div class="pic">
                            <img height="180px" width="180px"
                            src="{{ asset($team->avatar) }}" alt=""
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
    @endif

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
        <div class="container" data-aos="fade-up">

            <x-template2.section-title heading="{{ $sectionTitle->faq }}" />

            <div class="faq-list">
                <ul id="load-faq">
                    @foreach ($faqs as $faq)
                        <x-template2.accordion-list class="accordion-faq"
                        heading="{{ $faq->question }}"
                        icon-title="bx-help-circle icon-help" parent-list="faq-list">
                            <p>{{ $faq->answer }}</p>
                        </x-template2.accordion-list>
                    @endforeach
                </ul>
            </div>

        </div>
    </section>

    <!-- ======= Contact Section ======= -->
    @include('template-2.contact')

</main>
@endsection
