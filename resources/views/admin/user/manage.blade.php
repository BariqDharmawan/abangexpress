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
            <x-admin.input name="username" label="Username" required/>
            <x-admin.input name="sandi" label="Password" type="password" required/>
            <hr class="my-4">
            <x-admin.input name="kodeagen" label="Kode Agen" required/>
            <x-admin.input name="tokenkey" label="Token Key" required/>

            <small class="mb-4 d-block text-dark">
                Untuk mendapatkan kode agen dan token key, dapat menghubungi
                <a href="https://web.whatsapp.com/send?phone=6281278989998"
                target="_blank" class="d-none d-lg-block">
                    kami
                </a>
                <a href="https://api.whatsapp.com/send?phone=6281278989998"
                target="_blank" class="d-block d-lg-none">
                    kami
                </a>
            </small>

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
