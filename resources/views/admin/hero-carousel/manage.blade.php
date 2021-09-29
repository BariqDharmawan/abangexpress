@extends('layouts.admin')

@section('content')
<div class="col-12">
    <x-admin.card title="Header Carousel">
        <x-slot name="header">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#hero-carousel">
                Add new slide
            </button>
        </x-slot>

        <x-admin.carousel carousel-name="hero-carousel" 
        :contents="$heroCarousel" field-img="img" />

        <small class="text-secondary text-center d-block mt-2">
            Ukuran aslinya adalah 1440x430
        </small>
    </x-admin.card>
</div>
@endsection

@section('components')
    @include('admin.hero-carousel.add')
@endsection