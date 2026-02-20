@extends('layouts.app')

@section('title', 'Contact Emails')

@section('content')
    <div class="container-fluid">
        <!-- Add Alert Messages Section -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h1>Contact Emails</h1>
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#smtpGuideModal">
                    <i class="fas fa-question-circle"></i> Guide
                </button>
            </div>
        </div>

        <!-- SMTP2GO Guide Modal -->
        <div class="modal fade" id="smtpGuideModal" tabindex="-1" aria-labelledby="smtpGuideModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="smtpGuideModalLabel">
                            <i class="fas fa-info-circle me-2"></i>SMTP2GO Information
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4">
                            <h6 class="fw-bold">Activity Dashboard:</h6>
                            <div class="bg-light p-3 rounded">
                                <a href="https://app-us.smtp2go.com/reports/activity/" target="_blank" class="text-decoration-none">
                                    <i class="fas fa-external-link-alt me-2"></i>
                                    https://app-us.smtp2go.com/reports/activity/
                                </a>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h6 class="fw-bold">Login Credentials:</h6>
                            <div class="bg-light p-3 rounded">
                                <div class="mb-2">
                                    <strong>Email:</strong> 
                                    <span class="user-select-all">munna.puc@puc.ac.bd</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

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
                        <tr class="{{ $email->status === 'unread' ? 'table-light fw-bold' : '' }}">
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
                            <td colspan="6" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No emails found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $emails->links() }}
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Auto-dismiss alerts after 5 seconds
    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(function(alert) {
            var bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);

    // Copy to clipboard function
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Show a temporary tooltip or alert
            alert('Email copied to clipboard!');
        }, function(err) {
            console.error('Could not copy text: ', err);
        });
    }
</script>
@endpush