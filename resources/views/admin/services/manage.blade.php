@extends('layouts.admin')
@section('content')

@if (session('success'))
<div class="row">
    <div class="col-12">
        <x-admin.alert-success/>
    </div>
</div>
@endif
<div class="col-12">
    <x-admin.card title="Our service">
        <x-slot name="header">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-service">
                Add new
            </button>
        </x-slot>
        <ul class="list-group">
            @foreach ($ourService as $service)
            <li class="list-group-item d-flex align-items-center" data-id="{{ $service->id }}">
                <i class="{{ $service->icon }} h3"></i>
                <div class="ml-4">
                    <p class="font-weight-bold text-capitalize mb-1">{{ $service->title }}</p>
                    <small>{{ $service->desc }}</small>
                </div>
                <div class="ml-auto">
                    <button type="button" class="btn btn-link text-primary" data-toggle="modal" data-target="#edit-service-{{ $loop->iteration }}">
                        Change
                    </button>
                    <button type="button" class="btn btn-link text-danger" data-toggle="modal" data-target="#remove-service-{{ $loop->iteration }}">
                        Remove
                    </button>
                </div>
            </li>
            @endforeach
        </ul>
    </x-admin.card>
</div>
@endsection
@section('components')
    <x-admin.modal id="add-service" heading="Add new service">
        @include('admin.services.form', ['action' => route('admin.services.store')])
    </x-admin.modal>
    @foreach ($ourService as $service)
        <x-admin.modal id="edit-service-{{ $loop->iteration }}" 
            heading="Edit service {{ $service->title }}">
            @include('admin.services.form', [
                'action' => route('admin.services.update', $service->id),
                'data' => $service
            ])
        </x-admin.modal>

        @include('admin.partials.popup-delete', [
            'id' => 'remove-service-' . $loop->iteration,
            'heading' => 'Remove service',
            'warningMesssage' => 
                'Are you sure wana remove service <b>' . $service->title . '</b>?',
            'action' => route('admin.services.destroy', $service->id)
        ])
    @endforeach
@endsection