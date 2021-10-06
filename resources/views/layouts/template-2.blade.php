<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.meta', ['prefixTitle' => 'Template 2'])
    @include('partials.styles', ['path' => 'template2'])
</head>
<body>
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center">
    
            <h1 class="logo me-auto">
                <a href="index.html">{{ $ourName }}</a>
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

                    <li>
                        <a class="getstarted scrollto" href="{{ route('login') }}">
                            Masuk
                        </a>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
    
        </div>
    </header>
    @yield('content')
    @include('partials.btn-back-to-top')
    @include('partials.scripts', ['path' => 'template2'])
</body>
</html>