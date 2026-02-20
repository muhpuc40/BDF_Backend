@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>User Registrations</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive" style="overflow: visible;">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Institution</th>
                            <th>Registered</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>{{ $user->full_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->institution }}</td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                @php
                                    $badgeColor = match($user->status) {
                                        'active'   => 'success',
                                        'pending'  => 'warning text-dark',
                                        'rejected' => 'danger',
                                        'banned'   => 'dark',
                                        default    => 'secondary',
                                    };
                                @endphp
                                <span class="badge bg-{{ $badgeColor }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td>
                                {{-- Status Dropdown --}}
                                <div class="dropdown d-inline">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" data-bs-boundary="window">
                                        Status
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <form action="{{ route('users.update-status', $user->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="active">
                                                <button type="submit" class="dropdown-item text-success"
                                                    {{ $user->status == 'active' ? 'disabled' : '' }}>
                                                    <i class="fas fa-check me-1"></i> Active
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route('users.update-status', $user->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="pending">
                                                <button type="submit" class="dropdown-item text-warning"
                                                    {{ $user->status == 'pending' ? 'disabled' : '' }}>
                                                    <i class="fas fa-clock me-1"></i> Pending
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route('users.update-status', $user->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="dropdown-item text-danger"
                                                    {{ $user->status == 'rejected' ? 'disabled' : '' }}>
                                                    <i class="fas fa-times me-1"></i> Rejected
                                                </button>
                                            </form>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('users.update-status', $user->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="banned">
                                                <button type="submit" class="dropdown-item text-dark"
                                                    {{ $user->status == 'banned' ? 'disabled' : '' }}>
                                                    <i class="fas fa-ban me-1"></i> Banned
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>

                                {{-- Delete Button --}}
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $user->id }}">
                                    <i class="fas fa-trash"></i> Delete
                                </button>

                                {{-- Delete Modal --}}
                                <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete
                                                <strong>{{ $user->full_name }}</strong>?
                                                This action cannot be undone.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
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
                                <td colspan="8" class="text-center text-muted py-4">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection