@extends('layouts.app')

@section('title', 'Add Directory Entry')

@section('content')
<div class="container">
    <h2>Add Directory Entry</h2>
    
    <form action="{{ route('directory.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="club_name" class="form-label">Club Name *</label>
                <input type="text" class="form-control" id="club_name" name="club_name" required>
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="university" class="form-label">University *</label>
                <input type="text" class="form-control" id="university" name="university" required>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="president" class="form-label">President *</label>
                <input type="text" class="form-control" id="president" name="president" required>
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="general_secretary" class="form-label">General Secretary *</label>
                <input type="text" class="form-control" id="general_secretary" name="general_secretary" required>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="contact" class="form-label">Contact *</label>
                <input type="text" class="form-control" id="contact" name="contact" required>
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email *</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="location" class="form-label">Location *</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="established" class="form-label">Established Year *</label>
                <input type="text" class="form-control" id="established" name="established" required>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="members" class="form-label">Number of Members *</label>
                <input type="text" class="form-control" id="members" name="members" required>
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="status" class="form-label">Status *</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                    <option value="Suspended">Suspended</option>
                </select>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="facebook_url" class="form-label">Facebook URL</label>
            <input type="url" class="form-control" id="facebook_url" name="facebook_url" placeholder="https://facebook.com/clubname">
        </div>
        
        <button type="submit" class="btn btn-primary">Save Entry</button>
        <a href="{{ route('directory.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection