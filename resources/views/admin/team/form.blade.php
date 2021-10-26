<form method="POST" enctype="multipart/form-data" action="{{ $action }}">
    @csrf
    @isset($data)
        @method('PUT')
    @endisset

    <x-admin.input name="name" label="Nama member" 
    value="{{ isset($data) ? $data->name : '' }}" 
    class="not-allow-number" minlength="3" maxlength="60" required></x-admin.input>
    
    <x-admin.input type="select" label="Jabatan" 
    name="{{ empty($data) ? 'position_id' : 'position_id_edit' }}" required>
        @foreach ($positionList as $position)
            <option value="{{ $position->id }}"
            @if (isset($data) and ($position->id === $data->position_id) or
            old('position_id') == $position->id) selected @endif>
                {{ $position->name }}
            </option>
        @endforeach
    </x-admin.input>

    <x-admin.input type="textarea" label="Deskripsi member" name="short_desc"
    minlength="8" maxlength="50" value="{{ $data->short_desc ?? '' }}" 
    rows="5" required/>

    <x-admin.input label="{{ isset($data) ? 'Ubah' : 'Pilih' }} profile foto" 
    type="file" name="{{ isset($data) ? 'avatar_edit' : 'avatar' }}" 
    :is-required="isset($data) ? false : true" accept="image/*"/>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>