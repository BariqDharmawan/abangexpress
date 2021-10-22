@extends('layouts/admin')

@section('title', 'Sosial media')

@section('content')
    <div class="row mx-0">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h4 mb-0">Manage sosial media kita</h1>
                <x-admin.modal.trigger text="Tambah social media"
                modal-target="add-social-media" />
            </div>
        </div>
        @if (session('success'))
        <div class="col-12 mt-4">
            <x-admin.alert-success/>
        </div>
        @endif
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <x-admin.card title="">
                <ul class="list-group">
                    @foreach ($socialMedia as $social)
                    <li class="list-group-item d-flex align-items-center">
                        <span class="h3"><i class="{{ $social->icon }}"></i></span>
                        <div class="ml-4">
                            <p class="font-weight-bold text-capitalize mb-1">
                                <a href="{{ $social->link }}" 
                                target="__blank">{{ $social->username }}</a>
                            </p>
                            <small>{{ $social->platform }}</small>
                        </div>
                        <div class="ml-auto">
                            <a class="btn btn-link text-primary" href="{{ route('admin.our-social.edit', $social->id) }}">
                                Ubah detail
                            </a>

                            <x-admin.modal.trigger text="Hapus"
                            modal-target="remove-social-{{ $loop->iteration }}"
                            :is-default-style="false"
                            class="btn-link text-danger" />

                        </div>
                    </li>
                    @endforeach
                </ul>
            </x-admin.card>
        </div>
    </div>
@endsection

@section('components')
    <x-admin.modal id="add-social-media" heading="Add new social media">
        <form method="POST" enctype="multipart/form-data" 
        action="{{ route('admin.our-social.store') }}">
            @csrf

            <x-admin.input type="select" label="Platform" name="platform" required>
                @foreach ($platforms as $platform)
                    <option value="{{ $platform }}">
                        {{ $platform }}
                    </option>
                @endforeach
            </x-admin.input>
        
            <div class="form-group">
                <label for="add-social-username">
                    Username
                </label>
                <input type="text" class="form-control" 
                id="add-social-username" placeholder="Example: @bariqdharmawans"
                name="username" value="{{ old('username') }}">
        
                @error('username')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="d-flex flex-wrap mb-3">
                <p class="d-block w-100">Choose icon</p>
                @foreach ($listIcon as $icon)
                    <div class="form-check mr-4 h2">
                        <input type="radio" id="pick-icon-{{ Str::slug($icon) }}" 
                        name="icon" class="form-check-input mr-0" value="{{ $icon }}" 
                        @if(isset($data) and $data->icon == $icon) checked @endif>
                        <label class="form-check-label" for="pick-icon-{{ Str::slug($icon) }}">
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
    </x-admin.modal>
    
    @foreach ($ourSocial as $social)
        @include('admin.partials.popup-delete', [
            'id' => 'remove-social-' . $loop->iteration,
            'heading' => "Remove our $social->platform",
            'warningMesssage' => "Are you sure wana remove our $social->platform",
            'action' => route('admin.our-social.destroy', $social->id)
        ])
    @endforeach
@endsection