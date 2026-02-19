@extends('layouts.app')

@section('title', 'Edit Hall Entry')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Hall Entry: {{ $hall->name }}</h1>
        <a href="{{ route('hall.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('hall.update', $hall) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $hall->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="ec" class="form-label">EC</label>
                        <input type="text" class="form-control @error('ec') is-invalid @enderror" 
                               id="ec" name="ec" value="{{ old('ec', $hall->ec) }}">
                        @error('ec')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="president" class="form-label">President <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('president') is-invalid @enderror" 
                               id="president" name="president" value="{{ old('president', $hall->president) }}" required>
                        @error('president')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="secretary" class="form-label">Secretary <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('secretary') is-invalid @enderror" 
                               id="secretary" name="secretary" value="{{ old('secretary', $hall->secretary) }}" required>
                        @error('secretary')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="president_image" class="form-label">President Image</label>
                        @if($hall->president_image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $hall->president_image) }}" 
                                     alt="Current President" style="height: 100px; object-fit: cover;" class="border rounded">
                                <p class="text-muted small mt-1">Current image. Upload new to replace.</p>
                            </div>
                        @endif
                        <input type="file" class="form-control @error('president_image') is-invalid @enderror" 
                               id="president_image" name="president_image" accept="image/*" onchange="previewImage(this, 'presidentPreview')">
                        @error('president_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div id="presidentPreviewContainer" class="mt-2" style="display: none;">
                            <img id="presidentPreview" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="secretary_image" class="form-label">Secretary Image</label>
                        @if($hall->secretary_image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $hall->secretary_image) }}" 
                                     alt="Current Secretary" style="height: 100px; object-fit: cover;" class="border rounded">
                                <p class="text-muted small mt-1">Current image. Upload new to replace.</p>
                            </div>
                        @endif
                        <input type="file" class="form-control @error('secretary_image') is-invalid @enderror" 
                               id="secretary_image" name="secretary_image" accept="image/*" onchange="previewImage(this, 'secretaryPreview')">
                        @error('secretary_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div id="secretaryPreviewContainer" class="mt-2" style="display: none;">
                            <img id="secretaryPreview" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Entry
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const previewContainer = document.getElementById(previewId + 'Container');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
        }

        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '';
        previewContainer.style.display = 'none';
    }
}
</script>
@endsection