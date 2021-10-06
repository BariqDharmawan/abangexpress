@extends('layouts.admin')
@section('content')

@if (session('success'))
<div class="row mx-0">
    <div class="col-12">
        <x-admin.alert-success/>
    </div>
</div>
@endif

<div class="col-12">
    <x-admin.card title="Cover Vision Mission">
        <div class="row flex-column flex-lg-row">
            <div class="col">
                <img src="{{ $cover }}" alt="" height="300px" class="img-fluid">
            </div>
            <div class="col d-flex align-items-center justify-content-center border-left">
                <x-admin.modal.trigger text="Change"
                modal-target="change-cover-vision-mission" />
            </div>
        </div>
    </x-admin.card>
</div>
@endsection
@section('components')
    <x-admin.modal id="change-cover-vision-mission" heading="Change cover">
        <form method="POST" enctype="multipart/form-data" 
        action="{{ route('admin.content.cover-vision-mission.update') }}">
            @csrf @method('PUT')
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input"
                    name="cover_vision_mission" id="cover" required>
                    <label class="custom-file-label" for="cover">Choose cover</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-admin.modal>
@endsection