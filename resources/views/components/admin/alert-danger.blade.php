@props(['text' => null])

<div {{ $attributes->class(['alert', 'alert-danger'])->merge(['role' => 'alert']) }}>
    @if (session('error'))
    {{ session('error') }}
    @else
    {{ $text }}
    @endif
    {{ $slot }}
    <button type="button" class="close"
    data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
