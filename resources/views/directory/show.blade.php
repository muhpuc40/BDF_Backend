@extends('layouts.app')

@section('title', 'Directory Details')

@section('content')
<div class="container">
    <h2>Directory Details</h2>
    
    <div class="card">
        <div class="card-header">
            <h4>{{ $directory->club_name }}</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="width: 30%">ID</th>
                        <td>{{ $directory->id }}</td>
                    </tr>
                    <tr>
                        <th>Club Name</th>
                        <td>{{ $directory->club_name }}</td>
                    </tr>
                    <tr>
                        <th>University</th>
                        <td>{{ $directory->university }}</td>
                    </tr>
                    <tr>
                        <th>President</th>
                        <td>{{ $directory->president }}</td>
                    </tr>
                    <tr>
                        <th>General Secretary</th>
                        <td>{{ $directory->general_secretary }}</td>
                    </tr>
                    <tr>
                        <th>Contact</th>
                        <td>{{ $directory->contact }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $directory->email }}</td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td>{{ $directory->location }}</td>
                    </tr>
                    <tr>
                        <th>Established</th>
                        <td>{{ $directory->established }}</td>
                    </tr>
                    <tr>
                        <th>Members</th>
                        <td>{{ $directory->members }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge bg-{{ $directory->status == 'Active' ? 'success' : ($directory->status == 'Inactive' ? 'warning' : 'danger') }}">
                                {{ $directory->status }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Facebook URL</th>
                        <td>
                            @if($directory->facebook_url)
                                <a href="{{ $directory->facebook_url }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fab fa-facebook"></i> Visit Facebook Page
                                </a>
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $directory->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $directory->updated_at->format('d M Y, h:i A') }}</td>
                    </tr>
                </tbody>
            </table>
            
            <div class="mt-3">
                <a href="{{ route('directory.index') }}" class="btn btn-secondary">Back to List</a>
                <a href="{{ route('directory.create') }}" class="btn btn-primary">Add New Entry</a>
            </div>
        </div>
    </div>
</div>

<style>
.fab {
    font-family: "Font Awesome 5 Brands";
}
</style>
@endsection