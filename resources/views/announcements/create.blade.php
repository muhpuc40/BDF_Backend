@extends('layouts.app')

@section('title', 'Create Announcement')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Create Announcement</h1>
        <a href="{{ route('announcements.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('announcements.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description *</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="time_ago" class="form-label">Time Ago *</label>
                            <input type="text" class="form-control" id="time_ago" name="time_ago" placeholder="2 hours ago, 1 day ago, Just now" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="type" class="form-label">Type *</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="">Select Type</option>
                                <option value="urgent">Urgent</option>
                                <option value="info">Info</option>
                                <option value="warning">Warning</option>
                                <option value="success">Success</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="icon_class" class="form-label">Icon Class *</label>
                            <select class="form-control" id="icon_class" name="icon_class" required>
                                <option value="">Select Icon</option>
                                @foreach($iconClasses as $icon)
                                    <option value="{{ $icon }}">{{ $icon }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Select appropriate icon for the announcement type</small>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                Icon Preview
                            </div>
                            <div class="card-body text-center">
                                <div id="iconPreview" class="fs-1"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Announcement
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const iconClassSelect = document.getElementById('icon_class');
        const iconPreview = document.getElementById('iconPreview');
        
        function updateIconPreview() {
            const selectedIcon = iconClassSelect.value;
            if (selectedIcon) {
                const iconParts = selectedIcon.split(' ');
                const iconElement = document.createElement('i');
                iconParts.forEach(part => iconElement.classList.add(part));
                iconPreview.innerHTML = '';
                iconPreview.appendChild(iconElement);
            } else {
                iconPreview.innerHTML = '<span class="text-muted">Select an icon to preview</span>';
            }
        }
        
        iconClassSelect.addEventListener('change', updateIconPreview);
        updateIconPreview(); // Initial preview
    });
</script>
@endsection