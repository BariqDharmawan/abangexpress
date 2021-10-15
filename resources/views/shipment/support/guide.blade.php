@extends('layouts/shipment')

@section('title', $title)

@section('content')
    <div class="card">
        <div class="body p-0">
            <iframe src="{{ Storage::url('files/dummies.pdf') }}" 
            frameborder="0" class="preview-pdf preview-pdf--full"></iframe>
        </div>
    </div>
@endsection