@extends('layouts.admin')
@section('content')
<div class="col-12">
    <x-admin.card title="Cover Vision Mission">
        <div class="row flex-column flex-lg-row">
            <div class="col">
                <img src="{{ $cover }}" alt="" height="300px" class="img-fluid">
            </div>
            <div class="col d-flex align-items-center justify-content-center border-left">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#change-cover-vision-mission">
                    Change
                </button>
            </div>
        </div>
    </x-admin.card>
</div>
@endsection
@section('components')
    <x-admin.modal id="change-cover-vision-mission" heading="Change cover">
        <form method="POST" enctype="multipart/form-data" action="">
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="cover" required>
                    <label class="custom-file-label" for="cover">Choose cover</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-admin.modal>
@endsection