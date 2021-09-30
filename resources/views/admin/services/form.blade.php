@isset ($data)
    <img src="{{ asset($data->icon) }}" alt="" height="30px" class="d-block mb-3 mx-auto">
@endisset
<form method="POST" enctype="multipart/form-data" action="{{ $action }}">
    @isset($data)
        @csrf @method('PUT')
    @endisset
    <div class="form-group">
        <label for="@isset($data) service-title-{{ $data->id }} @else service-title @endisset">Service name</label>
        <input type="text" class="form-control" 
        id="@isset($data) service-title-{{ $data->id }} @else service-title @endisset" name="title" 
        value="@isset($data){{ $data->title }}@endisset" required>
    </div>
    <div class="form-group">
        <label for="@isset($data) service-desc-{{ $data->id }} @else service-desc @endisset">Service desc</label>
        <textarea name="desc" id="@isset($data)service-desc-{{ $data->id }} @else service-desc @endisset" rows="3" 
        style="resize: none;" 
        class="form-control" required>@isset($data){{ $data->desc }}@endisset</textarea>
    </div>
    <div class="form-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" 
            id="service-icon" name="icon" required>
            <label class="custom-file-label" for="service-icon">
                @isset($data)
                Change icon
                @else
                Choose icon
                @endisset
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>