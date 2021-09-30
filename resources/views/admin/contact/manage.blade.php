@extends('layouts/admin')

@section('content')
    <div class="row mx-0">
        <div class="col-12">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
        </div>
        <div class="col-12 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h4 mb-0">Manage our contact</h1>
                <button type="button" class="btn btn-primary" 
                data-toggle="modal" data-target="#update-contact">
                    Update our contact
                </button>
            </div>
        </div>
        <div class="col-12 mb-4">
            <ul class="list-group">
                @foreach ($columns as $column)
                    <li class="list-group-item">
                        <span class="text-capitalize">{{ $column }}</span> : 
                        {{ $contact->{$column} }}
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-12">
            <x-admin.card title="Embeded Map">
                <x-slot name="header">
                    <button type="button" class="btn btn-primary" 
                        data-toggle="modal" data-target="#change-embeded">
                        Change maps embeded
                    </button>
                </x-slot>
                {!! $addressEmbed !!}
            </x-admin.card>
        </div>
    </div>
@endsection

@section('components')
    <x-admin.modal id="update-contact" heading="Change contact">
        <form method="POST" enctype="multipart/form-data" 
        action="{{ route('admin.our-contact.update') }}" data-modal-id="update-contact">
            @csrf @method('PUT')
            <div class="form-group">
                <label for="edit-contact-addres">Our address</label>
                <textarea name="address" id="edit-contact-addres" rows="4" 
                class="form-control"
                maxlength="200" required>{{ old('address') ?? $contact->address }}</textarea>
                @error('address')
                    <div class="text-danger py-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="edit-contact-url">Maps address link</label>
                <input type="url" class="form-control" inputmode="url" id="edit-contact-url" name="link_address" value="{{ $contact->link_address }}" 
                title="Link should be start with 'https://'"
                pattern="^(http(s)?:\/\/)+[\w\-\._~:\/?#[\]@!\$&'\(\)\*\+,;=.]+$" required>
                @error('link_address')
                    <div class="text-danger py-2">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="form-group">
                <label for="our-telephone">Our telephone</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">+62</div>
                    </div>
                    <input type="text" class="form-control" name="telephone" 
                    id="our-telephone" value="{{ old('telephone') ?? $contact->telephone }}"
                    pattern="^(?!62)(?!0)\w+$"
                    title="No need to start with '62' or '0'" required>
                </div>
                @error('telephone')
                    <div class="text-danger py-2">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="form-group">
                <label for="edit-contact-email">Our email</label>
                <input type="email" class="form-control" inputmode="email" id="edit-contact-email" name="email" 
                value="{{ old('email') ?? $contact->email }}"
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                title="Email should be a valid email with domain (.com, .co.id, etc)" required>
                @error('email')
                    <div class="text-danger py-2">{{ $message }}</div>
                @enderror
            </div>
        
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-admin.modal>

    <x-admin.modal id="change-embeded" heading="Change embeded map">
        <form action="{{ route('admin.about-us.update-embed-map') }}" method="POST" data-modal-id="change-embeded">
            @csrf @method('PUT')
            <div class="form-group">
                <label for="edit-contact-addres">Put the embeded script here</label>
                <textarea name="address_embed" id="address-embed" 
                rows="10" class="form-control"
                title="Please input valid embed script" required>{{ $addressEmbed }}</textarea>
                @error('address_embed')
                    <div class="text-danger py-2">{{ $message }}</div>
                @enderror
                <small class="mr-1 text-muted">
                    To know how to embed google map, please see
                    <button type="button" class="btn btn-small btn-link text-primary p-0" 
                    data-toggle="modal" data-target="#how-to-embed">
                        <small>this video</small>
                    </button>
                </small>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-admin.modal>

    <x-admin.modal id="how-to-embed" heading="How to embeded map" size="lg">
        <video src="{{ asset('video/cara-embed-map.mp4') }}" width="100%" 
        height="500px" autoplay muted draggable="false" loop controls></video>
    </x-admin.modal>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $("form").each(function () {
                if ($(this).find('.text-danger').length) {
                    $(this).parents('.modal').modal('show')
                }
            })
        })
    </script>
@endpush