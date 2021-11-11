@isset ($data)
    <i class="{{ $data->icon }} h1 d-block mb-3 text-center"></i>
@endisset
<form method="POST" enctype="multipart/form-data" action="{{ $action }}">
    @csrf
    @isset($data)
        @method('PUT')
    @endisset

    <x-admin.input label="Service name" name="title" minlength="3" maxlength="20"
    value="{{ old('title') ?? (isset($data) ? $data->title : '') }}" required />

    <x-admin.input label="Service desc" type="textarea" name="desc" minlength="5"
    value="{{ old('desc') ?? (isset($data) ? $data->desc : '') }}"
    class="resize-none" required></x-admin.input>

    <div class="d-flex flex-wrap mb-3">
        <p class="d-block w-100">Choose icon</p>
        @foreach ($listIcon as $icon)
            <div class="form-check mr-4 h2">
                <input type="radio" id="pick-icon-{{ Str::slug($icon->icon) }}"
                name="icon" class="form-check-input mr-0" value="{{ $icon->icon }}"
                @if(isset($data) and $data->icon == $icon->icon) checked @endif>
                <label class="form-check-label" for="pick-icon-{{ Str::slug($icon->icon) }}">
                    <i class="{{ $icon->icon }}"></i>
                </label>
            </div>
        @endforeach

        @error('icon')
            <div class="text-danger py-2">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
