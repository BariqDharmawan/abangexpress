<div {{ $attributes->class(['card', 'shadow' => isset($hasShadow) and $hasShadow]) }}">
    @isset($title)
    <div class="card-header d-flex align-items-center justify-content-between 
    @if(isset($isHeaderTransparent) and $isHeaderTransparent) bg-transparent @endif">
        <h6 class="m-0 font-weight-bold 
        @if(isset($isHeaderTransparent) and $isHeaderTransparent) text-black @else text-primary @endif">
            {{ $title }}
        </h6>
        @isset($header)
        {{ $header }}
        @endisset
    </div>
    @endisset
    <div class="card-body">{{ $slot }}</div>
</div>