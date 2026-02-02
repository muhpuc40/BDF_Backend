@extends('layouts.app')

@section('title', $news->title)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>News Details</h1>
        <a href="{{ route('news.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="row g-0">
            @if($news->image)
            <div class="col-md-4">
                <img src="{{ asset('storage/' . $news->image) }}" class="img-fluid rounded-start" alt="{{ $news->title }}">
            </div>
            @endif
            <div class="{{ $news->image ? 'col-md-8' : 'col-12' }}">
                <div class="card-body">
                    <h2 class="card-title">{{ $news->title }}</h2>
                    
                    <div class="mb-3">
                        <span class="badge bg-primary">{{ $news->category }}</span>
                        <span class="text-muted mx-2">•</span>
                        <span>{{ $news->date->format('F d, Y') }}</span>
                        <span class="text-muted mx-2">•</span>
                        <span>{{ $news->author }}</span>
                        <span class="text-muted mx-2">•</span>
                        <span>{{ $news->read_time }}</span>
                    </div>

                    <div class="mb-4">
                        <strong>Excerpt:</strong>
                        <p class="card-text">{{ $news->excerpt }}</p>
                    </div>

                    <div class="mb-4">
                        <strong>Content:</strong>
                        <div class="card-text">
                            {!! nl2br(e($news->content)) !!}
                        </div>
                    </div>

                    @if($news->tags && count($news->tags) > 0)
                    <div class="mb-3">
                        <strong>Tags:</strong>
                        @foreach($news->tags as $tag)
                            <span class="badge bg-secondary me-1">{{ $tag }}</span>
                        @endforeach
                    </div>
                    @endif

                    <div class="text-muted">
                        <small>Created: {{ $news->created_at->format('M d, Y H:i') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection