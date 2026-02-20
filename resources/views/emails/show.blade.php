@extends('layouts.app')

@section('title', 'View Email')

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

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <strong>Error!</strong> Please check the form for errors.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>View Email</h1>
            <a href="{{ route('emails.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="m-0 font-weight-bold">Subject: {{ $email->subject }}</h5>
                    </div>
                    <div class="card-body">

                        <div class="mb-4">
                            <h6 class="font-weight-bold">Message:</h6>
                            <div class="border rounded p-3 bg-light">
                                {!! nl2br(e($email->message)) !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <p><small class="text-muted">Received:
                                        {{ $email->created_at->format('F j, Y, g:i a') }}</small></p>
                            </div>
                            <div class="col-md-6 text-end">
                                <span
                                    class="badge bg-{{ $email->status === 'replied' ? 'success' : ($email->status === 'read' ? 'info' : 'warning') }}">
                                    {{ ucfirst($email->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                @if($email->status !== 'replied')
                    <div class="card shadow">
                        <div class="card-header bg-success text-white py-3">
                            <h5 class="m-0 font-weight-bold">Send Reply</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('emails.reply', $email->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="reply_message" class="form-label">Reply Message</label>
                                    <textarea name="reply_message" id="reply_message" rows="6"
                                        class="form-control @error('reply_message') is-invalid @enderror"
                                        required>{{ old('reply_message') }}</textarea>
                                    @error('reply_message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-paper-plane"></i> Send Reply
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="card shadow">
                        <div class="card-header bg-info text-white py-3">
                            <h5 class="m-0 font-weight-bold">Reply Sent</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i>
                                Replied on {{ $email->replied_at->format('F j, Y, g:i a') }}
                            </div>

                            <h6 class="font-weight-bold">Your Reply:</h6>
                            <div class="border rounded p-3 bg-light">
                                {!! nl2br(e($email->reply_message)) !!}
                            </div>

                            <div class="mt-3">
                                <form action="{{ route('emails.reply', $email->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="reply_message" class="form-label">Send New Reply</label>
                                        <textarea name="reply_message" id="reply_message" rows="4"
                                            class="form-control @error('reply_message') is-invalid @enderror"
                                            required>{{ old('reply_message') }}</textarea>
                                        @error('reply_message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-info">
                                        <i class="fas fa-paper-plane"></i> Send New Reply
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header bg-secondary text-white py-3">
                        <h6 class="m-0 font-weight-bold">Quick Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="mailto:{{ $email->email }}" class="btn btn-outline-primary">
                                <i class="fas fa-envelope"></i> Open in Email Client
                            </a>
                            <button onclick="window.print()" class="btn btn-outline-secondary">
                                <i class="fas fa-print"></i> Print Email
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card shadow">
                    <div class="card-body">
                        <h6 class="font-weight-bold mb-3">Email Information</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-user text-primary"></i>
                                <strong>Name:</strong> {{ $email->name }}
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-envelope text-primary"></i>
                                <strong>Email:</strong> {{ $email->email }}
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-phone text-primary"></i>
                                <strong>Phone:</strong> {{ $email->phone ?? 'N/A' }}
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-globe text-primary"></i>
                                <strong>IP:</strong> {{ $email->ip_address }}
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-clock text-primary"></i>
                                <strong>Received:</strong> {{ $email->created_at->diffForHumans() }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Auto-dismiss alerts after 5 seconds
            setTimeout(function () {
                document.querySelectorAll('.alert').forEach(function (alert) {
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        </script>
    @endpush
@endsection