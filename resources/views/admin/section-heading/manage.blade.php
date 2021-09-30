@extends('layouts.admin')
@section('content')
<div class="col-12">
    <x-admin.card title="Heading each section">
            @foreach ($sectionHeading as $heading)
            <x-admin.card class="mb-3" title="Section name: {{ $heading->section_name }}" :is-header-transparent="true">
                <x-slot name="header">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-heading-{{ $loop->iteration }}">
                        Edit
                    </button>
                </x-slot>
                <p class="mb-1 mt-3 font-weight-bold text-dark">First description</p>
                <small class="d-block mb-3">
                    @if ($heading->first_desc)
                    {{ $heading->first_desc }}
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

@section('components')
    @foreach ($sectionHeading as $heading)
        <x-admin.modal id="edit-heading-{{ $loop->iteration }}" 
        heading="Heading {!! '<b>' . $heading->section_name . '</b>' !!}">
            <form method="POST" enctype="multipart/form-data" action="">
                <div class="form-group">
                    <label for="section-name">Heading title</label>
                    <input type="text" class="form-control"
                    id="section-name" name="name" 
                    value="{{ $heading->section_name }}" required>
                </div>
                @if ($heading->first_desc)
                <div class="form-group">
                    <label for="section-first-desc">Heading first description</label>
                    <textarea name="first_desc" id="section-first-desc" 
                    rows="3" class="form-control summernote" 
                    style="resize: none;" required>{{ $heading->first_desc }}</textarea>
                </div>
                @endif
                @if ($heading->second_desc)
                <div class="form-group">
                    <label for="section-first-desc">Heading second description</label>
                    <textarea name="first_desc" id="section-first-desc" 
                    rows="3" class="form-control summernote" 
                    style="resize: none;" required>{{ $heading->second_desc }}</textarea>
                </div>
                @endif
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </x-admin.modal>
    @endforeach
@endsection