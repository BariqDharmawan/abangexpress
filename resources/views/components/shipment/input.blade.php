@props([
    'type' => 'text',
    'name',
    'placeholder',
    'rows' => 4,
    'id' => null,
    'smallText' => null
])

<div class="form-group">
    @if ($type == 'select')
        <select {{ $attributes->class(['form-control', 'show-tick'])->merge([
            'name' => $name
        ]) }}>
            <option selected disabled>{{ $placeholder }}</option>
            {{ $slot }}
        </select>
    @elseif($type == 'file')
    <label for="{{ $id }}" class="form-label">{{ $placeholder }}</label>
    <input {{ $attributes->class(['form-control'])->merge([
        'name' => $name, 
        'type' => 'file',
        'id' => $id
    ]) }} />
    @else
        <div class="form-line">
            @if ($type == 'textarea')
            <textarea
            {{ $attributes->class(['form-control', 'no-resize'])->merge([
                'name' => $name, 
                'type' => $type,
                'placeholder' => $placeholder,
                'rows' => $rows
            ]) }}></textarea>
            @else
            <input {{ $attributes->class(['form-control'])->merge([
                'name' => $name, 
                'type' => $type,
                'placeholder' => $placeholder
            ]) }} />
            @endif
        </div>
    @endif

    @error($name)
        <small class="text-danger d-block" style="margin-top: 5px">blablabla</small>
    @else
        @isset($smallText)
        <small>{{ $smallText }}</small>
        @endisset
    @enderror

</div>