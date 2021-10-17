@extends('layouts.shipment')

@section('content')

    <form method="GET" class="card mt-3" action="{{ route('tracking-order.index') }}">
        @csrf
        <div class="body">
            <h3 class="mt-0" style="margin-bottom: 30px">Tracking order</h3>
            <div class="row mx-0 mt-3">
                <div class="col-xs-12 col-md-12 col-lg-10 mb-0 pl-0">
                    <x-shipment.input class="input--btn-inside not-allow-space"
                    name="receipt_number" maxlength="30"
                    placeholder="Ketik nomor resi disini"
                    autocomplete="off" required/>
                </div>
                <div class="col-xs-12 col-md-12 col-lg-2 mb-0">
                    <button type="submit" class="btn btn-big btn-danger w-100">
                        Cari resi
                    </button>
                </div>
            </div>
        </div>
    </form>

    <div class="row clearfix">
        <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Kiriman belum ditagih</h2>
                </div>
                <div class="body p-0">
                    <div class="info-box info-box--120px bg-green hover-expand-effect">
                        <div class="icon d-inline-flex items-center justify-center
                        pt-5 pb-5">
                            {{-- <img src="{{ asset('img/icon/savings_white_24dp.svg') }}"
                            alt="" width="80px" class="pl-4 pr-4"> --}}
                            <i  class="material-icons">credit_card</i>
                        </div>
                        <div class="content w-100 d-flex items-center pt-5 pb-5">
                            <div class="number count-to" data-from="0"
                            data-to="{{ $quickReport['pcs'] }}" data-speed="1000" data-fresh-interval="20"></div>
                            <span class="ml-auto">Resi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Tagihan belum dibayar</h2>
                </div>
                <div class="body p-0">
                    <div class="info-box info-box--120px bg-red hover-expand-effect">
                        <div class="icon d-inline-flex items-center justify-center
                        pt-5 pb-5">
                            {{-- <img src="{{ asset('img/icon/money-bill-solid.svg') }}"
                            alt="" width="80px" class="pl-4 pr-4"> --}}

                            <i  class="material-icons">date_range</i>
                        </div>
                        <div class="content w-100 d-flex items-center pt-5 pb-5">
                            <span class="mr-3">Rp. </span>
                            <div class="number count-to" data-from="0"
                            data-to="{{ $quickReport['hutang'] }}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Kiriman bulan {{ $quickReport['waktu'] }}</h2>
                </div>
                <div class="body p-0">
                    <div class="info-box info-box--120px bg-green hover-expand-effect">
                        <div class="icon d-inline-flex items-center justify-center
                        pt-5 pb-5">
                            {{-- <img alt="" width="80px" class="pl-4 pr-4"
                            src="{{ asset('img/icon/shipping-fast-solid.svg') }}"> --}}
                            <i  class="material-icons">insert_chart</i>
                        </div>
                        <div class="content w-100 d-flex items-center pt-5 pb-5">
                            <div class="number count-to" data-from="0"
                            data-to="{{ $quickReport['berat'] }}" data-speed="1000" data-fresh-interval="20"></div>
                            <span class="ml-auto">Kg</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('trackingstatus'))
    <section id="search-resi-section" class="mb-5">
        <div id="panel-resi">
            <div class="block-header">
                <h3>
                    Hasil pencarian
                    {{ session('trackingstatus') == 'success' ?
                    session('trackUpdate')->awb : old('receipt_number') }}
                </h3>
            </div>

            @if (session('trackingstatus')=="success")
            <div class="panel-scroll__header bg-green p-5
            text-white text-center fw-bold text-uppercase rounded-top">
                {{ session('trackUpdate')->lastupdate }} To
                {{ session('trackUpdate')->name }}
            </div>
            @endif

            <div class="row panel-scroll p-5 border alert-dismissible mx-0
                @if(session('trackingstatus') == 'failed')
                     panel-scroll--empty
                @endif">
                @if (session('trackingstatus')=="success")
                    <ul class="col-lg-3">
                        @foreach ( session('datetime') as $dateRes)
                        <li class="panel-scroll__item
                        @if(strpos(strtolower($dateRes['status']),"delivered") !== false)
                            current-day
                        @elseif(strpos(strtolower($dateRes['status']),"delivery") !== false || strpos(strtolower($dateRes['status']),"delivering")  !== false)
                            out-for-delivery
                        @endif">

                            @if (strpos(strtolower($dateRes['status']),"delivered")  !==false )
                            <img src="{{ asset('img/icon/check-solid.svg') }}"
                            height="40px" width="40px" class="special-indicator special-indicator--40px" alt="">
                            @elseif (strpos(strtolower($dateRes['status']),"delivery")  !==false || strpos(strtolower($dateRes['status']),"delivering")  !==false )
                                <img src="{{ asset('img/icon/box-solid.svg') }}"
                                height="40px" width="40px"
                                class="special-indicator special-indicator--40px" alt="">
                            @else
                                <img src="{{ asset('img/icon/circle-solid.svg') }}"
                                height="55px" width="55px"
                                class="special-indicator special-indicator--55px" alt="">
                            @endif

                            <time datetime="{{  $dateRes['date'] }}" class="fw-bold fs-5">
                                {{ $dateRes['date']  }}<br>{{ $dateRes['time']  }}
                            </time>
                        </li>
                        @endforeach
                    </ul>

                    <ul class="col-lg-9 pl-4">
                        @foreach (session('trackresult') as $trackresult )
                            <li class="panel-scroll__text px-5">
                                <p class="mb-1 fw-bold fs-5">
                                    {{-- tracking detail --}}
                                    {{ $trackresult['desc'] }}
                                </p>
                                <address class="m-0 fs-6">
                                    {{-- location --}}
                                    {{ $trackresult['location'] }}
                                </address>
                            </li>
                        @endforeach
                    </ul>
                @elseif(session('trackingstatus') == 'failed')
                    <p class="h1 font-weight-bold text-center">
                        Nomor resi tidak ditemukan, <br>
                        silahkan telusuri ulang
                    </p>
                @endif
            </div>
        </div>
    </section>
    @endif
@endsection
