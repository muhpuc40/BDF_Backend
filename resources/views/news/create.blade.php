@extends('layouts.app')
@section('title', 'Create News')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Create News</h1>
            <a href="{{ route('news.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- Left Side -->
                        <div class="col-md-8">
                            <!-- Title -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Title *</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                    name="title" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Content -->
                            <div class="mb-3">
                                <label for="content" class="form-label">Content *</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" id="content"
                                    name="content" rows="10" required>{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Side -->
                        <div class="col-md-4">
                            <!-- Category (Optional) -->
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" class="form-control @error('category') is-invalid @enderror"
                                    id="category" name="category" value="{{ old('category') }}"
                                    placeholder="Announcement, Workshop, Education">
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Date -->
                            <div class="mb-3">
                                <label for="date" class="form-label">Date *</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date"
                                    name="date" value="{{ old('date') }}" required>
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tags (Optional) -->
                            <div class="mb-3">
                                <label for="tags" class="form-label">Tags</label>
                                <input type="text" class="form-control @error('tags') is-invalid @enderror" id="tags"
                                    name="tags" value="{{ old('tags') }}" placeholder="competition, registration, national">
                                <small class="text-muted">Separate tags with commas</small>
                                @error('tags')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Image *</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                    name="image" accept="image/*" required>
                                <small class="text-muted">Upload news image (jpg, png, webp)</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Create News
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection