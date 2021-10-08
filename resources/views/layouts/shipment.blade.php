<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.meta', ['prefixTitle' => 'Shipment'])
    <link rel="stylesheet" href="{{ asset('shipment/css/app.css') }}">
    @stack('style-plugins')
</head>
<body class="theme-red">
    @include('partials.preload-shipment')

    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">
                    ADMINBSB - MATERIAL DESIGN
                </a>
            </div>
        </div>
    </nav>

    <section>
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="{{ asset('shipment/img/user.png') }}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">John Doe</div>
                    <div class="email">john.doe@example.com</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <x-shipment.dropdown-item text="Profile" icon="person" />
                            <x-shipment.dropdown-item text="Followers" icon="group" />
                            <x-shipment.dropdown-item text="Sales" 
                            icon="shopping_cart" />
                            <x-shipment.dropdown-item text="Likes" icon="favorite" />
                            <x-shipment.dropdown-item text="Sign Out" icon="input" />
                        </ul>
                    </div>
                </div>
            </div>

            <div class="menu">
                <ul class="list">
                    <x-shipment.dropdown-item class="active" text="Home"
                    icon="home" href="{{ route('admin.shipment.index') }}" />

                    <x-shipment.dropdown-item text="Typography"
                    icon="text_fields" href="{{ route('admin.shipment.index') }}" />

                    <x-shipment.dropdown-item text="Helper Classes"
                    icon="layers" href="{{ route('admin.shipment.index') }}" />

                    <x-shipment.dropdown-item text="User Interface (UI)"
                    icon="swap_calls" :is-dropdown="true">
                        <x-shipment.dropdown-item href="/alert" text="Alerts" />
                    </x-shipment.dropdown-item>

                    <x-shipment.dropdown-item text="widgets" :is-dropdown="true" 
                    icon="widgets">
                        <x-shipment.dropdown-item text="Cards" :is-dropdown="true">
                            <x-shipment.dropdown-item href="/alert" text="Basic" />
                            <x-shipment.dropdown-item href="/alert" text="Colored" />
                        </x-shipment.dropdown-item>
                        <x-shipment.dropdown-item text="Typography"
                        href="{{ route('admin.shipment.index') }}" />
                    </x-shipment.dropdown-item>
                </ul>
            </div>
            
            <div class="legal">
                <div class="copyright">
                    <small>&copy; {{ date('Y') }}</small>
                    <a href="javascript:void(0);">{{ config('app.name') }}</a>.
                </div>
            </div>
        </aside>

    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>@yield('title')</h2>
            </div>
            @yield('content')
        </div>
    </section>
    
    <script src="{{ asset('shipment/template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('shipment/js/vendor.js') }}"></script>
    <script src="{{ asset('shipment/js/app.js') }}"></script>

    @stack('scripts')
    @yield('components')
</body>
</html>