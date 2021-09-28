@extends('layouts.admin')

@section('content')
<div class="col-12">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Our Client</h6>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($clients as $client)
                <div class="col-lg-3 mb-4">
                    <div class="card p-3" style="height: 100%">
                        <img src="{{ $client->logo }}" class="card-img-top" alt="">
                        <div class="card-body pt-5 px-0 pb-0 d-flex align-items-end 
                        justify-content-center">
                            <h5 class="card-title m-0">{{ $client->name }}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection