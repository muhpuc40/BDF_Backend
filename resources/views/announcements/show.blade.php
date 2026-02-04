@extends('layouts.app')

@section('title', 'Announcement Details -'. $announcement->title)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Announcement Details</h1>
        <a href="{{ route('announcements.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-start mb-4">
                <div class="me-3">
                    @php
                        $iconParts = explode(' ', $announcement->icon_class);
                    @endphp
                    <i class="{{ implode(' ', $iconParts) }} fs-1"></i>
                </div>
                <div>
                    <h2 class="card-title mb-1">{{ $announcement->title }}</h2>
                    <div class="mb-3">
                        @php
                            $badgeClass = [
                                'urgent' => 'danger',
                                'info' => 'info',
                                'warning' => 'warning',
                                'success' => 'success'
                            ][$announcement->type] ?? 'secondary';
                        @endphp
                        <span class="badge bg-{{ $badgeClass }}">{{ ucfirst($announcement->type) }}</span>
                        <span class="text-muted mx-2">•</span>
                        <span>{{ $announcement->time_ago }}</span>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h5>Description</h5>
                <p class="card-text">{{ $announcement->description }}</p>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <strong>Icon Class:</strong>
                        <code>{{ $announcement->icon_class }}</code>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <strong>Created At:</strong>
                        <br>
                        {{ $announcement->created_at->format('M d, Y H:i:s') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection