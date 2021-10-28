@extends('layouts.template-1')

@section('content')
<section id="about">
    <div class="container" data-aos="fade-up" id="fade-up-about">
        <div class="row">
            <div class="col-12 about-img justify-content-center d-flex">
                @isset($aboutUs)
                <img height="350px" src="{{ asset('storage/' .
                str_replace('public/', '', $aboutUs->cover_vision_mission)) }}" alt="">
                @endisset
            </div>

            <div class="col-12 content">
                <x-section-header text="{{ $landingSection[0]->section_name }}"
                desc="{!! $landingSection[0]->first_desc !!}" class="text-center my-5" />
                <div class="row mt-4">
                    @isset($aboutUs)
                        <div class="col-lg">
                            <h5 class="fw-bold text-primary">Visi Kami</h5>
                            <p>{{ $aboutUs->our_vision }}</p>
                        </div>
                        <div class="col-lg">
                            <h5 class="fw-bold text-primary">Misi Kami</h5>
                            {!! $aboutUs->our_mission  !!}
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</section>

@include('partials.contact')

@endsection
