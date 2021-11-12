@extends('layouts.admin')

@section('title', 'Layanan Kami')

@section('content')

@if (session('success'))
<div class="row mx-0">
    <div class="col-12">
        <x-admin.alert-success/>
    </div>
</div>
@endif

@include('admin.partials.card-change-section', ['side' => 'b'])

<div class="col-12">

    <x-admin.card title="Layanan Kami">
        <x-slot name="header">
            <x-admin.modal.trigger text="Tambah layanan baru"
            modal-target="add-service" />
        </x-slot>
        <ul class="list-group">
            @foreach ($ourService as $service)
            <li class="list-group-item d-flex align-items-center" data-id="{{ $service->id }}">
                <span class="h3">
                    <i class="{{ $service->icon }}"></i>
                </span>
                <div class="ml-4">
                    <p class="font-weight-bold text-capitalize mb-1">{{ $service->title }}</p>
                    <small>{{ $service->desc }}</small>
                </div>
                <div class="ml-auto">
                    <x-admin.modal.trigger :is-default-style="false"
                    class="btn-link text-primary" text="Ubah"
                    modal-target="edit-service-{{ $service->id }}" />

                    <x-admin.modal.trigger :is-default-style="false"
                    class="btn-link text-danger" text="Hapus"
                    modal-target="remove-service-{{ $service->id }}" />
                </div>
            </li>
            @endforeach
        </ul>
    </x-admin.card>
</div>
@endsection
@section('components')

    <x-admin.modal id="change-desc-heading" heading="Ubah deskripsi dan heading">
        <form action="{{ route('admin.content.section-heading.update') }}" method="POST">
            @csrf @method('PUT')

            <x-admin.input label="Heading Title" name="our_service_title"
            value="{{ $sectionTitle }}"  required />

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-admin.modal>

    {{-- @include('admin.partials.change-heading-desc') --}}

    <x-admin.modal id="add-service" heading="Tambah layanan baru">
        @include('admin.services.form', ['action' => route('admin.services.store')])
    </x-admin.modal>
    @foreach ($ourService as $service)
        <x-admin.modal id="edit-service-{{ $service->id }}"
            heading="Ubah service {{ $service->title }}">
            @include('admin.services.form', [
                'action' => route('admin.services.update', $service->id),
                'data' => $service
            ])
        </x-admin.modal>

        @include('admin.partials.popup-delete', [
            'id' => 'remove-service-' . $service->id,
            'heading' => 'Hapus service',
            'warningMesssage' =>
                'Apakah kamu yakin ingin menghapus layanan <b>'
                . $service->title . '</b>?',
            'action' => route('admin.services.destroy', $service->id)
        ])
    @endforeach
@endsection
