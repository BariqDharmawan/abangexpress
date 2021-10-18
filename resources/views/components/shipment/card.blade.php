@props(['icon' => null, 'id' => null])

<div class="card">
    <div class="header">
        <h2 class="h1 fw-bold d-flex items-center">
            @isset($icon)
            <i class="material-icons">{{ $icon }}</i>
            @endisset
            <span class="ml-2">{{ $heading }}</span>
        </h2>
    </div>
    <div class="body" id="{{ $id }}">
        {{ $slot }}
    </div>
</div>