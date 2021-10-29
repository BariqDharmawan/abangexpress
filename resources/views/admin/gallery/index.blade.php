@extends('layouts.admin')

@section('title', 'Manage Gallery')

@section('content')
    <div class="col-12">
        <x-admin.card title="Manage Gallery">
            <x-slot name="header">
                <x-admin.modal.trigger text="Tambah Gambar"
                modal-target="add-image" />
                <x-admin.modal.trigger text="Tambah Video"
                modal-target="add-video" />
            </x-slot>

            @include('partials.gallery-list', ['hasBtnDelete' => true])
        </x-admin.card>
    </div>
@endsection

@section('components')
    <x-admin.modal id="add-image" heading="Tambah Cabang Baru">
        <form action="{{ route('admin.gallery.store') }}" method="POST"
        enctype="multipart/form-data">
            @csrf
            <x-admin.input name="img" type="file" accept="image/*"
            label="Pilih Gambar" required />
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-admin.modal>

    <x-admin.modal id="add-video" heading="Tambah Cabang Baru">
        <form action="{{ route('admin.gallery.store') }}" method="POST"
        enctype="multipart/form-data">
            @csrf
            <x-admin.input name="youtube" type="url"
            label="Taruh link youtube disini"
            placeholder="Contoh: https://www.youtube.com/watch?v=WgU7P6o-GkM" required />
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-admin.modal>

    @foreach ($galleryImg as $gallery)
        @include('admin.partials.popup-delete', [
            'id' => 'remove-image-' . $loop->iteration,
            'heading' => "Hapus Gallery",
            'warningMesssage' => "Apakah kamu yakin ingin menghapus gambar ini?",
            'action' => route('admin.gallery.destroy', $gallery->id)
        ])
    @endforeach

    @foreach ($galleryYoutube as $gallery)
        @include('admin.partials.popup-delete', [
            'id' => 'remove-youtube-' . $loop->iteration,
            'heading' => "Hapus Video",
            'warningMesssage' => "Apakah kamu yakin ingin menghapus video ini?",
            'action' => route('admin.gallery.destroy', $gallery->id)
        ])
    @endforeach
@endsection
