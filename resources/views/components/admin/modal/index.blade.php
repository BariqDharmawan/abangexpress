<div {{ $attributes->merge(['class' => 'modal fade', 'id' => $id, 'tabindex' => '-1', 'aria-labelledby' => $id . 'Label', 'aria-hidden' => "true"]) }}>
    <div class="modal-dialog @isset($size)modal-{{ $size }}@endisset">
        <div class="modal-content overflow-hidden @if (isset($isCloseAble) and !$isCloseAble) border-0 @endif">
            <div class="modal-header
            @if (isset($isCloseAble) and !$isCloseAble) d-none @endif">
                @isset($heading)
                <h5 class="modal-title" id="{{ $id }}Label">{!! $heading !!}</h5>
                @endisset
                @if (isset($isCloseAble) and $isCloseAble)
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @endif
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
