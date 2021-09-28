@extends('layouts.admin')

@push('style-plugins')
<link href="{{ asset('admin/template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('admin/template/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="col-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Our Identity</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Our Name</th>
                            <th>Our Vision</th>
                            <th>Slogan</th>
                            <th>Sub slogan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $identity->our_name }}</td>
                            <td>{{ Str::words($identity->our_vision, 5, '...') }}</td>
                            <td>{{ $identity->slogan }}</td>
                            <td>{{ Str::words($identity->sub_slogan, 4, '...') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="card">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Video Promo</h6>
        </div>
        <div class="card-body">
            <a href="{{ $identity->our_video }}" class="glightbox position-relative d-inline-block" data-gallery="our_video">
                <img src="https://img.youtube.com/vi/{{ Str::after($identity->our_video, 'https://www.youtube.com/watch?v=') }}/hqdefault.jpg" alt="image" />
                <img src="{{ asset('img/icon/bx-play.svg') }}" alt="" height="80px" width="80px" class="center-parent">
            </a>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="card">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Embeded Map</h6>
        </div>
        <div class="card-body">
            {!! $identity->address_embed !!}
        </div>
    </div>
</div>
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