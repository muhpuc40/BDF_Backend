@extends('layouts.app')

@section('title', 'Create Advisor')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Create Advisor</h1>
        <a href="{{ route('advisors.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('advisors.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Left Side -->
                    <div class="col-md-8">
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Position -->
                        <div class="mb-3">
                            <label for="position" class="form-label">Position *</label>
                            <input type="text" class="form-control @error('position') is-invalid @enderror" 
                                   id="position" name="position" value="{{ old('position') }}" 
                                   placeholder="e.g., Senior Advisor, Chairman" required>
                            @error('position')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Side -->
                    <div class="col-md-4">
                        <!-- Image -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Image *</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/jpeg,image/png,image/jpg,image/webp" required>
                            <small class="text-muted">Upload advisor image (jpg, png, webp)</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Advisor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection