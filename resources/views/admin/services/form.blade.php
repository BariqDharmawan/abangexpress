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
    <div class="form-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" 
            id="@isset($data)service-icon-{{ $data->id }}@else service-icon @endisset" name="icon" @empty($data) required @endempty 
            accept="image/*">
            <label class="custom-file-label" 
            for="@isset($data)service-icon-{{ $data->id }}@else service-icon @endisset">
                @isset($data)
                Change icon
                @else
                Choose icon
                @endisset
            </label>
        </div>
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