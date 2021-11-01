@extends('layouts/admin')

@section('title', 'Kontak')

@section('content')
    @if (session('success'))
    <div class="row mx-0">
        <div class="col-12">
            <x-admin.alert-success/>
        </div>
    </div>
    @endif
    <div class="row mx-0">

        @include('admin.partials.card-change-section', ['side' => 'b', 'sectionDesc' => $sectionDesc])

        <div class="col-12 mb-4">
            <x-admin.card title="Kontak kami">
                <x-slot name="header">
                    <x-admin.modal.trigger modal-target="update-contact"
                    text="Ubah kontak kami" />
                </x-slot>
                <ul class="list-group">
                    @isset($contact)
                        @foreach ($columns as $key => $column)
                            <li class="list-group-item">
                                <span class="text-capitalize">
                                    {{ $titles[$key] }}
                                </span> :
                                @if ($column == 'telephone')
                                    {{ '+62' . $contact->{$column} }}
                                @else
                                    {{ $contact->{$column} }}
                                @endif
                            </li>
                        @endforeach
                    @endisset
                </ul>
            </x-admin.card>
        </div>
        @isset($addressEmbed)
        <div class="col-12">
            <x-admin.card title="Maps embed" class="embeded-full">
                <x-slot name="header">
                    <x-admin.modal.trigger modal-target="change-embeded"
                    text="Ubah maps embed" />
                </x-slot>
                {!! $addressEmbed !!}
            </x-admin.card>
        </div>
        @endisset
    </div>
@endsection

@section('components')

    <x-admin.modal id="change-desc-heading" heading="Ubah deskripsi dan heading">
        <form action="{{ route('admin.content.section-heading.update') }}" method="POST">
            @csrf @method('PUT')

            <x-admin.input label="Heading Title" name="our_contact_title"
            value="{{ $sectionTitle }}"  required />

            <x-admin.input label="Deskripsi" type="textarea" name="our_contact_first_desc"
            value="{{ $sectionDesc }}"  required />

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-admin.modal>

    {{-- @include('admin.partials.change-heading-desc') --}}

    @isset($contact)
        <x-admin.modal id="update-contact" heading="Change contact">
            <form method="POST" enctype="multipart/form-data"
            action="{{ route('admin.our-contact.update') }}" data-modal-id="update-contact">
                @csrf @method('PUT')

                <x-admin.input label="Alamat" type="textarea" maxlength="200"
                value="{{ $contact->address }}" name="address" required />

                <x-admin.input label="Link google maps" type="url"
                value="{{ $contact->link_address }}" name="link_address"
                title="Link should be start with 'https://'"
                pattern="^(http(s)?:\/\/)+[\w\-\._~:\/?#[\]@!\$&'\(\)\*\+,;=.]+$" inputmode="url" required />

                <div class="form-group">
                    <label for="our-telephone">Telepon</label>
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

                <x-admin.input label="Email" type="email" name="email"
                value="{{ $contact->email }}"
                title="Email harus menggunakan valid email dengan domain
                (.com, .co.id, dll)"
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                inputmode="email" required />

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </x-admin.modal>
    @endisset

    @isset($addressEmbed)
        <x-admin.modal id="change-embeded" heading="Ubah embeded map">
            <form action="{{ route('admin.about-us.update-embed-map') }}" method="POST" data-modal-id="change-embeded">
                @csrf @method('PUT')

                <div class="form-group">
                    <label for="edit-contact-addres">
                        Masukan embed map disini
                    </label>
                    <textarea name="address_embed" id="address-embed"
                    rows="10" class="form-control"
                    title="Please input valid embed script" required>{{ $addressEmbed }}</textarea>
                    @error('address_embed')
                        <div class="text-danger py-2">{{ $message }}</div>
                    @enderror
                    <small class="mr-1 text-muted">
                        Untuk mengetahui cara embed, lihatlah
                        <x-admin.modal.trigger modal-target="how-to-embed"
                        text="video ini" :is-default-style="false"
                        class="btn-small btn-link text-primary p-0 text-small" />
                    </small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </x-admin.modal>

        <x-admin.modal id="how-to-embed" heading="Cara embed map" size="lg">
            <video src="{{ asset('video/cara-embed-map.mp4') }}" width="100%"
            height="500px" autoplay muted draggable="false" loop controls></video>
        </x-admin.modal>
    @endisset

@endsection
