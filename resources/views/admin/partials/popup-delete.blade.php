<x-admin.modal id="{{ $id }}" heading="{{ $heading }}">
    <p>{!! $warningMesssage !!}</p>
    <form action="{{ $action }}" method="post" class="d-block">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger w-100">
            Hapus
        </button>
    </form>
</x-admin.modal>