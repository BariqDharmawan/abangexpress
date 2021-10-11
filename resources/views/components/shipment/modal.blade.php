@props(['id', 'title' => null])

<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @isset($title)
            <div class="modal-header">
                <h4 class="modal-title" id="{{ $id }}Label">{{ $title }}</h4>
            </div>
            @endisset
            <div class="modal-body">
                {{ $slot }}
            </div>
            @isset($action)
            <div class="modal-footer">
                {{ $action }}
            </div>
            @endisset
        </div>
    </div>
</div>