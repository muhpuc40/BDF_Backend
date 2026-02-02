@extends('layouts.app')

@section('title', 'Add Committee Member')

@section('content')
<div class="container">
    <h2>Add Committee Member</h2>
    
    <form action="{{ route('committees.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Name *</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        
        <div class="mb-3">
            <label for="designation" class="form-label">Designation/Position *</label>
            <input type="text" class="form-control" id="designation" name="designation" required>
        </div>
        
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>
        
        <div class="mb-3">
            <label for="fb_link" class="form-label">Facebook Link</label>
            <input type="url" class="form-control" id="fb_link" name="fb_link" placeholder="https://facebook.com/username">
        </div>
        
        <div class="mb-3">
            <label for="gmail" class="form-label">Gmail</label>
            <input type="email" class="form-control" id="gmail" name="gmail" placeholder="example@gmail.com">
        </div>
        
        <div class="mb-3">
            <label for="linkedin_link" class="form-label">LinkedIn Link</label>
            <input type="url" class="form-control" id="linkedin_link" name="linkedin_link" placeholder="https://linkedin.com/in/username">
        </div>
        
        <div class="mb-3">
            <label for="priority_level" class="form-label">Priority Level</label>
            <input type="number" class="form-control" id="priority_level" name="priority_level" value="0" min="0">
            <small class="text-muted">Higher number means higher priority in display order</small>
        </div>
        
        <button type="submit" class="btn btn-primary">Save Member</button>
        <a href="{{ route('committees.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection