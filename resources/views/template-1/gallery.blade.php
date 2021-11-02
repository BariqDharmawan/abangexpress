@extends('layouts.template-1')

@section('title', 'Gallery Kita')

@section('content')

<main class="py-5">
    <div class="container">
        @include('partials.gallery-list')
    </div>
</main>

@include('template-1.contact')

@endsection
