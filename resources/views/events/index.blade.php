@extends('layouts.app')

@section('title', 'Events')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Events</h1>
        <a href="{{ route('events.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Event
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        @foreach($events as $event)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="position-relative">
                    <img src="{{ Storage::url($event->image) }}" 
                         class="card-img-top" 
                         alt="{{ $event->title }}"
                         style="height: 200px; object-fit: cover;">
                    <div class="position-absolute top-0 end-0 m-2">
                        <span class="badge bg-{{ $event->type === 'upcoming' ? 'info' : ($event->type === 'ongoing' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($event->type) }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $event->title }}</h5>
                    <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                    
                    <div class="mb-3">
                        <span class="badge bg-primary">{{ ucfirst($event->category) }}</span>
                        @if($event->participants)
                        <span class="badge bg-success">{{ $event->participants }}</span>
                        @endif
                    </div>
                    
                    <p class="card-text">
                        <small class="text-muted">
                            <i class="fas fa-calendar"></i> {{ $event->date->format('M d, Y') }}
                            <br>
                            <i class="fas fa-map-marker-alt"></i> {{ $event->location }}
                        </small>
                    </p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-outline-primary">
                        View Details
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($events->isEmpty())
    <div class="text-center py-5">
        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
        <h4>No Events Found</h4>
    </div>
    @endif

    <div class="d-flex justify-content-center">
        {{ $events->links() }}
    </div>
</div>
@endsection