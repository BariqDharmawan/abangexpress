<form method="POST" enctype="multipart/form-data" action="{{ $action }}">
    @csrf
    @isset($data)
        @method('PUT')
    @endisset
    <div class="form-group">
        <label for="person-name">Person name</label>
        <input type="text" class="form-control not-allow-number"
        @empty($data) name="name" @else name="name_edit" @endempty
        id="person-name" @isset($data) value="{{ old('name_edit') ?? $data->name }}" @endisset 
        @empty($data) value="{{ old('name') }}" @endempty required>
        
        @isset($data)
            @error('name_edit')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        @endisset
        @empty($data)
            @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        @endempty
        
    </div>
    <div class="form-group">
        <label for="person-position">Person position</label>
        <select class="custom-select" id="person-position" 
        @empty($data) name="position_id" @else name="position_id_edit" @endempty>
            @foreach ($positionList as $position)
                <option value="{{ $position->id }}"
                @if (isset($data) and ($position->id === $data->position_id) or 
                old('position_id') == $position->id) selected @endif>
                    {{ $position->name }}
                </option>
            @endforeach
        </select>
        @error(isset($data) ? 'position_id_edit' : 'position_id')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="short_desc">About member</label>
        <textarea @empty($data) name="short_desc" @else name="short_desc_edit" @endempty id="short_desc" class="form-control" rows="5" 
        maxlength="30" required>@isset($data){{ old('short_desc_edit') ?? $data->short_desc }}@else{{ old('short_desc') }}@endisset</textarea>
        @error(isset($data) ? 'short_desc_edit' : 'short_desc')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" 
            id="person-avatar"
            @empty($data) name="avatar" required @else name="avatar_edit" @endempty>
            <label class="custom-file-label" for="person-avatar">
                {{ isset($data) ? 'Change' : 'Add' }} avatar
            </label>
        </div>
        @error(isset($data) ? 'avatar_edit' : 'avatar')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>