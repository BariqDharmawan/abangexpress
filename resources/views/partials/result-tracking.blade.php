<section id="search-resi-section">
    <div class="container" data-aos="fade-up">
        <div id="panel-resi">
            @if ($templateUsing == 1)
                <x-section-header text="Hasil pencarian 
                {{ session('trackingstatus') == 'success' ? 
                session('trackUpdate')->awb : old('track_order') }}" />
            @elseif($templateUsing == 2)
                <x-template2.section-title heading="Hasil pencarian 
                {{ session('trackingstatus') == 'success' ? 
                session('trackUpdate')->awb : old('track_order') }}" />
            @endif
            
            @if (session('trackingstatus')=="success")
            <div class="panel-scroll__header bg-success p-3 
            text-white text-center fw-bold text-uppercase rounded-top">
                {{ session('trackUpdate')->lastupdate }} To 
                {{ session('trackUpdate')->name }}
            </div>
            @endif

            <div class="row panel-scroll border p-3 alert-dismissible mx-0
                @if(session('trackingstatus') == 'failed') 
                    panel-scroll--empty
                @endif">
                @if (session('trackingstatus')=="success")
                    <ul class="col-lg-3">
                        @foreach ( session('datetime') as $dateRes)
                        <li class="panel-scroll__item
                        @if(strpos(strtolower($dateRes['status']),"delivered")  !==false )
                        {{-- coloring for delivery --}}
                            current-day
                        @elseif(strpos(strtolower($dateRes['status']),"delivery")  !==false || strpos(strtolower($dateRes['status']),"delivering")  !==false )
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
                    <p class="fs-1 fw-bold">
                        Nomor resi tidak ditemukan, <br> 
                        silahkan telusuri ulang
                    </p>
                @endif                            

                <button type="button" class="btn-close btn-close--div btn-show-hidden-section-aos" data-section-closed-aos="#fade-up-about"
                data-close-div="#panel-resi"></button>
            </div>
            <div class="row mt-4 justify-content-end">
                <div class="col-auto">
                    <a href="javascript:void(0);" data-to-section="#topbar"
                    class="btn rounded-pill btn-info text-white scroll-to-section">
                        Telusuri lagi
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>