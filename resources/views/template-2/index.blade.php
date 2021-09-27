@extends('layouts.template-2')

@section('content')
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                <h1>{!! wordwrap($aboutUs->slogan, 20, '<br>') !!}</h1>
                <h2>{{ $aboutUs->sub_slogan }}</h2>
                <div class="d-flex justify-content-center justify-content-lg-start">
                    <a href="#about" class="btn-get-started scrollto">Get Started</a>
                    @if ($isProfileVideoExist)
                    <a href="{{ $aboutUs->our_video }}" 
                    class="glightbox btn-watch-video">
                        <i class="bi bi-play-circle"></i>
                        <span>Watch Video</span>
                    </a>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                <img src="{{ asset('template2/img/hero-img.png') }}" 
                class="img-fluid animated" alt="">
            </div>
        </div>
    </div>

</section>

<main id="main">

    <!-- ======= Cliens Section ======= -->
    <section id="cliens" class="cliens section-bg">
        <div class="container">

            <div class="row" data-aos="zoom-in">

                @for ($i = 0; $i < 6; $i++)
                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('uploaded/dummy/clients/client-' . $i + 1 . '.png') }}" 
                    class="img-fluid" alt="">
                </div>
                @endfor

            </div>

        </div>
    </section>

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <x-template2.section-title heading="TENTANG KAMI" />`

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
                        <ul>
                            <x-template2.accordion-list heading="VISI KAMI" parent-list="accordion-list">
                                <p>
                                    Feugiat pretium nibh ipsum consequat. Tempus 
                                    iaculis urna id volutpat lacus laoreet non 
                                    curabitur gravida. Venenatis lectus magna 
                                    fringilla urna porttitor rhoncus dolor purus non.
                                </p>
                            </x-template2.accordion-list>

                            <x-template2.accordion-list heading="MISI KAMI"
                            parent-list="accordion-list">
                                <ul>
                                    @for ($i = 0; $i < 3; $i++)
                                        <li>Misi {{ $i + 1 }}</li>
                                    @endfor
                                </ul>
                            </x-template2.accordion-list>

                        </ul>
                    </div>

                </div>

                <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url(
                    "{{ asset('template2/img/why-us.png') }}"
                );'
                data-aos="zoom-in" data-aos-delay="150"></div>
            </div>

        </div>
    </section>

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
        <div class="container" data-aos="fade-up">

            <x-template2.section-title heading="LAYANAN KAMI" />

            <div class="row">
                {{-- @for ($i = 0; $i < 4; $i++) --}}
                <div class="col-xl-3 col-md-6 d-flex align-items-stretch" 
                data-aos="zoom-in" data-aos-delay="{{ ($i + 1) * 100 }}">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bxl-dribbble"></i></div>
                        <h4>
                            <a href="">{{ $i }} Lorem Ipsum</a>
                        </h4>
                        <p>
                            Voluptatum deleniti atque corrupti quos dolores et quas 
                            molestias excepturi
                        </p>
                    </div>
                </div>
                {{-- @endfor --}}
            </div>

        </div>
    </section>

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
        <div class="container" data-aos="zoom-in">

            <div class="row">
                <div class="col-lg-9 text-center text-lg-start">
                    <h2 class="text-white">HUBUNGI KAMI</h2>
                    <p> 
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit 
                        anim id est laborum.
                    </p>
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

            <x-template2.section-title heading="TEAM KAMI" desc="Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas." />

            <div class="row parent-load-data" id="load-member">

                {{-- @foreach ($ourTeam as $team) --}}
                <div class="col-lg-6 mb-4 member-item">
                    <div class="member d-flex align-items-start" 
                    data-aos="zoom-in" data-aos-delay="100">
                        <div class="pic">
                            <img src="" class="img-fluid member-info__avatar" alt="" />
                        </div>
                        <div class="member-info">
                            <h4 class="member-info__name"></h4>
                            <span class="member-info__position"></span>
                            <p class="member-info__desc"></p>
                        </div>
                    </div>
                </div>    
                {{-- @endforeach --}}

            </div>

        </div>
    </section>

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
        <div class="container" data-aos="fade-up">

            <x-template2.section-title heading="FAQ" />

            <div class="faq-list">
                <ul class="parent-load-data" id="load-faq">
                    {{-- get faq using ajax --}}
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

            <x-template2.section-title heading="KONTAK KAMI" />

            <div class="row">

                <div class="col-lg-6 d-flex align-items-stretch">
                    <ul class="info">
                        <x-template2.list-group-simple icon="bi-geo-alt" text="Location" 
                        subtext="" link="https://goo.gl/maps/rqzr6U6AZnDLdedQ6" 
                        id="location" />

                        <x-template2.list-group-simple icon="bi-envelope" 
                        text="Email" subtext="" link="mailto" id="email" />

                        <x-template2.list-group-simple icon="bi-phone" 
                        text="Call" subtext="" link="tel" id="phone" />

                    </ul>
                </div>

                <div class="col-lg-6 d-flex align-items-stretch shadow">
                    {!! $aboutUs->address_embed !!}
                </div>
            </div>

        </div>
    </section>

</main>
@endsection