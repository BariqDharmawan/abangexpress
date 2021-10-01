<form method="POST" enctype="multipart/form-data" action="{{ $action }}">
    @csrf
    @isset($data)
        @method('PUT')
    @endisset
    <div class="form-group">
        <label for="@isset($data)edit-social-{{ $data->platform }}@else add-social-platform @endisset">Platform</label>
        <select class="custom-select text-capitalize" name="platform" 
        id="@isset($data)edit-social-{{ $data->platform }}@else add-social-platform @endisset">
            @foreach ($platforms as $platform)
                <option @if(isset($data) and $data->platform == $platform) selected @endif
                value="{{ $platform }}">
                    {{ $platform }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="@isset($data)edit-social-{{ $data->username }}@else add-social-username @endisset">
            Username
        </label>
        <input type="text" class="form-control" 
        id="@isset($data)edit-social-{{ $data->username }}@else add-social-username @endisset" 
        name="username" value="@isset($data){{ old('username') ?? $data->username }}@endisset">

        @error('username')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" 
            id="@isset($data)edit-social-{{ $data->username }}@else add-social-icon @endisset" name="icon" @empty($data) required @endempty>
            <label class="custom-file-label" for="add-social-icon">
                @isset($data)
                Change logo
                @else
                Pick icon
                @endisset
            </label>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>