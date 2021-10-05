@isset ($data)
    <img src="{{ asset($data->icon) }}" alt="" height="30px" class="d-block mb-3 mx-auto">
@endisset
<form method="POST" enctype="multipart/form-data" action="{{ $action }}">
    @csrf
    @isset($data)
        @method('PUT')
    @endisset

    <x-admin.input label="Service name" name="title" minlength="3" maxlength="20" 
    value="{{ $data->title ?? '' }}" required />

    <div class="form-group">
        <label for="@isset($data) service-desc-{{ $data->id }} @else service-desc @endisset">Service desc</label>
        <textarea name="desc" id="@isset($data)service-desc-{{ $data->id }} @else service-desc @endisset" rows="3"
        style="resize: none;" minlength="5"
        class="form-control" required>@isset($data){{ $data->desc }}@endisset</textarea>
        @if(url()->previous() === 'services')
            @error('desc')
                <div class="text-danger py-2">{{ $message }}</div>
            @enderror
        @else
            @error('desc')
                <div class="text-danger py-2">{{ $message }}</div>
            @enderror
        @endempty
    </div>
    <div class="form-group d-flex flex-wrap">

        @foreach ($listIcon as $icon)
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="pick-icon-{{ Str::slug($icon) }}" 
            name="icon" class="custom-control-input">
            <label class="custom-control-label h4" for="pick-icon-{{ Str::slug($icon) }}">
                <i class="{{ $icon }}"></i>
            </label>
        </div>    
        @endforeach

        @if(url()->previous() === 'services')
            @error('icon')
                <div class="text-danger py-2">{{ $message }}</div>
            @enderror
        @else
            @error('icon')
                <div class="text-danger py-2">{{ $message }}</div>
            @enderror
        @endempty
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>