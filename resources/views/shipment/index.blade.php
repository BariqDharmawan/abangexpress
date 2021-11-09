@extends('layouts.shipment')

@section('title', 'Dashboard')

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
                    <div class="info-box info-box--120px bg-red hover-expand-effect">
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
                            data-to="
                            @if (auth()->user()->lt==3)
                            {{ $quickReport['hutang'] }}
                            @else
                            {{ 0 }}
                            @endif

                            " data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Kiriman di proses {{ $quickReport['waktu'] }}</h2>
                </div>
                <div class="body p-0">
                    <div class="info-box info-box--120px bg-red hover-expand-effect">
                        <div class="icon d-inline-flex items-center justify-center
                        pt-5 pb-5">
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
        @include('partials.result-tracking', ['templateUsing' => 'shipping'])
    @endif

@endsection
