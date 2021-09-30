@isset ($data)
    <img src="{{ $data->logo }}" class="card-img-top mb-5" alt="">
@endisset
<form method="POST" enctype="multipart/form-data" action="{{ $action }}">
    @isset($data)
        @csrf @method('PUT')
    @endisset
    <div class="form-group">
        <label for="@isset($data) client-name-{{ $data->id }} @else client-title @endisset">Client Fullname</label>
        <input type="text" class="form-control"
        id="@isset($data) client-name-{{ $data->id }} @else client-title @endisset" name="name" 
        value="@isset($data){{ $data->name }}@endisset" required>
    </div>
    <div class="form-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" 
            id="client-logo" name="logo" required>
            <label class="custom-file-label" for="client-logo">
                @isset($data)
                Change logo
                @else
                Choose logo
                @endisset
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>