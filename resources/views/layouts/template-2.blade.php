<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.meta')
    @include('partials.styles', ['path' => 'template2'])
</head>

<body class="@yield('single-page')">
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto">
                <a href="{{ url('/') }}">{{ $ourName }}</a>
            </h1>

            <nav id="navbar" class="navbar">
                <ul>
                    @foreach ($menus as $menu)
                    <li>
                        <a class="nav-link scrollto @if($loop->first) active @endif" href="{{ $menu->url }}">
                            {{ $menu->text }}
                        </a>
                    </li>
                    @endforeach

                    @guest
                    <li>
                        <a class="getstarted scrollto" href="{{ route('login') }}">
                            Masuk
                        </a>
                    </li>
                    @else
                    <li>
                        <a class="getstarted scrollto" href="{{ route('admin.about-us.identity') }}">
                            Go to dashboard
                        </a>
                    </li>
                    @endguest
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>

        </div>
    </header>

    @yield('content')

    @include('partials.btn-back-to-top', ['style' => 'blue'])
    @include('partials.scripts', ['path' => 'template2'])

    <footer>
        <div class="container d-flex flex-column align-items-center">
            <p class="text-white h3 mb-0">Our Social Network</p>
            <div class="my-4">
                @include('partials.our-social')
            </div>
            <small class="text-white">
                @include('partials.copyright')
            </small>
        </div>
    </footer>
</body>

</html>
