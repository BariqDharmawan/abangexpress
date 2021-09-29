<div class="card shadow">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
        @isset($header)
        {{ $header }}
        @endisset
    </div>
    <div class="card-body">{{ $slot }}</div>
</div>