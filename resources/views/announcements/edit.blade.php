@extends('layouts.app')

@section('title', 'Edit Announcement')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Announcement</h1>
        <a href="{{ route('announcements.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('announcements.update', $announcement) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $announcement->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description', $announcement->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="type" class="form-label">Type *</label>
                            <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                                <option value="urgent" {{ old('type', $announcement->type) == 'urgent' ? 'selected' : '' }}>Urgent</option>
                                <option value="info" {{ old('type', $announcement->type) == 'info' ? 'selected' : '' }}>Info</option>
                                <option value="warning" {{ old('type', $announcement->type) == 'warning' ? 'selected' : '' }}>Warning</option>
                                <option value="success" {{ old('type', $announcement->type) == 'success' ? 'selected' : '' }}>Success</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="time_ago" class="form-label">Time Ago *</label>
                            <input type="text" class="form-control @error('time_ago') is-invalid @enderror" id="time_ago" name="time_ago" value="{{ old('time_ago', $announcement->time_ago) }}" placeholder="e.g., 2 hours ago" required>
                            @error('time_ago')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="icon_class" class="form-label">Icon Class *</label>
                            <select class="form-control @error('icon_class') is-invalid @enderror" id="icon_class" name="icon_class" required>
                                @foreach($iconClasses as $iconClass)
                                    <option value="{{ $iconClass }}" {{ old('icon_class', $announcement->icon_class) == $iconClass ? 'selected' : '' }}>
                                        {{ $iconClass }}
                                    </option>
                                @endforeach
                            </select>
                            @error('icon_class')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Preview: <i class="{{ old('icon_class', $announcement->icon_class) }}"></i></small>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Announcement
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Preview icon when selected
    document.getElementById('icon_class').addEventListener('change', function() {
        const preview = document.querySelector('small.text-muted i');
        preview.className = this.value;
    });
</script>
@endpush
@endsection