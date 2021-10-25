@extends('layouts.admin')

@section('title', 'Tentang kita')

@section('content')

@if (session('success'))
<div class="col-12 mt-4">
    <x-admin.alert-success/>
</div>
@endif

<div class="col-12">

    <x-admin.card title="Tentang kita" class="mb-4">
        <x-slot name="header">
            <x-admin.modal.trigger text="Ubah tentang kita"
            modal-target="edit-idendity" />
        </x-slot>

        <x-admin.table class="datatable-disable-pagination-ordering" :thead="[
            'Our Vision',
            'Our Mission',
            'Heading',
            'Deskripsi 1',
            'Deskripsi 2',
            'Video / gambar'
        ]">
            <tr>
                <td>{{ Str::words($identity->our_vision, 5, '...') }}</td>
                <td>{!! $identity->our_mission  !!}</td>
                <td>{{ $aboutUs->section_name }}</td>
                <td>{!! $aboutUs->first_desc !!}</td>
                <td>{!! $aboutUs->second_desc !!}</td>
                <td>
                    @if ($identity->our_video)
                        <a href="{{ $identity->our_video }}" 
                        target="_blank">
                            Lihat video
                        </a>
                    @else
                        <img alt="" height="100px"
                        src="{{ asset($identity->cover_vision_mission) }}">
                    @endif
                </td>
            </tr>
        </x-admin.table>

    </x-admin.card>
</div>

@endsection

@section('components')
    <x-admin.modal id="edit-idendity" heading="Ubah tentang kita">
        <form method="POST" enctype="multipart/form-data"
        action="{{ route('admin.about-us.update') }}">
            @csrf @method('PUT')

            <div class="form-group">
                <label for="edit-identity-vision">
                    Our Vision
                </label>
                <input type="text" class="form-control"
                id="edit-identity-vision" name="our_vision" required
                value="{{ old('our_vision') ?? $identity->our_vision }}">

                @error('our_vision')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="edit-mission">Our Mission</label>
                <textarea name="our_mission" id="edit-mission"
                class="form-control summernote"
                style="resize: none;" rows="3"
                required>{{ old('our_mission') ?? $identity->our_mission }}</textarea>
                @error('our_mission')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="edit-heading">Heading</label>
                <input type="text" class="form-control"
                id="edit-heading" name="section_name" required
                value="{{ old('section_name') ?? $aboutUs->section_name }}">
                @error('section_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="edit-first-desc">Deskripsi 1</label>
                <textarea name="first_desc" id="edit-first-desc"
                class="form-control summernote"
                style="resize: none;" rows="3"
                required>{!! $aboutUs->first_desc !!}</textarea>
                @error('first_desc')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="edit-second-desc">Deskripsi 2</label>
                <textarea name="second_desc" id="edit-second-desc"
                class="form-control summernote"
                style="resize: none;" rows="3"
                required>{!! $aboutUs->second_desc !!}</textarea>
                @error('second_desc')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <x-admin.input label="Ubah video youtube" name="our_video" 
            placeholder="Taruh video youtube disini"
            value="{{ old('our_video') ?? $identity->our_video }}" 
            required></x-admin.input>

            <div class="form-group">
                <img src="{{ asset($identity->cover_vision_mission) }}" 
                height="100px" alt="" class="mb-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input"
                    name="cover_vision_mission" id="cover">
                    <label class="custom-file-label" for="cover">Ubah gambar</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-admin.modal>

    <x-admin.modal id="change-video-popup" heading="Change video promo" >
        <form action="{{ route('admin.about-us.update') }}" method="post">
            @csrf @method('PUT')

            

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-admin.modal>
@endsection