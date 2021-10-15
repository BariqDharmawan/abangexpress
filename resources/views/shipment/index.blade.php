@extends('layouts.shipment')

@section('content')

    <div class="block-header">
        <h3>Tracking order</h3>
    </div>
    <form method="GET" class="card mt-3" action="{{ route('tracking-order.index') }}">
        @csrf
        <div class="body">
            <x-shipment.input class="input--btn-inside not-allow-space" 
            name="receipt_number" maxlength="30" placeholder="Ketik nomor resi disini" 
            autocomplete="off" required/>
            <button type="submit" class="btn btn-big btn-primary">
                Cari resi
            </button>
        </div>
    </form>

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