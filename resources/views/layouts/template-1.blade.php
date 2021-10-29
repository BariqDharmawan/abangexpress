<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.meta')
    @include('partials.styles', ['path' => 'template1'])
</head>

<body>
    <section id="topbar" class="d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center" id="nav-email">
                    <a href="" class="contact-value"></a>
                </i>
                <i class="bi bi-phone d-flex align-items-center ms-4" id="nav-telephone">
                    <a href="" class="contact-value"></a>
                </i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                @foreach ($ourSocial as $social)
                <a href="{{ $social->link }}">
                    <i class="{{ $social->icon }}"></i>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex justify-content-between">

            <div id="logo">
                <h1 class="fs-3">
                    @isset($aboutUs)
                    <a href="{{ url('/') }}">
                        {{ strtok($aboutUs->our_name, ' ') }}
                        <span>
                            {{ Str::after(
                                $aboutUs->our_name, strtok($aboutUs->our_name, ' ')
                            ) }}
                        </span>
                    </a>
                    @endisset
                </h1>
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    @foreach ($menus as $menu)
                        <x-template1.nav-link
                        href="{{ $menu->url }}" text="{{ $menu->text }}"
                        class="nav-link scrollto {{ $loop->first ? 'active' : '' }}" />
                    @endforeach

                    <x-template1.nav-link
                    text="{{ auth()->check() ? 'Go to dashboard' : 'Masuk' }}"
                    href="{{ route('login') }}"
                    class="btn btn--outline-dark-blue text-dark-blue text-center
                    mx-4 py-2 px-4 rounded-pill" />

                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header>
    @yield('content')
    <footer id="footer">
        <div class="container py-4">
            <div class="row">

                <div class="col-lg footer-links text-center">
                    <h4>Our Social Networks</h4>
                    <div class="social-links mt-3">
                        @include('partials.our-social')
                    </div>
                </div>

            </div>
        </div>

        <div class="container">
            <div class="copyright">
                @include('partials.copyright')
            </div>
            <div class="credits d-none">
                Designed by <a href="#">Pastigo</a>
            </div>
        </div>
    </footer>

    @include('partials.btn-back-to-top', ['style' => 'green'])
    @include('partials.scripts', ['path' => 'template1'])
</body>

</html>
