@extends('layouts/shipment')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>{{ $title }}</h2>
            </div>
            {{-- buat component filter dsbnya --}}
            <div class="header"></div>
            <div class="body text-center">
                <div class="preview-pdf preview-pdf--full preview-pdf--without-header" id="pdf-guide" data-pdf-src="{{ Storage::url('files/dummies.pdf') }}"></div>
            </div>
        </div>
    </div>
@endsection