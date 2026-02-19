@extends('layouts.app')

@section('title', 'Committee Members')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Committee Members</h1>
            <a href="{{ route('committees.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Member
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            @foreach($committees as $committee)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
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
                            <div class="d-flex gap-2 mb-2">
                                @if($committee->fb_link)
                                    <a href="{{ $committee->fb_link }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                @endif
                                @if($committee->linkedin_link)
                                    <a href="{{ $committee->linkedin_link }}" target="_blank" class="btn btn-outline-info btn-sm">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer bg-transparent d-flex justify-content-between">
                            <div>
                                <a href="{{ route('committees.show', $committee) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('committees.edit', $committee) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal{{ $committee->id }}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal for each committee member -->
                <div class="modal fade" id="deleteModal{{ $committee->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $committee->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $committee->id }}">Confirm Delete</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete <strong>{{ $committee->name }}</strong>?
                                <br>
                                <small class="text-danger">This action cannot be undone.</small>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('committees.destroy', $committee) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($committees->isEmpty())
            <div class="alert alert-info text-center">
                No committee members found
            </div>
        @endif
    </div>

    <style>
        .fab {
            font-family: "Font Awesome 5 Brands";
        }
    </style>
@endsection