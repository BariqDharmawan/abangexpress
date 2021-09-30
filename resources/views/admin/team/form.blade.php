<form method="POST" enctype="multipart/form-data" action="">
    <div class="form-group">
        <label for="person-name">Person name</label>
        <input type="text" class="form-control"
        id="person-name" @if($data) value="{{ $data->name }}" @endif required>
    </div>
    <div class="form-group">
        <label for="person-name">Person position</label>
        <select class="custom-select">
            @foreach ($positionList as $position)
                <option value="{{ $position->id }}"
                @if ($data and ($position->id === $data->position_id)) selected @endif>
                    {{ $position->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" 
            id="person-avatar" name="avatar" required>
            <label class="custom-file-label" for="person-avatar">
                {{ $data ? 'Change' : 'Add' }} avatar
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>