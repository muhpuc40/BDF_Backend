@extends('layouts.app')

@section('title', 'Edit Blog')

@section('content')
<div class="container-fluid px-4">

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('blog.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <h1 class="h3 mb-0">Edit Blog</h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <strong>Blog #{{ $blog->id }}</strong>
                    <span class="text-muted ms-2">by {{ $blog->user->full_name ?? '—' }}</span>
                </div>
                <div class="card-body">

                    <form action="{{ route('blog.update', $blog->id) }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Title</label>
                            <input type="text" name="title" value="{{ old('title', $blog->title) }}"
                                   class="form-control @error('title') is-invalid @enderror"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Content --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Content</label>
                            <textarea name="content" rows="8"
                                      class="form-control @error('content') is-invalid @enderror"
                                      required>{{ old('content', $blog->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status"
                                    class="form-select @error('status') is-invalid @enderror">
                                <option value="pending"
                                    {{ old('status', $blog->status) === 'pending'  ? 'selected' : '' }}>
                                    Pending
                                </option>
                                <option value="accepted"
                                    {{ old('status', $blog->status) === 'accepted' ? 'selected' : '' }}>
                                    Accepted
                                </option>
                                <option value="hidden"
                                    {{ old('status', $blog->status) === 'hidden'   ? 'selected' : '' }}>
                                    Hidden
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Current Image --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Image</label>
                            @if($blog->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $blog->image) }}"
                                         alt="current" class="img-thumbnail" style="max-height:200px">
                                    <p class="text-muted small mt-1">Current image. Upload a new one to replace it.</p>
                                </div>
                            @endif
                            <input type="file" name="image"
                                   class="form-control @error('image') is-invalid @enderror"
                                   accept="image/jpg,image/jpeg,image/png,image/webp">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Save Changes
                            </button>
                            <a href="{{ route('blog.index') }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        {{-- Info sidebar --}}
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Blog Info</div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-5">Author</dt>
                        <dd class="col-7">{{ $blog->user->full_name ?? '—' }}</dd>

                        <dt class="col-5">Created</dt>
                        <dd class="col-7">{{ $blog->created_at->format('d M Y') }}</dd>

                        <dt class="col-5">Updated</dt>
                        <dd class="col-7">{{ $blog->updated_at->format('d M Y') }}</dd>

                        <dt class="col-5">Status</dt>
                        <dd class="col-7">
                            @if($blog->status === 'accepted')
                                <span class="badge bg-success">Accepted</span>
                            @elseif($blog->status === 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-dark">Hidden</span>
                            @endif
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection