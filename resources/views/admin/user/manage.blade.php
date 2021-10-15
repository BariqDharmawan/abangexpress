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
            <x-admin.card title="Manage our users">
                <x-slot name="header">
                    <x-admin.modal.trigger modal-target="add-new-subadmin" 
                    text="Add new sub-admin" />
                </x-slot>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" 
                    width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>
                                    <x-admin.modal.trigger text="Remove"
                                    :is-default-style="false"
                                    class="btn-small text-danger"
                                    modal-target="remove-subadmin-{{ $user->id }}"/>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-admin.card>
        </div>
    </div>
@endsection

@section('components')
    <x-admin.modal heading="Add new sub-admin" id="add-new-subadmin">
        <form action="{{ route('admin.user.store') }}" method="post">
            @csrf
            <x-admin.input name="name" class="not-allow-number" label="People name" required/>
            <x-admin.input name="username" label="Username" required/>


            <small class="d-block mb-3">
                The default password is : <b>passwordsubadmin</b>
            </small>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-admin.modal>

    @foreach ($users as $user)
        @include('admin.partials.popup-delete', [
            'id' => 'remove-subadmin-' . $user->id,
            'heading' => "Remove user $user->username",
            'warningMesssage' => 
                "Are you sure wanna remove user <b>$user->username</b>",
            'action' => route('admin.user.destroy', $user->id)
        ])
    @endforeach
@endsection