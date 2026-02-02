@extends('layouts.app')

@section('title', 'Dashboard - BDF')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<!-- Cards Section -->
<div class="row g-4">
    <div class="col-12 col-md-6 col-lg-4">
        <div class="card text-white bg-primary h-100">
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Total Events</h5>
                    <i class="fas fa-calendar fa-2x opacity-50"></i>
                </div>
                <p class="card-text display-6 mb-4">25</p>
                <a href="/events" class="btn btn-outline-light btn-sm align-self-start">View Details</a>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-md-6 col-lg-4">
        <div class="card text-white bg-success h-100">
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Committee Members</h5>
                    <i class="fas fa-users fa-2x opacity-50"></i>
                </div>
                <p class="card-text display-6 mb-4">15</p>
                <a href="/committees" class="btn btn-outline-light btn-sm align-self-start">View Committee</a>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-md-6 col-lg-4">
        <div class="card text-white bg-warning h-100">
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Upcoming Events</h5>
                    <i class="fas fa-clock fa-2x opacity-50"></i>
                </div>
                <p class="card-text display-6 mb-4">3</p>
                <a href="/events" class="btn btn-outline-light btn-sm align-self-start">View Events</a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity (Optional) -->
<div class="row mt-5">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Recent Activity</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item border-0 px-0">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">New event added</h6>
                            <small class="text-muted">2 hours ago</small>
                        </div>
                        <p class="mb-1">"National Debate Championship 2024" has been created.</p>
                    </div>
                    <div class="list-group-item border-0 px-0">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">New registration</h6>
                            <small class="text-muted">2 days ago</small>
                        </div>
                        <p class="mb-1">Dhaka University registered for upcoming tournament.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection