@extends('layouts.admin')

@section('content')
<div class="col-12">
    <x-admin.card title="Header Carousel">
        <x-slot name="header">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-hero-carousel-popup">
                Add new image
            </button>
        </x-slot>

        <div id="hero-carousel" class="carousel slide" data-ride="carousel">
            @if (isset($isIndicatorHidden) and $isIndicatorHidden)
                <ol class="carousel-indicators">
                    @foreach ($heroCarousel as $carousel)
                    <li data-target="#hero-carousel" data-slide-to="{{ $loop->index }}" 
                    class="@if($loop->first) active @endif"></li>
                    @endforeach
                </ol>
            @endif
            <div class="carousel-inner position-relative">
                @foreach ($heroCarousel as $carousel)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ asset($carousel->img) }}" alt="" 
                    class="d-block w-100" height="{{ $height ?? '450px' }}">
                </div>
                <button type="button" class="btn btn-danger option-slide" data-toggle="modal" data-target="#remove-hero-carousel-popup-{{ $loop->iteration }}">
                    <i class="fas fa-trash"></i>
                </button>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#hero-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#hero-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <small class="text-secondary text-center d-block mt-2">
            Ukuran aslinya adalah 1440x430
        </small>
    </x-admin.card>
</div>
@endsection

@section('components')
    <x-admin.modal id="add-hero-carousel-popup" heading="Header Carousel">
        <form method="POST" enctype="multipart/form-data" action="">
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" required>
                    <label class="custom-file-label" for="customFile">Choose cover</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-admin.modal>

    @foreach ($heroCarousel as $slide)
        @include('admin.partials.popup-delete', [
            'id' => 'remove-hero-carousel-popup-' . $loop->iteration,
            'heading' => "Remove slide $slide->id",
            'warningMesssage' => 'Are you sure wana remove this slide?',
            'action' => route('admin.content.carousel.destroy', $slide->id)
        ])  
    @endforeach
@endsection