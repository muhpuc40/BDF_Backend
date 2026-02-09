@extends('layouts.app')

@section('title', 'Contact Emails')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">Contact Emails</h1>
            <p class="text-muted">Manage contact form submissions</p>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>From</th>
                            <th>Subject</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Received</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($emails as $email)
                            <tr>
                                <td>
                                    <strong>{{ $email->name }}</strong><br>
                                    <small class="text-muted">{{ $email->email }}</small>
                                </td>
                                <td>{{ Str::limit($email->subject, 50) }}</td>
                                <td>{{ $email->phone ?? 'N/A' }}</td>
                                <td>
                                    @if($email->status === 'replied')
                                        <span class="badge bg-success">Replied</span>
                                    @elseif($email->status === 'read')
                                        <span class="badge bg-info">Read</span>
                                    @else
                                        <span class="badge bg-warning">Unread</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $email->created_at->format('M d, Y') }}<br>
                                    <small class="text-muted">{{ $email->created_at->format('h:i A') }}</small>
                                </td>
                                <td>
                                    <a href="{{ route('emails.show', $email->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">No emails found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center">
                {{ $emails->links() }}
            </div>
        </div>
    </div>
</div>
@endsection