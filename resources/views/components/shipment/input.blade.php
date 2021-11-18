@props([
    'type' => 'text',
    'name',
    'placeholder' => null,
    'rows' => 4,
    'id' => null,
    'smallText' => null,
    'iconAddon' => null,
    'textAddon' => null,
    'required' => null,
    'label' => null,
    'inputHidden' => null,
    'haveNoMargin' => false,
    'isMaterialUi' => true
])


<div class="form-group form-float form-group-lg {{ $haveNoMargin ? 'mb-0' : '' }}">
    @if ($type == 'select' or $type == 'select-ajax')
        <label for="{{ $id }}" class="form-label {{ isset($required) ? 'form-label--required' : '' }}">
            {{ $label ?? $placeholder }}
        </label>
        <select {{ $attributes->class([
            'select2' => $type == 'select',
            'select2-ajax' => $type == 'select-ajax'
        ])->merge([
            'name' => $name,
            'id' => $id
        ]) }} style="width: 100%" required>
            <option selected disabled>{{ $placeholder ?? "Pilih $label" }}</option>
            {{ $slot }}
        </select>
    @elseif($type == 'file')
    <div class="custom-file">
        <input {{ $attributes->class(['custom-file__input'])->merge([
            'name' => $name,
            'type' => 'file',
            'id' => $id,
            'required' => $required,
            'value' => old($name),
            'data-input-hidden' => $inputHidden
            ]) }} />
        <label for="{{ $id }}" class="custom-file__label">
            <span class="{{ isset($required) ? 'form-label--required' : '' }}">{{ $placeholder }}</span>
        </label>
    </div>
    @else
        @if (isset($iconAddon) || isset($textAddon))
        <label class="form-label mb-0 @if(isset($required) and $required)form-label--required @endif" for="{{ $id }}">
            {{ $label ?? $placeholder }}
        </label>
        <div class="input-group mb-0">
            <span class="input-group-addon">
                @isset($iconAddon)
                    <i class="material-icons">{{ $iconAddon }}</i>
                @endisset
                @isset($textAddon)
                    {{ $textAddon }}
                @endisset
            </span>


            <div class="form-line">
                <input {{ $attributes->class(['form-control'])->merge([
                    'type' => $type,
                    'id' => $id ?? Str::slug($label),
                    'name' => $name,
                    'required' => $required,
                    'placeholder' => $placeholder,
                    'value' => old($name)
                ]) }}>
            </div>
        </div>
        @else
            @if(isset($isMaterialUi) and $isMaterialUi)
            <div class="form-line">
            @endif
                @if ($type == 'textarea')
                    @if(isset($isMaterialUi) and !$isMaterialUi)
                        <label class="form-label {{ isset($required) ? 'form-label--required' : '' }}"
                        for="{{ $id ?? Str::slug($label) }}">
                            {{ $label ?? $placeholder }}
                        </label>
                    @endif

                    <textarea
                    {{ $attributes->class(['form-control', 'no-resize'])->merge([
                        'name' => $name,
                        'type' => $type,
                        'rows' => $rows,
                        'id' => $id ?? Str::slug($label),
                        'required' => $required
                    ]) }}>{{ old($name) }}</textarea>

                    @if(isset($isMaterialUi) and $isMaterialUi)
                        <label class="form-label mb-0 {{ isset($required) ? 'form-label--required' : '' }}" for="{{ $id ?? Str::slug($label) }}">
                            {{ $label ?? $placeholder }}
                        </label>
                    @endif
                @else

                    @if(isset($isMaterialUi) and !$isMaterialUi)
                        <label class="form-label {{ isset($required) ? 'form-label--required' : '' }}"
                        for="{{ $id ?? Str::slug($label) }}">
                            {{ $label ?? $placeholder }}
                        </label>
                    @endif

                    <input {{ $attributes->class(['form-control'])->merge([
                        'name' => $name,
                        'type' => $type,
                        'id' => $id ?? Str::slug($label),
                        'required' => $required,
                        'value' => old($name)
                    ]) }} />

                    @if(isset($isMaterialUi) and $isMaterialUi)
                    <label class="form-label mb-0 {{ isset($required) ? 'form-label--required' : '' }}" for="{{ $id ?? Str::slug($label) }}">
                        {{ $label ?? $placeholder }}
                    </label>
                    @endif

                @endif
            @if(isset($isMaterialUi) and $isMaterialUi == true)
            </div>
            @endif
        @endif
    @endif

    @if ($type == 'file' and $inputHidden != null)
        @error($inputHidden)
            <small class="text-danger d-block mt-2 error-backend">
                {{ $message }}
            </small>
        @else
            @isset($smallText)
            <small class="text-black-50 helper-input" data-default-helper="{{ $smallText }}">{{ $smallText }}</small>
            @else
            <small class="text-danger error-ajax-{{ $inputHidden }}
            d-block mt-2"></small>
            @endisset
        @enderror
    @else
        @error($name)
            <small class="text-danger d-block mt-2 error-backend">{{ $message }}</small>
        @else
            @isset($smallText)
            <small class="text-black-50 helper-input" data-default-helper="{{ $smallText }}">{{ $smallText }}</small>
            @else
            <small class="text-danger error-ajax-{{ $name }} d-block mt-2"></small>
            @endisset
        @enderror
    @endif
</div>
