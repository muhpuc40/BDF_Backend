@extends('layouts.app')

@section('title', 'Directory')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Club Directory</h1>
            <a href="{{ route('directory.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Club
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Club Name</th>
                                <th>University</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($directories as $directory)
                                <tr>
                                    <td>{{ $directory->id }}</td>
                                    <td>{{ $directory->club_name }}</td>
                                    <td>{{ $directory->university }}</td>
                                    <td>{{ $directory->contact }}</td>
                                    <td>{{ $directory->email }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $directory->status == 'Active' ? 'success' : ($directory->status == 'Inactive' ? 'warning text-dark' : 'danger') }}">
                                            {{ $directory->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('directory.show', $directory) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('directory.edit', $directory) }}"
                                            class="btn btn-warning btn-sm">Edit</a>

                                        {{-- Status Dropdown --}}
                                        <div class="dropdown d-inline">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown">
                                                Status
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <form action="{{ route('directory.update-status', $directory) }}"
                                                        method="POST">
                                                        @csrf @method('PATCH')
                                                        <input type="hidden" name="status" value="Active">
                                                        <button type="submit" class="dropdown-item">Active</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="{{ route('directory.update-status', $directory) }}"
                                                        method="POST">
                                                        @csrf @method('PATCH')
                                                        <input type="hidden" name="status" value="Inactive">
                                                        <button type="submit" class="dropdown-item">Inactive</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="{{ route('directory.update-status', $directory) }}"
                                                        method="POST">
                                                        @csrf @method('PATCH')
                                                        <input type="hidden" name="status" value="Suspended">
                                                        <button type="submit" class="dropdown-item">Suspended</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>

                                        {{-- Delete Button --}}
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $directory->id }}">
                                            Delete
                                        </button>

                                        {{-- Delete Modal --}}
                                        <div class="modal fade" id="deleteModal{{ $directory->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirm Delete</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete
                                                        <strong>{{ $directory->club_name }}</strong>?
                                                        This action cannot be undone.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <form action="{{ route('directory.destroy', $directory) }}"
                                                            method="POST">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-3">No directory entries found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection