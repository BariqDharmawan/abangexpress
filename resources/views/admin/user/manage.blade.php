@extends('layouts.admin')

@section('title', 'Manage user')

@section('content')
    <div class="row mx-0">
        <div class="col-12">
            <x-admin.card title="Manage our users">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" 
                    width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-admin.card>
        </div>
    </div>
@endsection