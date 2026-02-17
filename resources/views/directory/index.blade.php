@extends('layouts.app')

@section('title', 'Directory')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Club Directory List</h1>
            <a href="{{ route('directory.create') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Add Club
            </a>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Club Name</th>
                        <th>University</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($directories as $directory)
                        <tr>
                            <td>{{ $directory->id }}</td>
                            <td>{{ $directory->club_name }}</td>
                            <td>{{ $directory->university }}</td>
                            <td>{{ $directory->contact }}</td>
                            <td>{{ $directory->email }}</td>
                            <td>
                                <span
                                    class="badge bg-{{ $directory->status == 'Active' ? 'success' : ($directory->status == 'Inactive' ? 'warning' : 'danger') }}">
                                    {{ $directory->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('directory.show', $directory) }}" class="btn btn-info btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($directories->isEmpty())
            <div class="alert alert-info text-center">
                No directory entries found
            </div>
        @endif
    </div>
@endsection