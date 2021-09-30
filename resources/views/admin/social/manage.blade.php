@extends('layouts/admin')

@section('content')
    <div class="row mx-0">
        <div class="col-12 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h4 mb-0">Manage our social media</h1>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-service">
                    Add new social media
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <x-admin.card>
                <ul class="list-group">
                    @foreach ($ourSocial as $social)
                    <li class="list-group-item d-flex align-items-center" >
                        <img src="{{ asset($social->icon) }}" alt="" height="30px">
                        <div class="ml-4">
                            <p class="font-weight-bold text-capitalize mb-1">
                                <a href="{{ $social->link }}" 
                                target="__blank">{{ $social->username }}</a>
                            </p>
                            <small>{{ $social->platform }}</small>
                        </div>
                        <div class="ml-auto">
                            <button class="btn btn-link text-primary" data-toggle="modal" 
                            type="button" data-target="#edit-social-{{ $loop->iteration }}">
                                Update
                            </button>
                            <button type="button" class="btn btn-link text-danger" data-toggle="modal" 
                            data-target="#remove-social-{{ $loop->iteration }}">
                                Remove
                            </button>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </x-admin.card>
        </div>
    </div>
@endsection

@section('components')
    <x-admin.modal id="add-service" heading="Add new service">
        @include('admin.social.form', ['action' => ''])
    </x-admin.modal>
    @foreach ($ourSocial as $social)
        <x-admin.modal id="edit-social-{{ $loop->iteration }}" 
            heading="Edit our {{ $social->platform }}">
            @include('admin.social.form', ['action' => '', 'data' => $social])
        </x-admin.modal>

        @include('admin.partials.popup-delete', [
            'id' => 'remove-social-' . $loop->iteration,
            'heading' => "Remove our $social->platform",
            'warningMesssage' => "Are you sure wana remove our $social->platform",
            'action' => ''
        ])
    @endforeach
@endsection