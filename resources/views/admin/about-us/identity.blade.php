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

        <x-admin.table class="datatable-disable-pagination-ordering"
        :thead="$columnsIdentity">
            <tr>
                <td>
                    @isset($identity->our_vision)
                        {{ Str::words($identity->our_vision, 5, '...') }}
                    @endisset
                </td>
                <td>
                    @isset($identity->our_mission)
                        {!! $identity->our_mission  !!}
                    @endisset
                </td>
                <td>{{ $aboutUs->section_name }}</td>
                <td>{!! $aboutUs->first_desc !!}</td>
                @if ($templateChoosen->version == 2)
                <td>
                    {!! $aboutUs->second_desc !!}
                </td>
                @endif
                <td>
                    @isset($identity->our_video)
                        @if ($templateChoosen->version == 1 and $identity->our_video)
                            <a href="{{ $identity->our_video }}"
                            target="_blank">
                                Lihat video
                            </a>
                    @endisset
                    @else
                        <img alt="" height="100px"
                        src="{{ Storage::url($identity->cover_vision_mission) }}">
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
                value="{{ isset($identity->our_vision) ? $identity->our_vision : '' }}">

                @error('our_vision')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="edit-mission">Our Mission</label>
                <textarea name="our_mission" id="edit-mission"
                class="form-control summernote"
                style="resize: none;" rows="3"
                required>{{ isset($identity->our_mission) ? $identity->our_mission : '' }}</textarea>
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

            @if ($templateChoosen->version == 2)
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
            @endif

            @if ($templateChoosen->version == 1)
            <x-admin.input label="Ubah video youtube" name="our_video"
            placeholder="Taruh video youtube disini"
            value="{{ old('our_video') ?? isset($identity->our_video) ? $identity->our_video : '' }}"></x-admin.input>
            @endif

            @isset($identity->cover_vision_mission)
                <div class="form-group">
                    <img src="{{ asset('storage/' .
                    str_replace('public/', '', $identity->cover_vision_mission)) }}"
                    height="100px" alt="" class="mb-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input"
                        name="cover_vision_mission" id="cover" accept="image/*">
                        <label class="custom-file-label" for="cover">
                            Ubah gambar
                        </label>
                    </div>
                    @error('cover_vision_mission')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            @endisset

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
