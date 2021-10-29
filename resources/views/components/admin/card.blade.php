<div {{ $attributes->class(['card', 'shadow' => isset($hasShadow) and $hasShadow]) }}">
    @isset($title)
    <div class="card-header d-flex align-items-center
    @if(isset($isHeaderTransparent) and $isHeaderTransparent) bg-transparent @endif
    @if(isset($reverseHeader) and $reverseHeader) flex-column-reverse @endif">
        <h6 class="m-0 font-weight-bold
        @if(isset($isHeaderTransparent) and $isHeaderTransparent) text-black @else text-primary @endif">
            {{ $title }}
        </h6>
        @isset($header)
        <div class="ml-auto">
            {{ $header }}
        </div>
        @endisset
    </div>
    @endisset

    <div class="card-body">{{ $slot }}</div>

    @isset($footer)
    <div class="card-footer @isset($footerClass){{ $footerClass }}@endisset">
        {{ $footer }}
    </div>
    @endisset
</div>
