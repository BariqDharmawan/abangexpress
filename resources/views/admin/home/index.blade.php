@extends('layouts.admin')

@section('content')
<div class="col-12">

    @if (session('success'))
    <x-admin.alert-success/>
    @endif

    <x-admin.card title="Nama kita" class="mt-5">
        <x-slot name="header">
            <x-admin.modal.trigger text="Ganti nama kita"
            modal-target="our-name" />
        </x-slot>
        <h1 class="h3">{{ $identity->our_name }}</h1>
    </x-admin.card>
    
    <x-admin.card title="Header Carousel" class="mt-5">
        <x-slot name="header">
            <x-admin.modal.trigger text="Tambah slider"
            modal-target="add-hero-carousel-popup" />
        </x-slot>

        <div id="hero-carousel" class="carousel slide" data-ride="carousel">
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
            @if (count($heroCarousel) > 1)
            <a class="carousel-control-prev" href="#hero-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#hero-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            @endif
        </div>

        <small class="text-secondary text-center d-block mt-2">
            Ukuran aslinya adalah 1440x450
        </small>
    </x-admin.card>

    <x-admin.card title="Heading" class="mt-5">
        <x-slot name="header">
            <x-admin.modal.trigger text="Ganti heading"
            modal-target="change-heading" />
        </x-slot>
        <h1 class="h3">{{ $identity->slogan }}</h1>
    </x-admin.card>
</div>
@endsection

@section('components')

    <x-admin.modal id="our-name" heading="Ganti nama kita">
        <form method="POST" enctype="multipart/form-data" 
        action="{{ route('admin.home.update') }}">
            @csrf @method('PUT')
            <div class="form-group">
                <label for="edit-sub-slogan">Heading</label>
                <input type="text" required
                class="form-control" id="edit-sub-slogan"
                name="our_name" 
                value="{{ old('our_name') ?? $identity->our_name }}">
                @error('our_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-admin.modal>

    <x-admin.modal id="add-hero-carousel-popup" heading="Header Carousel">
        <form method="POST" enctype="multipart/form-data" 
        action="{{ route('admin.content.landing-carousel.store') }}">
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
            'action' => route('admin.content.landing-carousel.destroy', $carousel->id)
        ])  
    @endforeach

    <x-admin.modal id="change-heading" heading="Change Heading">
        <form method="POST" enctype="multipart/form-data" 
        action="{{ route('admin.home.update') }}">
            @csrf @method('PUT')
            <div class="form-group">
                <label for="edit-sub-slogan">Heading</label>
                <input type="text" required
                class="form-control" id="edit-sub-slogan"
                name="slogan" 
                value="{{ old('slogan') ?? $identity->slogan }}">
                @error('slogan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-admin.modal>
@endsection

@push('scripts')
    <script>
    </script>
@endpush