@props(['width' => '100%', 'thead'])

<div class="table-responsive">
    <table {{ $attributes->class(['table', 'table-bordered'])->merge([
        'width' => $width,
        'cellspacing' => '0',
    ]) }}>
        <thead>
            <tr>
                @foreach ($thead as $th)
                <th>{{ $th }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>