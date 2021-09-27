@extends('layouts.template-2')
@section('content')
    <!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                <h1>Better Solutions For Your Business</h1>
                <h2>We are team of talented designers making websites with Bootstrap</h2>
                <div class="d-flex justify-content-center justify-content-lg-start">
                    <a href="#about" class="btn-get-started scrollto">Get Started</a>
                    <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" 
                    class="glightbox btn-watch-video">
                        <i class="bi bi-play-circle"></i>
                        <span>Watch Video</span>
                    </a>
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
                @for ($i = 0; $i < 4; $i++)
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
                @endfor
            </div>

        </div>
    </section>

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
        <div class="container" data-aos="zoom-in">

            <div class="row">
                <div class="col-lg-9 text-center text-lg-start">
                    <h3>HUBUNGI KAMI</h3>
                    <p> 
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit 
                        anim id est laborum.
                    </p>
                </div>
                <div class="col-lg-3 cta-btn-container text-center">
                    <a class="cta-btn align-middle" href="#">Email To Action</a>
                </div>
            </div>

        </div>
    </section>

    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
        <div class="container" data-aos="fade-up">

            <x-template2.section-title heading="TEAM KAMI" desc="Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas." />

            <div class="row">

                @for ($i = 0; $i < 4; $i++)
                <div class="col-lg-6 mb-4">
                    <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
                        <div class="pic">
                            <img src="{{ asset(
                                'uploaded/dummy/team/team-' . $i + 1 . '.jpg'
                            ) }}" class="img-fluid" alt=""></div>
                        <div class="member-info">
                            <h4>Walter White</h4>
                            <span>Chief Executive Officer</span>
                            <p>Explicabo voluptatem mollitia et repellat qui dolorum quasi</p>
                            <div class="social">
                                <a href=""><i class="ri-twitter-fill"></i></a>
                                <a href=""><i class="ri-facebook-fill"></i></a>
                                <a href=""><i class="ri-instagram-fill"></i></a>
                                <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>                    
                @endfor

            </div>

        </div>
    </section>

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
        <div class="container" data-aos="fade-up">

            <x-template2.section-title heading="FAQ" />

            <div class="faq-list">
                <ul>
                    @for ($i = 0; $i < 5; $i++)
                    <x-template2.accordion-list 
                    heading="{{ $i }} Non consectetur a erat nam at lectus urna duis? " parent-list="accordion-list" 
                    icon-title="bx-help-circle icon-help" parent-list="faq-list">
                        <p>
                            {{ $i }} Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                        </p>
                    </x-template2.accordion-list>
                    @endfor
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
                    <div class="info">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Location:</h4>
                            <p>{{ $ourContact->address }}</p>
                        </div>

                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p>
                                <a href="mailto:{{ $ourContact->email }}">
                                    {{ $ourContact->email }}
                                </a>
                            </p>
                        </div>

                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>Call:</h4>
                            <p>+62 {{ $ourContact->telephone }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 d-flex align-items-stretch shadow">
                    {!! $aboutUs->address_embed !!}
                </div>
            </div>

        </div>
    </section>

</main>
@endsection