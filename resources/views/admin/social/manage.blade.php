@extends('layouts/admin')

@section('content')
    <div class="row mx-0">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h4 mb-0">Manage our social media</h1>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-social-media">
                    Add new social media
                </button>
            </div>
        </div>
        @if (session('success'))
        <div class="col-12 mt-4">
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        </div>
        @endif
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <x-admin.card>
                <ul class="list-group">
                    @foreach ($ourSocial as $social)
                    <li class="list-group-item d-flex align-items-center" >
                        <img src="{{ $social->icon }}" alt="" height="30px">
                        <div class="ml-4">
                            <p class="font-weight-bold text-capitalize mb-1">
                                <a href="{{ $social->link }}" 
                                target="__blank">{{ $social->username }}</a>
                            </p>
                            <small>{{ $social->platform }}</small>
                        </div>
                        <div class="ml-auto">
                            <a class="btn btn-link text-primary" href="{{ route('admin.our-social.edit', $social->id) }}">
                                Update
                            </a>
                            <button type="button" class="btn btn-link text-danger" data-toggle="modal" 
                            data-target="#remove-social-{{ $loop->iteration }}">
                                Remove
                            </button>
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
            <div class="form-group">
                <label for="add-social-platform">Platform</label>
                <select class="custom-select text-capitalize" name="platform" 
                id="add-social-platform">
                    @foreach ($platforms as $platform)
                        <option value="{{ $platform }}">
                            {{ $platform }}
                        </option>
                    @endforeach
                </select>
                @error('platform')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="form-group">
                <label for="add-social-username">
                    Username
                </label>
                <input type="text" class="form-control" 
                id="add-social-username" 
                name="username" value="{{ old('username') }}">
        
                @error('username')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" 
                    id="add-social-icon" name="icon" required>
                    <label class="custom-file-label" for="add-social-icon">
                        Pick icon
                    </label>
                </div>
                @error('icon')
                    <div class="text-danger">{{ $message }}</div>
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