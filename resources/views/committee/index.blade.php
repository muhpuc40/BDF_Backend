@extends('layouts.app')

@section('title', 'Committee Members')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Committee Members</h1>
            <a href="{{ route('committees.create') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Add New Member
            </a>
        </div>

        <div class="row">
            @foreach($committees as $committee)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if($committee->image)
                            <img src="{{ asset('storage/' . $committee->image) }}" class="card-img-top" alt="{{ $committee->name }}"
                                style="height: 250px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-secondary text-white d-flex align-items-center justify-content-center"
                                style="height: 250px;">
                                No Image
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $committee->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $committee->designation }}</h6>
                            <p class="card-text">
                                <strong>Priority:</strong> {{ $committee->priority_level }}<br>
                                <strong>Email:</strong> {{ $committee->gmail ?? 'N/A' }}
                            </p>
                            <div class="d-flex gap-2">
                                @if($committee->fb_link)
                                    <a href="{{ $committee->fb_link }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        <i class="fab fa-facebook"></i> Facebook
                                    </a>
                                @endif
                                @if($committee->linkedin_link)
                                    <a href="{{ $committee->linkedin_link }}" target="_blank" class="btn btn-outline-info btn-sm">
                                        <i class="fab fa-linkedin"></i> LinkedIn
                                    </a>
                                @endif
                            </div>
                            <a href="{{ route('committees.show', $committee) }}" class="btn btn-info btn-sm mt-2">View
                                Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        .fab {
            font-family: "Font Awesome 5 Brands";
        }
    </style>
@endsection