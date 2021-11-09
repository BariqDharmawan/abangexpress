<form action="{{ $action }}" method="POST">
    @csrf
    @isset($data)
        @method('PUT')
    @endisset
    <x-admin.input label="Nama unit" name="name" placeholder="Contoh: PCS"
    value="{{ isset($data) ? $data->name : '' }}"  required />
    <button type="submit" class="btn btn-primary w-100">Submit</button>
</form>
