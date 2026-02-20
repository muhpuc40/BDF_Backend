@extends('layouts.app')

@section('title', 'Advisors Panel')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Advisors Panel</h1>
        <a href="{{ route('advisors.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Advisor
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($advisors as $advisor)
                        <tr>
                            <td>{{ $advisor->id }}</td>
                            <td>
                                @if($advisor->image)
                                    <img src="{{ asset('storage/' . $advisor->image) }}" 
                                         alt="{{ $advisor->name }}" 
                                         style="width: 50px; height: 50px; object-fit: cover;" 
                                         class="rounded">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td>{{ $advisor->name }}</td>
                            <td>{{ $advisor->position }}</td>
                            <td>{{ $advisor->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('advisors.show', $advisor) }}" class="btn btn-sm btn-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('advisors.edit', $advisor) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" title="Delete" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal{{ $advisor->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Delete Modal for each advisor -->
                        <div class="modal fade" id="deleteModal{{ $advisor->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $advisor->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $advisor->id }}">Confirm Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete <strong>"{{ $advisor->name }}"</strong>?</p>
                                        <p class="text-muted small">This action cannot be undone.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('advisors.destroy', $advisor) }}" method="POST" class="d-inline">
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
                {{ $advisors->links() }}
            </div>
        </div>
    </div>
</div>
@endsection