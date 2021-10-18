@extends('layouts.admin')

@section('title', 'Manage our team')

@section('content')
<div class="row mx-0">
    <div class="col-12 mb-4">
        @if (session('success'))
        <x-admin.alert-success/>
        @endif
    </div>

    @include('admin.partials.card-change-section', ['side' => 'b'])

    <div class="col-12 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">Team kami</h1>

            <x-admin.modal.trigger text="Tambah member"
            modal-target="add-new-person" />
        </div>
    </div>

    <div class="col-12 px-0">
        <div class="row mx-0">
            @foreach ($teams as $person)
            <div class="col-lg-3 mb-4">
                <div class="card h-full">
                    <div class="card-header">
                        <img src="{{ $person->avatar }}" height="90px" width="90px"
                        class="rounded-circle mx-auto d-block object-cover" 
                        alt="{{ $person->name }}">
                        <p class="card-text font-weight-bold h5 mb-0 mt-3 text-center">
                            {{ Str::words($person->name, 3, '...') }}
                        </p>
                    </div>
                    <div class="card-body">
                        <p class="card-text font-weight-bold text-info">
                            {{ $person->position->name }}
                        </p>
                        <small>
                            Deskripsi singkat <br> {{ $person->short_desc }}
                        </small>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-transparent">
                        
                        <x-admin.modal.trigger text="Ubah info"
                        modal-target="edit-person-{{ $loop->iteration }}"
                        :is-default-style="false"
                        class="btn-link text-primary px-0" />

                        <x-admin.modal.trigger text="Hapus person"
                        modal-target="remove-person-{{ $loop->iteration }}"
                        :is-default-style="false"
                        class="btn-link text-danger px-0" />
                        
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection

@section('components')

    @include('admin.partials.change-heading-desc')
    
    <x-admin.modal id="add-new-person" 
        heading="Tambah member baru">
        @include('admin.team.form', ['action' => route('admin.team.store')])
    </x-admin.modal>

    @foreach ($teams as $person)
        <x-admin.modal id="edit-person-{{ $loop->iteration }}" 
            heading="Ubah info {{ $person->name }}">
            @include('admin.team.form', [
                'action' => route('admin.team.update', $person->id),
                'data' => $person
            ])
        </x-admin.modal>

        @include('admin.partials.popup-delete', [
            'id' => 'remove-person-' . $loop->iteration,
            'heading' => 'Hapus member ' . $person->name,
            'warningMesssage' => 
                'Apakah kamu yakin ingin menghapus member <b>' 
                . $person->name . '</b>' . ' from our team?',
            'action' => route('admin.team.destroy', $person->id)
        ])

    @endforeach
@endsection