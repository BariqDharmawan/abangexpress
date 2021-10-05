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
        
            <x-admin.sidebar-menu text="About Us" icon="fa-fw fa-cog" 
            data-toggle="collapse" data-target="#collapseAbout"
            aria-expanded="true" aria-controls="collapseAbout"
            class="collapsed">
        
                <x-admin.sidebar-dropdown id="collapseAbout" parent="accordionSidebar">
                    <x-admin.sidebar-dropdown-link text="Identity" 
                    :href="route('admin.about-us.identity')" />
        
                    <x-admin.sidebar-dropdown-link text="Social Media" 
                    :href="route('admin.our-social.manage')" />
        
                    <x-admin.sidebar-dropdown-link text="Contacts" 
                    :href="route('admin.contact.manage')" />
        
                </x-admin.sidebar-dropdown>
        
            </x-admin.sidebar-menu>
        
            <x-admin.sidebar-menu text="Contents" class="collapsed" data-toggle="collapse" 
            icon="fa-fw fa-cog" data-target="#collapseContent" 
            aria-expanded="true" aria-controls="collapseContent">
        
                <x-admin.sidebar-dropdown id="collapseContent" parent="accordionSidebar">
                    
                    <x-admin.sidebar-dropdown-link text="Header Carousel" 
                    :href="route('admin.content.landing-carousel.index')" />
        
                    <x-admin.sidebar-dropdown-link text="Cover Vision Mission" 
                    :href="route('admin.content.cover-vision-mission.index')" />
        
                    <x-admin.sidebar-dropdown-link text="Section Heading Text" 
                    :href="route('admin.content.section-heading.index')" />
            
                </x-admin.sidebar-dropdown>
        
            </x-admin.sidebar-menu>
        
            <x-admin.sidebar-menu :href="route('admin.service.manage')" 
            text="Services" icon="fa-fw fa-tachometer-alt" />
        
            <x-admin.sidebar-menu :href="route('admin.team.manage')" 
            text="Teams" icon="fa-fw fa-tachometer-alt" />
        
            <x-admin.sidebar-menu :href="route('admin.faq.manage')" 
            text="FAQ" icon="fa-fw fa-tachometer-alt" />
        
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
        
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 
                static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->username }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset('admin/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <a class="dropdown-item" href="javascript:void(0);" 
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                        <i class="fas fa-sign-out-alt 
                                        fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                @yield('content')
            </div>
            @include('admin.partials.footer')
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