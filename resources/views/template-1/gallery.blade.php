@extends('layouts.template-1')

@section('title', 'Gallery Kita')

@section('content')

<main class="py-5">
    <div class="container">
        @include('partials.gallery-list')
    </div>
</main>

@include('partials.contact', ['sectionName' => $sectionName])

@endsection
