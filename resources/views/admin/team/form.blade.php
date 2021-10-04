<form method="POST" enctype="multipart/form-data" action="{{ $action }}">
    @csrf
    @isset($data)
        @method('PUT')
    @endisset

    <x-admin.input name="name" label="Person name" 
    value="{{ isset($data) ? $data->name : '' }}" 
    class="not-allow-number" minlength="3" maxlength="60" required></x-admin.input>

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

    <x-admin.input type="textarea" label="About member" name="short_desc"
    minlength="8" maxlength="50" value="{{ $data->short_desc ?? '' }}" rows="5" required/>

    <div class="form-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" 
            id="person-avatar" accept="image/*"
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