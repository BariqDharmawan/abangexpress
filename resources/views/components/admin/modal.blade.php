<div {{ $attributes->merge(['class' => 'modal fade', 'id' => $id, 'tabindex' => '-1', 'aria-labelledby' => $id . 'Label', 'aria-hidden' => "true"]) }}>
    <div class="modal-dialog @isset($size)modal-{{ $size }}@endisset">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id }}Label">{!! $heading !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>