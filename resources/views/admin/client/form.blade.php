@if ($client)
    <img src="{{ $client->logo }}" class="card-img-top mb-5" alt="">
@endif
<form method="POST" enctype="multipart/form-data" action="{{ $action }}">
    <div class="form-group">
        <label for="@if($client) client-name-{{ $client->id }} @else client-title @endif">Client Fullname</label>
        <input type="text" class="form-control"
        id="@if($client) client-name-{{ $client->id }} @else client-title @endif" name="name" 
        value="@if($client){{ $client->name }}@endif" required>
    </div>
    <div class="form-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" 
            id="client-logo" name="logo" required>
            <label class="custom-file-label" for="client-logo">
                @if($client)
                Change logo
                @else
                Choose logo
                @endif
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>