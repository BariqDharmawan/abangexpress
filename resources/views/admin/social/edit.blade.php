@extends('layouts.admin')

@section('content')
    <div class="row mx-0">
        <div class="col-12 mb-4 d-flex align-items-center">
            <a href="{{ route('admin.our-social.manage') }}" class="btn btn-link mr-2">
                <i class="fas fa-long-arrow-alt-left"></i>
            </a>
            <h1 class="h4 mb-0">Edit {{ $social->platform }} detail</h1>
        </div>
        <div class="col-12">
            <x-admin.card>
                <form method="POST" enctype="multipart/form-data" 
                action="{{ route('admin.our-social.update', $social->id) }}">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label for="edit-social-{{ $social->platform }}">Platform</label>
                        <select class="custom-select text-capitalize" name="platform" 
                        id="edit-social-{{ $social->platform }}">
                            @foreach ($platforms as $platform)
                                <option @if($social->platform == $platform) selected @endif
                                value="{{ $platform }}">
                                    {{ $platform }}
                                </option>
                            @endforeach
                        </select>
                        @error('platform')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="edit-social-{{ $social->username }}">
                            Username
                        </label>
                        <input type="text" class="form-control" 
                        id="edit-social-{{ $social->username }}" 
                        name="username" value="{{ old('username') ?? $social->username }}">
                
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <span class="mb-2 d-block">Change logo</span>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" 
                            id="edit-social-icon-{{ $social->id }}" name="icon">
                            <label class="custom-file-label" for="add-social-icon">
                                Pick a new logo
                            </label>
                        </div>
                        @error('icon')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </x-admin.card>
        </div>
    </div>
@endsection