<form method="POST" enctype="multipart/form-data" action="{{ $action }}">
    @csrf
    @isset($data)
        @method('PUT')
    @endisset

    <x-admin.input name="name" label="Nama member"
    value="{{ isset($data) ? $data->name : '' }}"
    pattern="[a-zA-Z.\s]+" title="Nama tidak boleh mengandung angka atau karakter spesial"
    minlength="3" maxlength="60" required></x-admin.input>

    <x-admin.input label="Jabatan"
    name="position" required />

    <x-admin.input type="textarea" label="Deskripsi member" name="short_desc"
    minlength="8" maxlength="50" value="{{ $data->short_desc ?? '' }}"
    rows="5" required/>

    <x-admin.input label="{{ isset($data) ? 'Ubah' : 'Pilih' }} profile foto"
    type="file" name="{{ isset($data) ? 'avatar_edit' : 'avatar' }}" accept="image/*">
        <small>Atau kosongkan jika ingin menggunakan avatar default</small>
    </x-admin.input>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
