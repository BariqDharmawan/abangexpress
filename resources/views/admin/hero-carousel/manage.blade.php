@extends('layouts.admin')

@section('content')
<div class="col-12">

    @if (session('success'))
    <x-admin.alert-success/>
    @endif
    
    <x-admin.card title="Header Carousel">
        <x-slot name="header">
            <x-admin.modal-trigger text="Add new image"
            modal-target="add-hero-carousel-popup" />
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
            <div class="carousel-inner">
                @foreach ($heroCarousel as $carousel)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }} position-relative">
                    <img src="{{ asset($carousel->img) }}" alt="" 
                    class="d-block object-cover w-100" height="450px">
                    <button type="button" class="btn btn-danger option-slide" data-toggle="modal" data-target="#remove-hero-carousel-popup-{{ $carousel->id }}">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
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
            Ukuran aslinya adalah 1440x450
        </small>
    </x-admin.card>
</div>
@endsection

@section('components')
    <x-admin.modal id="add-hero-carousel-popup" heading="Header Carousel">
        <form method="POST" enctype="multipart/form-data" 
        action="{{ route('admin.content.carousel.store') }}">
            @csrf
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="img" 
                    id="customFile" accept="image/*" required>
                    @error('img')
                        <div class="text-danger py-2">{{ $message }}</div>
                    @enderror
                    <label class="custom-file-label" for="customFile">Choose cover</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-admin.modal>

    @foreach ($heroCarousel as $carousel)
        @include('admin.partials.popup-delete', [
            'id' => 'remove-hero-carousel-popup-' . $carousel->id,
            'heading' => "Remove slide $carousel->id",
            'warningMesssage' => 'Are you sure wana remove this slide?',
            'action' => route('admin.content.carousel.destroy', $carousel->id)
        ])  
    @endforeach
@endsection

@push('scripts')
    <script>
    </script>
@endpush