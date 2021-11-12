@extends('layouts.admin')

@section('content')
    <div class="row mx-0">
        <div class="col-12 mb-4 d-flex align-items-center">
            <a href="{{ route('admin.our-social.index') }}" class="btn btn-link mr-2">
                <i class="fas fa-long-arrow-alt-left"></i>
            </a>
            <h1 class="h4 mb-0">Ubah detail {{ $social->platform }} kita</h1>
        </div>
        <div class="col-12">
            <x-admin.card>
                <form method="POST" enctype="multipart/form-data"
                action="{{ route('admin.our-social.update', $social->id) }}">
                    @csrf @method('PUT')

                    <x-admin.input type="select" label="Platform" name="platform" required>
                        @foreach ($platforms as $platform)
                            <option @if($social->platform == $platform) selected @endif
                            value="{{ $platform }}">
                                {{ $platform }}
                            </option>
                        @endforeach
                    </x-admin.input>

                    <x-admin.input label="Username" name="username"
                    id="edit-social-{{ $social->username }}"
                    value="{{ old('username') ?? $social->username }}" required />

                    <div class="d-flex flex-wrap mb-3">
                        <p class="d-block w-100">Pilih icon</p>
                        @foreach ($listIcon as $icon)
                            <div class="form-check mr-4 h2">
                                <input type="radio" id="pick-icon-{{ Str::slug($icon) }}"
                                name="icon" class="form-check-input mr-0" value="{{ $icon }}"
                                @if($social->icon == $icon) checked @endif>
                                <label class="form-check-label"
                                for="pick-icon-{{ Str::slug($icon) }}">
                                    <i class="{{ $icon }}"></i>
                                </label>
                            </div>
                        @endforeach

                        @error('icon')
                            <div class="text-danger py-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </x-admin.card>
        </div>
    </div>
@endsection
