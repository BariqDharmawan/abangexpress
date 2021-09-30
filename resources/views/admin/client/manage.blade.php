@extends('layouts.admin')

@section('content')
<div class="col-12">
    <x-admin.card title="Our Client">
        <x-slot name="header">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-client">
                Add new
            </button>
        </x-slot>
        <div class="row">
            @foreach ($clients as $client)
            <div class="col-lg-3 mb-4">
                <div class="card p-3" style="height: 100%">
                    <img src="{{ $client->logo }}" class="card-img-top" alt="">
                    <div class="card-body pt-5 px-0 pb-0 d-flex align-items-end 
                    justify-content-between">
                        <h5 class="card-title m-0">{{ $client->name }}</h5>
                        <div class="btn-group dropup">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                            <div class="dropdown-menu">
                                <button class="dropdown-item text-primary" 
                                data-toggle="modal" type="button"
                                data-target="#edit-client-{{ $loop->iteration }}">
                                    Click to edit
                                </button>
                                <form action="" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="button" 
                                    class="dropdown-item text-danger" data-toggle="modal" 
                                    data-target="#remove-client-{{ $loop->iteration }}">
                                        Click to remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </x-admin.card>
</div>
@endsection

@section('components')
    <x-admin.modal id="add-client" heading="Add new client">
        @include('admin.client.form', ['action' => '', 'client' => ''])
    </x-admin.modal>

    @foreach ($clients as $client)
        <x-admin.modal id="edit-client-{{ $loop->iteration }}" heading="Add new client">
            @include('admin.client.form', ['action' => '', 'data' => $client])
        </x-admin.modal>

        @include('admin.partials.popup-delete', [
            'id' => 'remove-client-' . $loop->iteration,
            'heading' => 'Remove client',
            'warningMesssage' => 'Are you sure wana remove client <b>' . $client->name . '</b>?',
            'action' => ''
        ])
    @endforeach
@endsection