@if ($data)
    <img src="{{ $data->logo }}" class="card-img-top mb-5" alt="">
@endif
<form method="POST" enctype="multipart/form-data" action="{{ $action }}">
    @isset($data)
        @csrf @method('PUT')
    @endisset
    <div class="form-group">
        <label for="@if($data) client-name-{{ $data->id }} @else client-title @endif">Client Fullname</label>
        <input type="text" class="form-control"
        id="@if($data) client-name-{{ $data->id }} @else client-title @endif" name="name" 
        value="@if($data){{ $data->name }}@endif" required>
    </div>
    <div class="form-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" 
            id="client-logo" name="logo" required>
            <label class="custom-file-label" for="client-logo">
                @if($data)
                Change logo
                @else
                Choose logo
                @endif
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>