@extends('layouts.admin')

@section('title', 'Manage our team')

@section('content')
<div class="row mx-0">
    <div class="col-12 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">Manage member</h1>
            <button type="button" class="btn btn-primary"
            data-toggle="modal" data-target="#add-new-person">
                Add new member
            </button>
        </div>
    </div>
    <div class="col-12">
        <div class="row">
            @foreach ($teams as $person)
            <div class="col-lg-3 mb-4">
                <div class="card h-full">
                    <div class="card-header">
                        <img src="{{ $person->avatar }}" height="90px" width="90px"
                        class="rounded-circle mx-auto d-block object-cover" 
                        alt="{{ $person->name }}">
                        <p class="card-text font-weight-bold h5 mb-0 mt-3 text-center">
                            {{ Str::words($person->name, 3, '') }}
                        </p>
                    </div>
                    <div class="card-body">
                        <p class="card-text font-weight-bold text-info">
                            {{ $person->position->name }}
                        </p>
                        <small>
                            Short biography: <br> {{ $person->short_desc }}
                        </small>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-transparent">
                        <button type="button" class="btn btn-link text-primary px-0"
                        data-toggle="modal" data-target="#edit-person-{{ $loop->iteration }}">
                            Edit info
                        </button>
                        <button type="button" class="btn btn-link text-danger px-0"
                        data-toggle="modal" data-target="#remove-person-{{ $loop->iteration }}">
                            Remove person
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('components')
    <x-admin.modal id="add-new-person" 
        heading="Add new member">
        @include('admin.team.form', ['action' => route('admin.team.store')])
    </x-admin.modal>
    @foreach ($teams as $person)
        <x-admin.modal id="edit-person-{{ $loop->iteration }}" 
            heading="Edit info {{ $person->name }}">
            @include('admin.team.form', [
                'action' => route('admin.team.update', $person->id),
                'data' => $person
            ])
        </x-admin.modal>

        @include('admin.partials.popup-delete', [
            'id' => 'remove-person-' . $loop->iteration,
            'heading' => 'Remove person ' . $person->name,
            'warningMesssage' => 
                'Are you sure wana remove <b>' . $person->name . '</b>' . ' from our team?',
            'action' => ''
        ])

    @endforeach
@endsection