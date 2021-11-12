@extends('layouts.admin')

@section('title', 'Manage member')

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
            <h1 class="h4 mb-0">Daftar Member</h1>

            <x-admin.modal.trigger text="Tambah member"
            modal-target="add-new-person" />
        </div>
    </div>

    <div class="col-12 px-0">
        <div class="row mx-0">
            @forelse ($teams as $person)
            <div class="col-lg-3 mb-4">
                <x-admin.card title="{{ Str::words($person->name, 3, '...') }}"
                :reverse-header="true"
                footer-class="d-flex justify-content-between bg-transparent">
                    <x-slot name="header">
                        <img src="{{ asset($person->avatar) }}"
                        height="90px" width="90px"
                        class="rounded-circle mx-auto d-block object-cover mb-3"
                        alt="{{ $person->name }}">
                    </x-slot>

                    <p class="card-text font-weight-bold text-info">
                        {{ $person->position->name }}
                    </p>
                    <small>
                        Deskripsi singkat <br> {{ $person->short_desc }}
                    </small>

                    <x-slot name="footer">
                        <x-admin.modal.trigger text="Ubah info"
                        modal-target="edit-person-{{ $person->id }}"
                        :is-default-style="false"
                        class="btn-link text-primary px-0" />

                        <x-admin.modal.trigger text="Hapus person"
                        modal-target="remove-person-{{ $person->id }}"
                        :is-default-style="false"
                        class="btn-link text-danger px-0" />
                    </x-slot>

                </x-admin.card>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info show text-center" role="alert">
                    Tidak ada data member, silahkan tambah member
                </div>
            </div>
            @endforelse
        </div>
    </div>

</div>
@endsection

@section('components')

    <x-admin.modal id="change-desc-heading" heading="Ubah deskripsi dan heading">
        <form action="{{ route('admin.content.section-heading.update') }}" method="POST">
            @csrf @method('PUT')

            <x-admin.input label="Heading Title" name="our_team_title"
            value="{{ $sectionTitle }}"  required />

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-admin.modal>

    {{-- @include('admin.partials.change-heading-desc') --}}

    <x-admin.modal id="add-new-person"
        heading="Tambah member baru">
        @include('admin.team.form', ['action' => route('admin.team.store')])
    </x-admin.modal>

    @foreach ($teams as $person)
        <x-admin.modal id="edit-person-{{ $person->id }}"
            heading="Ubah info {{ $person->name }}">
            @include('admin.team.form', [
                'action' => route('admin.team.update', $person->id),
                'data' => $person
            ])
        </x-admin.modal>

        @include('admin.partials.popup-delete', [
            'id' => 'remove-person-' . $person->id,
            'heading' => 'Hapus member ' . $person->name,
            'warningMesssage' =>
                'Apakah kamu yakin ingin menghapus member <b>'
                . $person->name . '</b>' . ' from our team?',
            'action' => route('admin.team.destroy', $person->id)
        ])

    @endforeach
@endsection
