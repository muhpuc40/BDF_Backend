@extends('layouts.app')

@section('title', 'Add Committee Member')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Add Committee Member</h1>
            <a href="{{ route('committees.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>

        <form action="{{ route('committees.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <!-- Left Column - Form Fields -->
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="designation" class="form-label">Designation/Position <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" value="{{ old('designation') }}" required>
                        @error('designation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="fb_link" class="form-label">Facebook Link (Optional)</label>
                        <input type="url" class="form-control @error('fb_link') is-invalid @enderror" id="fb_link" name="fb_link"
                            placeholder="https://facebook.com/username" value="{{ old('fb_link') }}">
                        @error('fb_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gmail" class="form-label">Gmail <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('gmail') is-invalid @enderror" id="gmail" name="gmail"
                            placeholder="example@gmail.com" value="{{ old('gmail') }}" required>
                        @error('gmail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="linkedin_link" class="form-label">LinkedIn Link (Optional)</label>
                        <input type="url" class="form-control @error('linkedin_link') is-invalid @enderror" id="linkedin_link" name="linkedin_link"
                            placeholder="https://linkedin.com/in/username" value="{{ old('linkedin_link') }}">
                        @error('linkedin_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="priority_level" class="form-label">Priority Level <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('priority_level') is-invalid @enderror" id="priority_level" name="priority_level"
                            value="{{ old('priority_level', 0) }}" min="0" required>
                        <small class="text-muted">Higher number means higher priority</small>
                        @error('priority_level')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Right Column - Image Upload with Preview -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Member Image <span class="text-danger">*</span></h6>
                        </div>
                        <div class="card-body text-center">
                            <!-- Image Preview Area -->
                            <div id="imagePreview" class="mb-3" style="display: none;">
                                <img id="preview" class="img-fluid rounded border" style="max-width: 100%; max-height: 200px; object-fit: cover;">
                            </div>
                            
                            <!-- Default Preview when no image -->
                            <div id="noImagePreview" class="mb-3">
                                <div class="border rounded bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                                    <i class="fas fa-user fa-3x text-muted"></i>
                                </div>
                            </div>

                            <!-- File Input -->
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" 
                                accept="image/*" onchange="previewImage(this)" required>
                            
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <small class="text-muted d-block mt-2">
                                <i class="fas fa-info-circle"></i> JPEG, PNG, JPG, GIF (Max: 2MB)
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Save Member</button>
                    <a href="{{ route('committees.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('imagePreview');
            const noImagePreview = document.getElementById('noImagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    previewContainer.style.display = 'block';
                    noImagePreview.style.display = 'none';
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '';
                previewContainer.style.display = 'none';
                noImagePreview.style.display = 'block';
            }
        }
    </script>
@endsection