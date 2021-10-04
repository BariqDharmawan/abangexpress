@extends('layouts.admin')

@push('style-plugins')
<link href="{{ asset('admin/template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('admin/template/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
@endpush

@section('content')

@if (session('success'))
<div class="col-12 mt-4">
    <x-admin.alert-success/>
</div>
@endif

<div class="col-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Our Identity</h6>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-idendity">
                Update our identity
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Our Name</th>
                            <th>Our Vision</th>
                            <th>Our Mission</th>
                            <th>Slogan</th>
                            <th>Sub slogan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $identity->our_name }}</td>
                            <td>{{ Str::words($identity->our_vision, 5, '...') }}</td>
                            <td>{!! $identity->our_mission  !!}</td>
                            <td>{{ $identity->slogan }}</td>
                            <td>{{ Str::words($identity->sub_slogan, 4, '...') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="col-12 my-5">
    <div class="card">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Video Promo</h6>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#change-video-popup">
                Change video
            </button>
        </div>
        <div class="card-body">
            <a href="{{ $identity->our_video }}" class="glightbox position-relative d-inline-block" data-gallery="our_video">
                <img src="https://img.youtube.com/vi/{{ Str::after($identity->our_video, 'https://www.youtube.com/watch?v=') }}/hqdefault.jpg" alt="image" />
                <img src="{{ asset('img/icon/bx-play.svg') }}" alt="" height="80px" width="80px" class="center-parent">
            </a>
        </div>
    </div>
</div>
@endsection

@section('components')
    <x-admin.modal id="edit-idendity" heading="Edit our idendity" size="">
        <form method="POST" enctype="multipart/form-data" 
        action="{{ route('admin.about-us.update') }}">
            @csrf @method('PUT')
            <div class="form-group">
                <label for="edit-identity-name">Our name</label>
                <input type="text" class="form-control" 
                id="edit-identity-name" 
                name="our_name" value="{{ old('our_name') ?? $identity->our_name }}" required>
                @error('our_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="form-group">
                <label for="edit-identity-vision">
                    Our Vision
                </label>
                <input type="text" class="form-control" 
                id="edit-identity-vision" name="our_vision" required
                value="{{ old('our_vision') ?? $identity->our_vision }}">
        
                @error('username')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="form-group">
                <label for="edit-mission">Our Mission</label>
                <textarea name="our_mission" id="edit-mission" 
                class="form-control summernote" 
                style="resize: none;" rows="3"
                required>{{ old('our_mission') ?? $identity->our_mission }}</textarea>
            </div>

            <div class="form-group">
                <label for="edit-sub-slogan">Our Sub Slogan</label>
                <input type="text" required
                class="form-control" id="edit-sub-slogan" 
                name="sub_slogan" value="{{ old('sub_slogan') ?? $identity->sub_slogan }}">
                @error('sub_slogan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-admin.modal>

    <x-admin.modal id="change-video-popup" heading="Change video promo" size="">
        <form action="{{ route('admin.about-us.update') }}" method="post">
            @csrf @method('PUT')
            <div class="form-group">
                <label for="edit-video-promo">
                    Video promo
                </label>
                <input type="url" class="form-control" 
                id="edit-video-promo" name="our_video" required
                value="{{ old('our_video') ?? $identity->our_video }}">
                @error('our_video')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-admin.modal>
@endsection

@push('scripts')
    <script src="{{ asset('admin/template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/template/js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('admin/template/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script>
        /**
         * Initiate  glightbox 
         */
        const glightbox = GLightbox({
            selector: '.glightbox'
        });
    </script>
@endpush