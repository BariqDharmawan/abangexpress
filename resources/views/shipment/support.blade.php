@extends('layouts.shipment')

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
                @isset ($pdf)
                <div class="preview-pdf preview-pdf--full preview-pdf--without-header" id="pdf"
                data-pdf-src="{{ Storage::url($pdf) }}"></div>
                @else
                <div>
                    Tidak ada PDF mengenai {{ $title }}
                </div>
                @endisset
            </div>
        </div>
    </div>
@endsection
