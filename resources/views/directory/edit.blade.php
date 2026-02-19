@extends('layouts.app')

@section('title', 'Edit Club')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Club: {{ $directory->club_name }}</h1>
        <a href="{{ route('directory.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Directory
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('directory.update', $directory) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="club_name" class="form-label">Club Name *</label>
                        <input type="text" class="form-control @error('club_name') is-invalid @enderror" 
                               id="club_name" name="club_name" value="{{ old('club_name', $directory->club_name) }}" required>
                        @error('club_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="university" class="form-label">University *</label>
                        <input type="text" class="form-control @error('university') is-invalid @enderror" 
                               id="university" name="university" value="{{ old('university', $directory->university) }}" required>
                        @error('university')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="president" class="form-label">President *</label>
                        <input type="text" class="form-control @error('president') is-invalid @enderror" 
                               id="president" name="president" value="{{ old('president', $directory->president) }}" required>
                        @error('president')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="general_secretary" class="form-label">General Secretary *</label>
                        <input type="text" class="form-control @error('general_secretary') is-invalid @enderror" 
                               id="general_secretary" name="general_secretary" value="{{ old('general_secretary', $directory->general_secretary) }}" required>
                        @error('general_secretary')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="contact" class="form-label">Contact *</label>
                        <input type="text" class="form-control @error('contact') is-invalid @enderror" 
                               id="contact" name="contact" value="{{ old('contact', $directory->contact) }}" required>
                        @error('contact')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', $directory->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="location" class="form-label">Location *</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" 
                               id="location" name="location" value="{{ old('location', $directory->location) }}" required>
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="facebook_url" class="form-label">Facebook URL</label>
                        <input type="url" class="form-control @error('facebook_url') is-invalid @enderror" 
                               id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $directory->facebook_url) }}">
                        @error('facebook_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="established" class="form-label">Established *</label>
                        <input type="text" class="form-control @error('established') is-invalid @enderror" 
                               id="established" name="established" value="{{ old('established', $directory->established) }}" required>
                        @error('established')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="members" class="form-label">Members *</label>
                        <input type="text" class="form-control @error('members') is-invalid @enderror" 
                               id="members" name="members" value="{{ old('members', $directory->members) }}" required>
                        @error('members')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="status" class="form-label">Status *</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="">Select Status</option>
                            <option value="Active" {{ old('status', $directory->status) == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ old('status', $directory->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="Suspended" {{ old('status', $directory->status) == 'Suspended' ? 'selected' : '' }}>Suspended</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Club
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection