@extends('layouts.admin')
@section('content')
<div class="col-12">
    <x-admin.card title="Heading tiap section">
        @foreach ($sectionHeading as $heading)
            <x-admin.card class="mb-3" title="Section name: {{ $heading->section_name }}" :is-header-transparent="true">
                <x-slot name="header">
                    <x-admin.modal.trigger text="Edit" modal-target="edit-heading-{{ $loop->iteration }}" />
                </x-slot>
                <p class="mb-1 mt-3 font-weight-bold text-dark">First description</p>
                <small class="d-block mb-3">
                    @if ($heading->first_desc)
                    {!! $heading->first_desc !!}
                    @else
                    <span class="text-danger">No desc</span>
                    @endif
                </small>
                <p class="mb-1 font-weight-bold text-dark">Second description</p>
                <small>
                    @if ($heading->second_desc)
                    {!! $heading->second_desc !!}
                    @else
                    <span class="text-danger">No desc</span>
                    @endif
                </small>
            </x-admin.card>
        @endforeach
    </x-admin.card>
</div>
@endsection
