@extends('layouts/admin')

@section('content')
    <div class="row mx-0">
        <div class="col-12">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
        </div>
        <div class="col-12 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h4 mb-0">Manage our contact</h1>
                <button type="button" class="btn btn-primary" 
                data-toggle="modal" data-target="#update-contact">
                    Update our contact
                </button>
            </div>
        </div>
        <div class="col-12 mb-4">
            <ul class="list-group">
                @foreach ($columns as $column)
                    <li class="list-group-item">
                        <span class="text-capitalize">{{ $column }}</span> : 
                        {{ $contact->{$column} }}
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-12">
            <x-admin.card title="Embeded Map">
                <x-slot name="header">
                    <button type="button" class="btn btn-primary" 
                        data-toggle="modal" data-target="#change-embeded">
                        Change maps embeded
                    </button>
                </x-slot>
                {!! $addressEmbed !!}
            </x-admin.card>
        </div>
    </div>
@endsection

@section('components')
    <x-admin.modal id="update-contact" heading="Change contact">
        @include('admin.contact.form', [
            'action' => route('admin.our-contact.update'),
            'data' => $contact
        ])
    </x-admin.modal>

    <x-admin.modal id="change-embeded" heading="Change embeded map">
        <form action="" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label for="edit-contact-addres">Put the embeded script here</label>
                <textarea name="address_embed" id="address-embed" 
                rows="10" class="form-control" minlength="361" 
                title="Please input valid embed script" required>{{ $addressEmbed }}</textarea>
                <small class="mr-1 text-muted">
                    To know how to embed google map, please see
                    <button type="button" class="btn btn-small btn-link text-primary p-0" 
                    data-toggle="modal" data-target="#how-to-embed">
                        <small>this video</small>
                    </button>
                </small>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-admin.modal>

    <x-admin.modal id="how-to-embed" heading="How to embeded map" size="lg">
        <video src="{{ asset('video/cara-embed-map.mp4') }}" width="100%" 
        height="500px" autoplay muted draggable="false" loop controls></video>
    </x-admin.modal>
@endsection