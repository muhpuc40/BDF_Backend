@extends('layouts.app')

@section('title', $event->title)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Event Details</h1>
        <a href="{{ route('events.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card">
        <div class="row g-0">
            @if($event->image)
            <div class="col-md-4">
                <img src="{{ Storage::url($event->image) }}" 
                     class="img-fluid rounded-start" 
                     alt="{{ $event->title }}"
                     style="height: 100%; object-fit: cover;">
            </div>
            @endif
            
            <div class="{{ $event->image ? 'col-md-8' : 'col-12' }}">
                <div class="card-body">
                    <h2 class="card-title">{{ $event->title }}</h2>
                    
                    <div class="mb-3">
                        <span class="badge bg-{{ $event->type === 'upcoming' ? 'info' : ($event->type === 'ongoing' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($event->type) }}
                        </span>
                        <span class="badge bg-primary">{{ ucfirst($event->category) }}</span>
                    </div>

                    <div class="mb-4">
                        <strong>Description:</strong>
                        <p class="card-text">{{ $event->description }}</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <p><strong><i class="fas fa-calendar"></i> Date:</strong> {{ $event->date->format('F d, Y') }}</p>
                            @if($event->time)
                            <p><strong><i class="fas fa-clock"></i> Time:</strong> {{ $event->time }}</p>
                            @endif
                            <p><strong><i class="fas fa-map-marker-alt"></i> Location:</strong> {{ $event->location }}</p>
                        </div>
                        <div class="col-md-6">
                            @if($event->participants)
                            <p><strong><i class="fas fa-users"></i> Participants:</strong> {{ $event->participants }}</p>
                            @endif
                            @if($event->registration_deadline)
                            <p><strong><i class="fas fa-calendar-times"></i> Registration Deadline:</strong> 
                                {{ $event->registration_deadline->format('F d, Y') }}
                            </p>
                            @endif
                            @if($event->status)
                            <p><strong><i class="fas fa-info-circle"></i> Status:</strong> {{ $event->status }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="text-muted mt-4">
                        <small>Created: {{ $event->created_at->format('M d, Y H:i') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection