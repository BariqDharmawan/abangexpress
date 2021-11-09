@extends('layouts.admin')

@section('title', 'Item Unit For Invoice')

@section('content')
<div class="col-12">
    <x-admin.card title="Item Unit Invoice">
        <x-slot name="header">
            <x-admin.modal.trigger modal-target="add-new-unit"
            text="Tambah unit" />
        </x-slot>
        <ul class="list-group">
            @foreach ($units as $unit)
            <li class="list-group-item d-flex align-items-center">
                <span>{{ $unit->name }}</span>

                <div class="ml-auto">
                    <x-admin.modal.trigger :is-default-style="false"
                    class="btn-link text-primary" text="Ubah"
                    modal-target="edit-unit-{{ $loop->iteration }}" />

                    <x-admin.modal.trigger :is-default-style="false"
                    class="btn-link text-danger" text="Hapus"
                    modal-target="remove-unit-{{ $loop->iteration }}" />
                </div>
            </li>
            @endforeach
        </ul>
    </x-admin.card>
</div>
@endsection

@section('components')
    <x-admin.modal id="add-new-unit" heading="Tambah unit baru">
        @include('admin.unit.form', ['action' => route('admin.item-unit.store')])
    </x-admin.modal>

    @foreach ($units as $unit)
        <x-admin.modal id="edit-unit-{{ $loop->iteration }}" heading="Ubah unit {{ $unit->name }}">
            @include('admin.unit.form', ['action' => route('admin.item-unit.update', $unit->id), 'data' => $unit])
        </x-admin.modal>

        @include('admin.partials.popup-delete', [
            'id' => 'remove-unit-' . $loop->iteration,
            'heading' => "Hapus unit $unit->name",
            'warningMesssage' => "Apakah kamu yakin ingin menghapus unit <b>$unit->name</b>",
            'action' => route('admin.item-unit.destroy', $unit->id)
        ])
    @endforeach
@endsection
