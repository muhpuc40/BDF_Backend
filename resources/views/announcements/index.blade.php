@extends('layouts.app')

@section('title', 'Announcements Management')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Announcements Management</h1>
        <a href="{{ route('announcements.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Announcement
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Time Ago</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($announcements as $announcement)
                        <tr>
                            <td>{{ $announcement->id }}</td>
                            <td>{{ Str::limit($announcement->title, 30) }}</td>
                            <td>{{ Str::limit($announcement->description, 50) }}</td>
                            <td>
                                @php
                                    $badgeClass = [
                                        'urgent' => 'danger',
                                        'info' => 'info',
                                        'warning' => 'warning',
                                        'success' => 'success'
                                    ][$announcement->type] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $badgeClass }}">{{ ucfirst($announcement->type) }}</span>
                            </td>
                            <td>{{ $announcement->time_ago }}</td>
                            <td>
                                <a href="{{ route('announcements.show', $announcement) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $announcements->links() }}
        </div>
    </div>
</div>
@endsection