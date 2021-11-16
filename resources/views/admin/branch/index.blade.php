@extends('layouts.admin')

@section('title', 'Cabang Kami')

@section('content')

<div class="col-12">
    @if (session('success'))
        <x-admin.alert-success class="mb-4" />
    @endif

    <x-admin.card title="Manage Cabang Kami">
        <x-slot name="header">
            <x-admin.modal.trigger text="Tambah Cabang"
            modal-target="add-branch" />
        </x-slot>

        <div class="table-responsive">
            <table class="table table-bordered datatable-disable-action-ordering"
            width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Mitra</th>
                        <th>Telepone</th>
                        <th>Alamat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ourBranch as $branch)
                    <tr>
                        <td>
                            <img src="{{ asset($branch->icon) }}" alt="{{ $branch->name }}" height="30px" width="30px">
                            <span class="ml-2">{{ $branch->name }}</span>
                        </td>
                        <td>
                            {{ '+62' . $branch->telephone }}
                        </td>
                        <td>{{ $branch->address }}</td>
                        <td>
                            <x-admin.modal.trigger text="Edit" :is-default-style="false"
                            class="btn-warning"
                            modal-target="edit-branch-{{ $branch->id }}" />
                            <x-admin.modal.trigger text="Hapus" :is-default-style="false"
                            class="btn-danger"
                            modal-target="delete-branch-{{ $branch->id }}" />
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
            <x-admin.input name="name" label="Nama Mitra" minlength="2" maxlength="100" required />
            <x-admin.input name="telephone" class="only-number" type="tel"
            label="Nomor Telepon" pattern=".{8,15}" maxlength="15" inputmode="numeric"
            title="Nomor telephone harus valid (minimal 8 - 15 karakter)" text-addon="+62">
                <small class="text-black-50">
                    Mohon gunakan nomor telepon valid, dengan jumlah karakter 8-15 dan hanya mengandung angka
                </small>
            </x-admin.input>
            <x-admin.input name="address" type="textarea" label="Alamat" required />
            <x-admin.input name="icon" type="file" accept="image/*" label="Pilih Logo" required />
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-admin.modal>

    @foreach ($ourBranch as $branch)
        <x-admin.modal id="edit-branch-{{ $branch->id }}"
        heading="Edit cabang {{ $branch->name }}">
            <form action="{{ route('admin.branch.update', $branch->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <img src="{{ asset($branch->icon) }}" alt="{{ $branch->name }}" height="50px" class="mb-4 mx-auto d-block">

                <x-admin.input name="name" value="{{ $branch->name }}"
                label="Nama Mitra" required />

                <x-admin.input name="telephone" class="only-number" type="tel"
                label="Nomor Telepon" pattern=".{8,15}" maxlength="15"
                value="{{ $branch->telephone }}" inputmode="numeric"
                title="Nomor telephone harus valid (minimal 8 - 15 karakter)" text-addon="+62">
                    <small class="text-black-50">
                        Mohon gunakan nomor telepon valid, dengan jumlah karakter 8-15 dan hanya mengandung angka
                    </small>
                </x-admin.input>

                <x-admin.input name="address" type="textarea"
                value="{{ $branch->address }}" label="Alamat" required />

                <x-admin.input name="icon" type="file" label="Ganti Logo" accept="image/*" />

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </x-admin.modal>

        @include('admin.partials.popup-delete', [
            'id' => 'delete-branch-' . $branch->id,
            'heading' => "Hapus cabang $branch->name",
            'warningMesssage' =>
                "Apakah anda yakin akan menghapus cabang <b>$branch->name</b>",
            'action' => route('admin.branch.destroy', $branch->id)
        ])
    @endforeach
@endsection
