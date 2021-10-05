@extends('layouts/admin')

@section('content')
    <div class="row">
        @if (session('success'))
        <x-admin.alert-success/>
        @endif
    </div>
    <div class="row mx-0">
        <div class="col-12 mb-4">
            <x-admin.card title="Manage our contact">
                <x-slot name="header">
                    <x-admin.modal-trigger modal-target="update-contact" 
                    text="Update our contact" />
                </x-slot>
                <ul class="list-group">
                    @foreach ($columns as $column)
                        <li class="list-group-item">
                            <span class="text-capitalize">{{ $column }}</span> : 
                            {{ $contact->{$column} }}
                        </li>
                    @endforeach
                </ul>
            </x-admin.card>
        </div>
        <div class="col-12">
            <x-admin.card title="Embeded Map" class="embeded-full">
                <x-slot name="header">
                    <x-admin.modal-trigger modal-target="change-embeded" 
                    text="Change maps embeded" />
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
            
            <x-admin.input label="Our address" type="textarea" maxlength="200" 
            value="{{ $contact->address }}" name="address" required />

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
                    <x-admin.modal-trigger modal-target="how-to-embed" 
                    text="this video" :is-default-style="false" 
                    class="btn-small btn-link text-primary p-0 text-small" />
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