@extends('layouts.admin')

@section('title', 'Tentang kita')

@section('content')

@if (session('success'))
<div class="col-12 mt-4">
    <x-admin.alert-success />
</div>
@endif

<div class="col-12">

    <x-admin.card title="Tentang kita" class="mb-4">
        <x-slot name="header">
            <x-admin.modal.trigger text="Ubah tentang kita" modal-target="edit-idendity" />
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
                <td>{{ $sectionTitle }}</td>
                <td>{!! $sectionDesc->first_desc_about_us ?? '' !!}</td>
                @if ($templateChoosen->version == 2)
                <td>
                    {!! $sectionDesc->second_desc_about_us ?? '' !!}
                </td>
                @endif
                <td>
                    @isset($identity->cover_vision_mission)
                    <img alt="" height="100px"
                    src="{{ Storage::url($identity->cover_vision_mission) }}">
                    @endisset
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
                <input type="hidden" name="our_mission"
                value="{{ isset($identity->our_mission) ? $identity->our_mission : '' }}" required>
                <div class="summernote" data-input-attached="our_mission" id="edit-mission">
                    {!! isset($identity->our_mission) ? $identity->our_mission : '' !!}
                </div>
                @error('our_mission')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="edit-heading">Heading</label>
                <input type="text" class="form-control"
                id="edit-heading" name="section_name" required
                value="{{ old('section_name') ?? $sectionTitle }}">
                @error('section_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="edit-first-desc">Deskripsi 1</label>
                <input type="hidden" name="first_desc"
                value="{!! $sectionDesc->first_desc_about_us ?? '' !!}" required>
                <div class="summernote" data-input-attached="first_desc" id="edit-first-desc">
                    {!! $sectionDesc->first_desc_about_us ?? '' !!}
                </div>
                @error('first_desc')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            @if ($templateChoosen->version == 2)
                <div class="form-group">
                    <label for="edit-second-desc">Deskripsi 2</label>
                    <input type="hidden" name="second_desc"
                    value="{!! $sectionDesc->second_desc_about_us ?? '' !!}" required>
                    <div class="summernote" data-input-attached="second_desc" id="edit-second-desc">
                        {!! $sectionDesc->second_desc_about_us ?? '' !!}
                    </div>
                    @error('second_desc')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            @endif

            <div class="form-group">
                @isset($identity->cover_vision_mission)
                <img src="{{ asset('storage/' .
                    str_replace('public/', '', $identity->cover_vision_mission)) }}"
                    height="100px" alt="" class="mb-3">
                @endisset
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
