@extends('layouts.app')

@section('title', 'Create Hall Entry')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Create Hall Entry</h1>
        <a href="{{ route('hall.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('hall.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Name *</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">EC</label>
                            <input type="text" class="form-control" name="ec" placeholder="e.g., 1st Executive Committee">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">President *</label>
                            <input type="text" class="form-control" name="president" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Secretary *</label>
                            <input type="text" class="form-control" name="secretary" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- President Image -->
                        <div class="mb-3">
                            <label class="form-label">President Image</label>
                            <input type="file" class="form-control" name="president_image" accept="image/*" id="presidentImageInput">
                            <small class="text-muted">Max 2MB. Allowed: JPG, PNG, GIF</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">President Image Preview</label>
                            <div id="presidentImagePreview" class="border rounded p-3 text-center" 
                                 style="min-height: 150px; background-color: #f8f9fa;">
                                <p class="text-muted mb-0">No image selected</p>
                            </div>
                        </div>

                        <!-- Secretary Image -->
                        <div class="mb-3">
                            <label class="form-label">Secretary Image</label>
                            <input type="file" class="form-control" name="secretary_image" accept="image/*" id="secretaryImageInput">
                            <small class="text-muted">Max 2MB. Allowed: JPG, PNG, GIF</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Secretary Image Preview</label>
                            <div id="secretaryImagePreview" class="border rounded p-3 text-center" 
                                 style="min-height: 150px; background-color: #f8f9fa;">
                                <p class="text-muted mb-0">No image selected</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Save Entry</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const presidentImageInput = document.getElementById('presidentImageInput');
    const presidentImagePreview = document.getElementById('presidentImagePreview');
    
    presidentImageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                presidentImagePreview.innerHTML = `<img src="${e.target.result}" class="img-fluid" style="max-height: 150px;">`;
            }
            
            reader.readAsDataURL(file);
        } else {
            presidentImagePreview.innerHTML = '<p class="text-muted mb-0">No image selected</p>';
        }
    });

    const secretaryImageInput = document.getElementById('secretaryImageInput');
    const secretaryImagePreview = document.getElementById('secretaryImagePreview');
    
    secretaryImageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                secretaryImagePreview.innerHTML = `<img src="${e.target.result}" class="img-fluid" style="max-height: 150px;">`;
            }
            
            reader.readAsDataURL(file);
        } else {
            secretaryImagePreview.innerHTML = '<p class="text-muted mb-0">No image selected</p>';
        }
    });
});
</script>
@endsection