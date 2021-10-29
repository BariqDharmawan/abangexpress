<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.meta', ['prefixTitle' => 'Admin'])
    <link rel="stylesheet" href="{{ asset('admin/css/app.css') }}">
    @stack('style-plugins')
</head>
<body class="sidebar-toggled">
    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-red sidebar sidebar-dark accordion toggled" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center"
            href="{{ url('/') }}">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="sidebar-brand-text mx-3">
                    {{ $ourName }}
                </div>
            </a>

            <hr class="sidebar-divider">

            <x-admin.sidebar.menu :href="route('admin.home.index')"
            text="Home" icon="fas fa-home" />

            <x-admin.sidebar.menu text="Edit company profile" class="collapsed"
            data-toggle="collapse" icon="fas fa-building" data-target="#dropdown-edit-company" aria-expanded="true" aria-controls="dropdown-edit-company">
                <x-admin.sidebar.dropdown id="dropdown-edit-company" parent="accordionSidebar">
                    <x-admin.sidebar.link text="Tentang Kami" icon="fas fa-info-circle" :href="route('admin.about-us.identity')" />
                    <x-admin.sidebar.link text="Layanan Kami" icon="fa-fw fa-tachometer-alt" :href="route('admin.service.manage')" />
                    <x-admin.sidebar.link text="Mitra Kami" icon="fas fa-people-carry" :href="route('admin.team.manage')" />
                    <x-admin.sidebar.link text="Tanya Kami" icon="fas fa-question-circle" :href="route('admin.faq.manage')" />
                    <x-admin.sidebar.link text="Kontak Kami" icon="fas fa-phone-alt" :href="route('admin.contact.manage')" />
                    <x-admin.sidebar.link text="Social Media" icon="fas fa-share-alt" :href="route('admin.our-social.manage')" />
                    <x-admin.sidebar.link text="Cabang Kami" icon="fas fa-share-alt" :href="route('admin.branch.index')" />
                </x-admin.sidebar.dropdown>
            </x-admin.sidebar.menu>

            <x-admin.sidebar.menu text="Shipment"
            :href="route('shipping.index')" target="_blank" icon="fas fa-shipping-fast" />

            @if (auth()->user()->role == 'admin')
                <x-admin.sidebar.menu :href="route('admin.user.index')"
                text="Anak cabang" icon="fas fa-users" />
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
                    <button id="sidebarToggleTop"
                    class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ route('admin.home.index') }}"
                            class="nav-link text-dark font-weight-bold">
                                Template: {{ $templateChoosen->version_name }}
                            </a>
                        </li>
                    </ul>
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
                <main class="px-2">
                    @yield('content')
                </main>
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
