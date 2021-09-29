<x-admin.modal id="{{ $id }}" heading="{{ $heading }}">
    <p>{!! $warningMesssage !!}</p>
    <form action="{{ $action }}" method="post" class="d-block">
        <button type="submit" class="btn btn-danger w-100">
            Remove it
        </button>
    </form>
</x-admin.modal>