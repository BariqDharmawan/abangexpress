<div {{ $attributes->merge(['class' => 'section-title']) }}>
    <h2>{{ $heading }}</h2>
    @isset($desc)
    <p>{{ $desc }}</p>
    @endisset
</div>