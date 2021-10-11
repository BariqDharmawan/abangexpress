<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.meta', ['prefixTitle' => 'Admin'])
    <link rel="stylesheet" href="{{ asset('admin/css/app.css') }}">
    @stack('style-plugins')
</head>
<body>
    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" 
            href="{{ route('admin.about-us.identity') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">
                    {{ $ourName }}
                </div>
            </a>
        
            <hr class="sidebar-divider">
        
            <x-admin.sidebar.menu text="About Us" icon="fa-fw fa-cog" 
            data-toggle="collapse" data-target="#collapseAbout"
            aria-expanded="true" aria-controls="collapseAbout"
            class="collapsed">
        
                <x-admin.sidebar.dropdown id="collapseAbout" parent="accordionSidebar">
                    <x-admin.sidebar.link text="Identity" 
                    :href="route('admin.about-us.identity')" />
        
                    <x-admin.sidebar.link text="Social Media" 
                    :href="route('admin.our-social.manage')" />
        
                    <x-admin.sidebar.link text="Contacts" 
                    :href="route('admin.contact.manage')" />
        
                </x-admin.sidebar.dropdown>
        
            </x-admin.sidebar.menu>
        
            <x-admin.sidebar.menu text="Contents" class="collapsed" data-toggle="collapse" 
            icon="fa-fw fa-cog" data-target="#collapseContent" 
            aria-expanded="true" aria-controls="collapseContent">
        
                <x-admin.sidebar.dropdown id="collapseContent" parent="accordionSidebar">
                    
                    <x-admin.sidebar.link text="Header Carousel" 
                    :href="route('admin.content.landing-carousel.index')" />
        
                    <x-admin.sidebar.link text="Cover Vision Mission" 
                    :href="route('admin.content.cover-vision-mission.index')" />
        
                    <x-admin.sidebar.link text="Section Heading Text" 
                    :href="route('admin.content.section-heading.index')" />
            
                </x-admin.sidebar.dropdown>
        
            </x-admin.sidebar.menu>
        
            <x-admin.sidebar.menu :href="route('admin.service.manage')" 
            text="Services" icon="fa-fw fa-tachometer-alt" />
        
            <x-admin.sidebar.menu :href="route('admin.team.manage')" 
            text="Teams" icon="fa-fw fa-tachometer-alt" />
        
            <x-admin.sidebar.menu :href="route('admin.faq.manage')" 
            text="FAQ" icon="fa-fw fa-tachometer-alt" />

            @if (auth()->user()->role == 'admin')
            <x-admin.sidebar.menu :href="route('admin.user.index')" 
            text="User" icon="fa-fw fa-tachometer-alt" />
            @endif
        
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
        
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light 
                bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" 
                    class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span 
                                class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ Auth::user()->username }}
                                </span>
                                <img class="img-profile rounded-circle" 
                                src="{{ asset('admin/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                @if (!Str::contains(url()->current(), 'shipment'))
                                <a class="dropdown-item" 
                                href="{{ route('shipping.index') }}">
                                    Shipment
                                </a>
                                @else
                                <a class="dropdown-item" 
                                href="{{ route('admin.about-us.identity') }}">
                                    Company Profile
                                </a>
                                @endif
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item" type="submit">
                                        <i class="fas fa-sign-out-alt 
                                        fa-sm fa-fw mr-2"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                @yield('content')
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>
                            Copyright &copy; {{ $ourName . ' ' . date('Y') }}
                        </span>
                    </div>
                </div>
            </footer>            
        </div>
        @include('admin.partials.btn-back-to-top')
    </div>

    <script src="{{ asset('admin/template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/vendor.js') }}"></script>
    <script src="{{ asset('admin/js/app.js') }}"></script>

    @stack('scripts')
    @yield('components')
</body>
</html>