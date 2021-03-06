<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.meta', ['prefixTitle' => 'Shipment'])
    <link rel="stylesheet" href="{{ mix('shipment/css/app.css') }}">
    @stack('style-plugins')
</head>
<body class="theme-red">
    @include('shipment.preload')

    <nav class="navbar bg-red">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ $ourName }}
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
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ auth()->user()->name }}
                    </div>
                    <div class="email">{{ auth()->user()->username }}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            @if (auth()->user()->role == 'admin')
                            <x-shipment.dropdown-item
                            text="Company Profile" icon="person"
                            href="{{ route('admin.about-us.identity') }}" />
                            @endif
                            <li style="color: #666">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" style="padding-left: 18px"
                                    class="btn btn-white btn-block text-left">
                                        <i class="material-icons">input</i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="menu">
                <a href="{{ route('shipping.order.book.index') }}"
                class="remove-underline" id="menu-add-new-order">
                    <div class="info-box-3 bg-red hover-zoom-effect
                    mb-0 mt-4 ml-4 mr-1 left-0">
                        <div class="icon">
                            <i class="material-icons">flight_takeoff</i>
                        </div>
                        <div class="content">
                            <div class="text"></div>
                            <div class="number">Create New Order</div>
                        </div>
                    </div>
                </a>
                <ul class="list">
                    <x-shipment.dropdown-item text="Dashboard"
                    icon="home" href="{{ route('shipping.index') }}" />

                    <x-shipment.dropdown-item
                    text="Kode Post Taiwan" icon="text_fields"
                    href="https://postalcode-tpe.ekspres.co.id/" :is-new-tab="true" />

                    <x-shipment.dropdown-item text="Order"
                    icon="flight_takeoff" :is-dropdown="true">
                        <x-shipment.dropdown-item
                        href="{{ route('shipping.order.index') }}" text="Data Order" />
                        <x-shipment.dropdown-item
                        href="{{ route('shipping.order.process') }}"
                        text="Dalam Proses" />
                        <x-shipment.dropdown-item
                        href="{{ route('shipping.order.pending') }}"
                        text="Pending Proses" />
                        <x-shipment.dropdown-item
                        href="{{ route('shipping.order.history') }}"
                        text="History Kiriman" />
                        <x-shipment.dropdown-item
                        href="{{ route('shipping.order.receipt') }}"
                        text="Cetak Ulang Resi" />
                    </x-shipment.dropdown-item>

                    @if (auth()->user()->lt==3)
                        <x-shipment.dropdown-item text="Invoices "
                        icon="payment" :is-dropdown="true">
                            <x-shipment.dropdown-item
                            href="{{ route('shipping.invoice.bill') }}" text="Tagihan" />
                            <x-shipment.dropdown-item
                            href="{{ route('shipping.invoice.verifying') }}"
                            text="Dalam Proses Verifikasi" />
                            <x-shipment.dropdown-item
                            href="{{ route('shipping.invoice.settled') }}" text="Lunas" />
                        </x-shipment.dropdown-item>
                    @endif

                    <x-shipment.dropdown-item text="Bantuan"
                    icon="help_outline" :is-dropdown="true">
                        <x-shipment.dropdown-item
                        href="{{ route('shipping.support.guide') }}"
                        text="Panduan Penggunaan" />
                        <x-shipment.dropdown-item
                        href="{{ route('shipping.support.regulation') }}"
                        text="Regulasi Pengiriman" />
                    </x-shipment.dropdown-item>

                </ul>
            </div>

            <div class="legal">
                <div class="copyright">
                    <small>&copy; {{ date('Y') }}</small>
                    <a href="javascript:void(0);">{{ $ourName }}</a>.
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
    @stack('scripts')
    <script src="{{ mix('shipment/js/vendor.js') }}"></script>
    <script src="{{ mix('shipment/js/app.js') }}"></script>

    @yield('components')
</body>
</html>
