<div class="section-header">
    <h2 {{ $attributes->merge([
        'class' => 'text-capitalize break-word'
    ]) }}>
        {{ $text }}
    </h2>

    {!! $desc !!}
</div>
