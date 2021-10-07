<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.meta', ['prefixTitle' => 'Template 1'])
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
    @yield('content')
    <footer id="footer">
        <div class="container py-4">
            <div class="row">

                <div class="col-lg footer-links text-center">
                    <h4>Our Social Networks</h4>
                    <div class="social-links mt-3">
                        @foreach ($ourSocial as $social)
                        <a href="{{ $social->link }}" class="h2 @if(!$loop->last) me-2 @endif">
                            <i class="{{ $social->icon }}"></i>
                        </a>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright 
                <strong class="text-capitalize">
                    {{ $ourName . ' ' . date('Y') }}
                </strong>. All Rights Reserved
            </div>
            <div class="credits d-none">
                Designed by <a href="#">Pastigo</a>
            </div>
        </div>
    </footer>

    @include('partials.btn-back-to-top')
    @include('partials.scripts', ['path' => 'template1'])
</body>

</html>
