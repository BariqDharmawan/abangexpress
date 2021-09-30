<form method="POST" enctype="multipart/form-data" action="{{ $action }}">
    @isset($data)
        @csrf @method('PUT')
    @endisset
    <div class="form-group">
        <label for="@isset($data)edit-social-{{ $data->platform }}@endisset">Platform</label>
        <select class="custom-select text-capitalize">
            @foreach ($platforms as $platform)
                <option @if(isset($data) and $data->platform == $platform) selected @endif
                value="{{ $platform }}">
                    {{ $platform }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="@isset($data)edit-social-{{ $data->username }}@endisset">
            Username
        </label>
        <input type="text" class="form-control" 
        id="@isset($data)edit-social-{{ $data->username }}@else add-social @endisset" 
        name="email" value="@isset($data){{ $data->username }}@endisset" required>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>