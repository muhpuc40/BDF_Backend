@extends('layouts.app')

@section('title', 'Edit Presidium Member')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Presidium Member</h1>
        <a href="{{ route('presidium.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('presidium.update', $presidium) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Left Side -->
                    <div class="col-md-8">
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $presidium->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Position -->
                        <div class="mb-3">
                            <label for="position" class="form-label">Position *</label>
                            <input type="text" class="form-control @error('position') is-invalid @enderror" 
                                   id="position" name="position" value="{{ old('position', $presidium->position) }}" 
                                   placeholder="e.g., Chairman, Vice Chairman, Secretary" required>
                            @error('position')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Side -->
                    <div class="col-md-4">
                        <!-- Current Image -->
                        <div class="mb-3">
                            <label class="form-label">Current Image</label>
                            @if($presidium->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $presidium->image) }}" 
                                         alt="{{ $presidium->name }}" 
                                         class="img-thumbnail" 
                                         style="max-height: 150px">
                                </div>
                            @else
                                <p class="text-muted">No image uploaded</p>
                            @endif
                            <label for="image" class="form-label">Change Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/jpeg,image/png,image/jpg,image/webp">
                            <small class="text-muted">Upload new image (optional)</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Presidium Member
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection