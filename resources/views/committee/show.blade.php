@extends('layouts.app')

@section('title', $committee->name)

@section('content')
<div class="container">
    <div class="card">
        <div class="row g-0">
            <div class="col-md-4">
                @if($committee->image)
                <img src="{{ asset('storage/' . $committee->image) }}" class="img-fluid rounded-start" alt="{{ $committee->name }}">
                @else
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center h-100">
                    No Image Available
                </div>
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h2 class="card-title">{{ $committee->name }}</h2>
                    <h4 class="card-subtitle mb-3 text-muted">{{ $committee->designation }}</h4>
                    
                    <div class="mb-3">
                        <strong>Priority Level:</strong> {{ $committee->priority_level }}
                    </div>
                    
                    <div class="mb-3">
                        <strong>Gmail:</strong> 
                        @if($committee->gmail)
                        <a href="mailto:{{ $committee->gmail }}">{{ $committee->gmail }}</a>
                        @else
                        N/A
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <strong>Facebook:</strong> 
                        @if($committee->fb_link)
                        <a href="{{ $committee->fb_link }}" target="_blank">{{ $committee->fb_link }}</a>
                        @else
                        N/A
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <strong>LinkedIn:</strong> 
                        @if($committee->linkedin_link)
                        <a href="{{ $committee->linkedin_link }}" target="_blank">{{ $committee->linkedin_link }}</a>
                        @else
                        N/A
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <strong>Created:</strong> {{ $committee->created_at->format('d M Y') }}
                    </div>
                    
                    <a href="{{ route('committees.index') }}" class="btn btn-primary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection