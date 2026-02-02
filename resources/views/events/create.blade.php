@extends('layouts.app')

@section('title', 'Create Event')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Create Event</h1>
        <a href="{{ route('events.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Title *</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description *</label>
                            <textarea class="form-control" name="description" rows="5" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Location *</label>
                            <input type="text" class="form-control" name="location" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Image *</label>
                            <input type="file" class="form-control" name="image" accept="image/*" required>
                            <small class="text-muted">Max 2MB. Allowed: JPG, PNG, GIF</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Image Preview</label>
                            <div id="imagePreview" class="border rounded p-3 text-center" 
                                 style="min-height: 150px; background-color: #f8f9fa;">
                                <p class="text-muted mb-0">No image selected</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Date *</label>
                        <input type="date" class="form-control" name="date" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Time</label>
                        <input type="time" class="form-control" name="time">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Type *</label>
                        <select class="form-control" name="type" required>
                            <option value="">Select Type</option>
                            <option value="upcoming">Upcoming</option>
                            <option value="ongoing">Ongoing</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Category *</label>
                        <select class="form-control" name="category" required>
                            <option value="">Select Category</option>
                            <option value="training">Training</option>
                            <option value="international">International</option>
                            <option value="national">National</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Participants</label>
                        <input type="text" class="form-control" name="participants" placeholder="e.g., 5000+">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Registration Deadline</label>
                        <input type="date" class="form-control" name="registration_deadline">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control" name="status" placeholder="e.g., Open for Registration">
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Save Event</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.querySelector('input[name="image"]');
    const imagePreview = document.getElementById('imagePreview');
    
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                imagePreview.innerHTML = `<img src="${e.target.result}" class="img-fluid" style="max-height: 150px;">`;
            }
            
            reader.readAsDataURL(file);
        } else {
            imagePreview.innerHTML = '<p class="text-muted mb-0">No image selected</p>';
        }
    });
});
</script>
@endsection