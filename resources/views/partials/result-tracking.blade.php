<section id="search-resi-section">
    @if($templateUsing != 'shipping')
    <div class="container" data-aos="fade-up">
    @endif
        <div id="panel-resi">
            @if ($templateUsing == 1)
                <x-section-header text="Hasil pencarian
                {{ session('trackingstatus') == 'success' ?
                session('trackUpdate')->awb : old('receipt_number') }}" />
            @elseif($templateUsing == 2)
                <x-template2.section-title heading="Hasil pencarian
                {{ session('trackingstatus') == 'success' ?
                session('trackUpdate')->awb : old('receipt_number') }}" />
            @elseif($templateUsing == 'shipping')
            <div class="block-header">
                <h3>
                    Hasil pencarian
                    {{ session('trackingstatus') == 'success' ?
                    session('trackUpdate')->awb : old('receipt_number') }}
                </h3>
            </div>
            @endif

            @if (!empty(session('lastUpdate')))
            <div class="panel-scroll__header">
                {{ session('lastUpdate') }}
            </div>
            @endif

            <div class="row panel-scroll alert-dismissible
                @if(session('trackingstatus') == 'failed')
                    panel-scroll--empty
                @endif">
                @if (session('trackingstatus')=="success")
                    <ul class="@if($templateUsing != 'shipping') col-5 @else col-sm-5 col-md-5 col-lg-5 @endif panel-scroll__left">
                        @foreach (session('datetime') as $dateRes)
                            <li data-panel-attached="#panel-text-{{ $loop->iteration }}"
                            class="panel-scroll__item
                            @if(Helper::checkOrderStatus($dateRes['status'], 'delivered'))
                            {{-- coloring for delivery --}}
                            current-day
                            @elseif(
                                Helper::checkOrderStatus($dateRes['status'], 'delivery') or
                                Helper::checkOrderStatus($dateRes['status'], 'delivering')
                            )
                            {{-- coloring for out for delivery --}}
                            out-for-delivery
                            @endif">
                                @if (
                                    Helper::checkOrderStatus(
                                        $dateRes['status'], 'delivered'
                                    )
                                )
                                    @if ($templateUsing != 'shipping')
                                        <i class="fas fa-check text-white
                                        special-indicator"></i>
                                    @else
                                        @include('partials.special-indicator', [
                                            'icon' => 'check-solid.svg'
                                        ])
                                    @endif
                                @elseif (
                                    Helper::checkOrderStatus(
                                        $dateRes['status'], 'delivery'
                                    ) or Helper::checkOrderStatus(
                                        $dateRes['status'], 'delivering'
                                    )
                                )
                                    @if ($templateUsing != 'shipping')
                                        <i class="fas fa-box text-white
                                        special-indicator"></i>
                                    @else
                                        @include('partials.special-indicator', [
                                            'icon' => 'box-solid.svg'
                                        ])
                                    @endif
                                @else
                                    @if ($templateUsing != 'shipping')
                                        <i class="fas fa-circle text-secondary
                                        special-indicator"></i>
                                    @else
                                        @include('partials.special-indicator', [
                                            'icon' => 'circle-solid.svg'
                                        ])
                                    @endif
                                @endif

                                <time datetime="{{  $dateRes['date'] }}"
                                class="fw-bold fs-lg-5 fs-almost-normal">
                                    {{ $dateRes['date'] . ' ' . $dateRes['time']  }}
                                </time>
                            </li>
                        @endforeach
                    </ul>

                    <ul class="@if($templateUsing != 'shipping') col-7 pl-0 pl-lg-5 @else col-sm-7 col-md-7 col-lg-7 pe-0 ps-lg-5 @endif ps-almost-5 panel-scroll__right">
                        @foreach (session('trackresult') as $trackresult )
                            <li class="panel-scroll__text"
                            id="panel-text-{{ $loop->iteration }}">
                                <p class="mb-1 fw-bold fs-lg-5 fs-almost-normal">
                                    {{-- tracking detail --}}
                                    {{ $trackresult['desc'] }}
                                </p>
                                <address class="m-0 fs-lg-6 fs-quarter-normal">
                                    {{-- location --}}
                                    {{ $trackresult['location'] }}
                                </address>
                            </li>
                        @endforeach
                    </ul>
                @elseif(session('trackingstatus') == 'failed')
                    <p class="fs-lg-1 fw-bold text-center">
                        Nomor resi tidak ditemukan, <br>
                        silahkan telusuri ulang
                    </p>
                @endif

                @if ($templateUsing != 'shipping')
                    <button type="button" class="btn-close btn-close--div btn-show-hidden-section-aos" data-section-closed-aos="#fade-up-about"
                    data-close-div="#panel-resi"></button>
                @endif

            </div>
            @if ($templateUsing != 'shipping')
            <div class="row mt-4 justify-content-end">
                <div class="col-auto">
                    <a href="javascript:void(0);" data-to-section="#topbar"
                    class="btn rounded-pill btn-info text-white scroll-to-section">
                        Telusuri lagi
                    </a>
                </div>
            </div>
            @endif
        </div>
    @if($templateUsing != 'shipping')
    </div>
    @endif
</section>
