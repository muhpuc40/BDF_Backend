@extends('layouts.app')

@section('title', 'Dashboard - BDF')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<!-- Cards Section -->
<div class="row g-4">
    <!-- Total Events Card -->
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card text-white bg-primary h-100">
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Total Events</h5>
                    <i class="fas fa-calendar fa-2x opacity-50"></i>
                </div>
                <p class="card-text display-6 mb-4">{{ $totalEvents }}</p>
                <a href="{{ route('events.index') }}" class="btn btn-outline-light btn-sm align-self-start">View Details</a>
            </div>
        </div>
    </div>
    
    <!-- Committee Members Card -->
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card text-white bg-success h-100">
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Committee Members</h5>
                    <i class="fas fa-users fa-2x opacity-50"></i>
                </div>
                <p class="card-text display-6 mb-4">{{ $totalCommittees }}</p>
                <a href="{{ route('committees.index') }}" class="btn btn-outline-light btn-sm align-self-start">View Committee</a>
            </div>
        </div>
    </div>

    <!-- News Card -->
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card text-white bg-info h-100">
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Total News</h5>
                    <i class="fas fa-newspaper fa-2x opacity-50"></i>
                </div>
                <p class="card-text display-6 mb-4">{{ $totalNews }}</p>
                <a href="{{ route('news.index') }}" class="btn btn-outline-light btn-sm align-self-start">View News</a>
            </div>
        </div>
    </div>
    
    <!-- Announcements Card -->
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card text-white bg-secondary h-100">
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Announcements</h5>
                    <i class="fas fa-bullhorn fa-2x opacity-50"></i>
                </div>
                <p class="card-text display-6 mb-4">{{ $totalAnnouncements }}</p>
                <a href="{{ route('announcements.index') }}" class="btn btn-outline-light btn-sm align-self-start">View Announcements</a>
            </div>
        </div>
    </div>
    
    <!-- Future User Card (Commented) -->
    {{--
    <div class="col-12 col-md-6 col-lg-3 mt-3">
        <div class="card text-white bg-dark h-100">
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Total Users</h5>
                    <i class="fas fa-user fa-2x opacity-50"></i>
                </div>
                <p class="card-text display-6 mb-4">{{ $totalUsers ?? '0' }}</p>
                <a href="{{ route('users.index') }}" class="btn btn-outline-light btn-sm align-self-start">View Users</a>
            </div>
        </div>
    </div>
    --}}
</div>

<!-- Recent Activity -->
<div class="row mt-5">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Recent Activities</h5>
            </div>
            <div class="card-body">
                @if($recentActivities->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentActivities as $activity)
                            <div class="list-group-item border-0 px-0">
                                <div class="d-flex w-100 justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-{{ $activity['color'] }} me-2">
                                            <i class="{{ $activity['icon'] }}"></i>
                                        </span>
                                        <div>
                                            <h6 class="mb-1">{{ $activity['title'] }}</h6>
                                            <p class="mb-1 text-muted small">{{ $activity['description'] }}</p>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-light text-dark">{{ $activity['type'] }}</span>
                                        <br>
                                        <small class="text-muted">{{ $activity['created_at']->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No recent activities found</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection