@extends('layouts.admin')

@section('title', 'Manage user')

@section('content')
    <div class="row mx-0">
        @if (session('success'))
        <div class="col-12">
            <x-admin.alert-success />
        </div>
        @endif
        <div class="col-12">
            <x-admin.card title="Manage anak cabang">
                <x-slot name="header">
                    <x-admin.modal.trigger modal-target="add-new-subadmin"
                    text="Tambah anak cabang" />
                </x-slot>

                <x-admin.table id="dataTable" :thead="['Nama', 'Username', 'Aksi']">
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            <x-admin.modal.trigger text="Hapus"
                            :is-default-style="false"
                            class="btn-small text-danger"
                            modal-target="remove-subadmin-{{ $user->id }}"/>
                        </td>
                    </tr>
                    @endforeach
                </x-admin.table>
            </x-admin.card>
        </div>
    </div>
@endsection

@section('components')
    <x-admin.modal heading="Tambah Pengguna Baru" id="add-new-subadmin">
        <form action="{{ route('admin.user.store') }}" method="post">
            @csrf
            <x-admin.input name="name" class="not-allow-number" label="People name" required/>
            <x-admin.input name="username" class="not-allow-space" 
            pattern=".{3,20}" 
            title="Username minimal 3 karakter dan maksimal 20 karakter" label="Username" required/>
            <x-admin.input name="sandi" label="Password" type="password" required/>
            <hr class="my-4">
            <x-admin.input name="kodeagen" label="Kode Agen" required/>
            <x-admin.input name="tokenkey" label="Token Key" required/>

            @include('admin.partials.helper-wa-ax')

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-admin.modal>

    @foreach ($users as $user)
        @include('admin.partials.popup-delete', [
            'id' => 'remove-subadmin-' . $user->id,
            'heading' => "Hapus Pengguna dengan Username $user->username",
            'warningMesssage' =>
                "Apakah anda yakin akan menghapus pengguna <b>$user->username</b>",
            'action' => route('admin.user.destroy', $user->id)
        ])
    @endforeach
@endsection
