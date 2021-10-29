@extends('layouts.admin')

@section('title', 'Cabang Kami')

@section('content')

<div class="col-12">

    <x-admin.card title="Manage Cabang Kami">
        <x-slot name="header">
            <x-admin.modal.trigger text="Tambah Cabang"
            modal-target="add-branch" />
        </x-slot>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable"
            width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="2">Nama Mitra</th>
                        <th>Telepone</th>
                        <th>Alamat</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ourBranch as $branch)
                    <tr>
                        <td class="text-center">
                            <img src="{{ asset($branch->icon) }}" alt="{{ $branch->name }}" height="30px" width="30px">
                        </td>
                        <td>{{ $branch->name }}</td>
                        <td>
                            {{ '+62' . $branch->telephone }}
                        </td>
                        <td>{{ $branch->address }}</td>
                        <td>
                            <x-admin.modal.trigger text="Edit" :is-default-style="false"
                            class="btn-warning"
                            modal-target="edit-branch-{{ $loop->iteration }}" />
                        </td>
                        <td>
                            <x-admin.modal.trigger text="Hapus" :is-default-style="false"
                            class="btn-danger"
                            modal-target="delete-branch-{{ $loop->iteration }}" />
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-admin.card>
</div>
@endsection

@section('components')
    <x-admin.modal id="add-branch" heading="Tambah Cabang Baru">
        <form action="{{ route('admin.branch.store') }}" method="POST"
        enctype="multipart/form-data">
            @csrf
            <x-admin.input name="name" label="Nama Mitra" required />
            <x-admin.input name="telephone" type="tel" inputmode="numeric"
            label="Nomor Telepon" required />
            <x-admin.input name="address" type="textarea" label="Alamat" required />
            <x-admin.input name="icon" type="file" accept="image/*"
            label="Pilih Logo" required>
                <small class="text-dark">
                    atau kosongkan, jika ingin menggunakan logo default
                </small>
            </x-admin.input>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-admin.modal>

    @foreach ($ourBranch as $branch)
        <x-admin.modal id="edit-branch-{{ $loop->iteration }}"
        heading="Edit cabang {{ $branch->name }}">
            <form action="{{ route('admin.branch.update', $branch->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <x-admin.input name="name" value="{{ $branch->name }}"
                label="Nama Mitra" required />
                <x-admin.input name="telephone" type="tel"
                value="{{ $branch->telephone }}" label="Nomor Telepon" required />
                <x-admin.input name="address" type="textarea"
                value="{{ $branch->address }}" label="Alamat" required />
                <x-admin.input name="icon" type="file" label="Pilih Logo" required>
                    <small class="text-dark">
                        atau kosongkan, jika ingin menggunakan logo default
                    </small>
                </x-admin.input>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </x-admin.modal>

        @include('admin.partials.popup-delete', [
            'id' => 'delete-branch-' . $loop->iteration,
            'heading' => "Hapus cabang $branch->name",
            'warningMesssage' =>
                "Apakah anda yakin akan menghapus cabang <b>$branch->name</b>",
            'action' => route('admin.branch.destroy', $branch->id)
        ])
    @endforeach
@endsection
