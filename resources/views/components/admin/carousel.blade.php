<div id="{{ $carouselName }}" class="carousel slide" data-ride="carousel">
    @if (isset($isIndicatorHidden) and $isIndicatorHidden)
        <ol class="carousel-indicators">
            @foreach ($contents as $carousel)
            <li data-target="#{{ $carouselName }}" data-slide-to="{{ $loop->index }}" 
            class="@if($loop->first) active @endif"></li>
            @endforeach
        </ol>
    @endif
    <div class="carousel-inner">
        @foreach ($contents as $carousel)
        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
            <img src="{{ asset($carousel->{$fieldImg}) }}" alt="" 
            class="d-block w-100" height="{{ $height ?? '450px' }}">
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#{{ $carouselName }}" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#{{ $carouselName }}" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>