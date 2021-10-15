@extends('layouts.shipment')

@section('content')

    <div class="block-header">
        <h3>Tracking order</h3>
    </div>
    <form method="GET" class="card mt-3" action="{{ route('tracking-order.index') }}">
        @csrf
        <div class="body">
            <x-shipment.input class="input--btn-inside not-allow-space" name="track_order" minlength="3" placeholder="Ketik nomor resi disini" 
            autocomplete="off" required/>
            <button type="submit" class="btn btn-big btn-primary">
                Cari resi
            </button>
        </div>
    </form>

    {{-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-orange hover-expand-effect">
            <div class="icon">
                <i class="material-icons">person_add</i>
            </div>
            <div class="content">
                <div class="text">NEW VISITORS</div>
                <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div> --}}

    @if (session('trackingstatus'))
    <section id="search-resi-section">
        <div id="panel-resi">
            <div class="block-header">
                <h3>
                    Hasil pencarian 
                    {{ session('trackingstatus') == 'success' ? 
                    session('trackUpdate')->awb : old('track_order') }}
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
                        {{-- coloring for delivery --}}
                            current-day
                        @elseif(strpos(strtolower($dateRes['status']),"delivery") !== false || strpos(strtolower($dateRes['status']),"delivering")  !== false)
                        {{-- coloring for out for delivery --}}
                            out-for-delivery
                        @endif
                        ">

                            @if (strpos(strtolower($dateRes['status']),"delivered")  !==false )
                            {{-- delivered icon --}}
                                <i class="fas fa-check text-white special-indicator"></i>
                            @elseif (strpos(strtolower($dateRes['status']),"delivery")  !==false || strpos(strtolower($dateRes['status']),"delivering")  !==false )
                            {{-- icon out for delivery --}}
                                <i class="fas fa-box text-white special-indicator"></i>
                            @else
                            {{-- other icon a.k.a intransit --}}
                                <i class="fas fa-circle text-secondary special-indicator"></i>
                            @endif

                            <time datetime="{{  $dateRes['date'] }}" class="fw-bold fs-5">
                                {{ $dateRes['date']  }}<br>{{ $dateRes['time']  }}
                            </time>
                        </li>
                        @endforeach
                    </ul>

                    <ul class="col-lg-9">
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