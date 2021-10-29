@extends('layouts.template-2')

@section('title', 'Gallery Kita')

@section('single-page', 'single-page')

@section('content')

<main class="py-5">
    <div class="container pt-5">
        @include('partials.gallery-list')
    </div>
</main>

@include('template-2.contact')

@endsection
