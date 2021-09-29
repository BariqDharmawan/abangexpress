@if ($service)
    <img src="{{ asset($service->icon) }}" alt="" height="30px" class="d-block mb-3 mx-auto">
@endif
<form method="POST" enctype="multipart/form-data" action="{{ $action }}">
    <div class="form-group">
        <label for="@if($service) service-title-{{ $service->id }} @else service-title @endif">Service name</label>
        <input type="text" class="form-control" 
        id="@if($service) service-title-{{ $service->id }} @else service-title @endif" name="title" 
        value="@if($service){{ $service->title }}@endif" required>
    </div>
    <div class="form-group">
        <label for="@if($service) service-desc-{{ $service->id }} @else service-desc @endif">Service desc</label>
        <textarea name="desc" id="@if($service)service-desc-{{ $service->id }} @else service-desc @endif" rows="3" 
        style="resize: none;" 
        class="form-control" required>@if($service){{ $service->desc }}@endif</textarea>
    </div>
    <div class="form-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" 
            id="service-icon" name="icon" required>
            <label class="custom-file-label" for="service-icon">
                @if($service)
                Change icon
                @else
                Choose icon
                @endif
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>