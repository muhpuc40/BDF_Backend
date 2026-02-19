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
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Icon</th>
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
                            <td>
                                <i class="{{ $announcement->icon_class }}"></i>
                            </td>
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
                                <a href="{{ route('announcements.show', $announcement) }}" class="btn btn-sm btn-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('announcements.edit', $announcement) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" title="Delete" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal{{ $announcement->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Delete Modal for each announcement -->
                        <div class="modal fade" id="deleteModal{{ $announcement->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $announcement->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $announcement->id }}">Confirm Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete <strong>"{{ $announcement->title }}"</strong>?</p>
                                        <p class="text-muted small">This action cannot be undone.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('announcements.destroy', $announcement) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $announcements->links() }}
            </div>
        </div>
    </div>
</div>
@endsection