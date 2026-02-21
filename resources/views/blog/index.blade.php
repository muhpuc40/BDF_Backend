@extends('layouts.app')

@section('title', 'Blog Management')

@section('content')
<div class="container-fluid px-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Blog Management</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Status filter tabs --}}
    <div class="card mb-4">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ $status === 'all' ? 'active' : '' }}"
                       href="{{ route('blog.index') }}">
                        All
                        <span class="badge bg-secondary ms-1">{{ $counts['all'] }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $status === 'pending' ? 'active' : '' }}"
                       href="{{ route('blog.index', ['status' => 'pending']) }}">
                        Pending
                        <span class="badge bg-warning text-dark ms-1">{{ $counts['pending'] }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $status === 'accepted' ? 'active' : '' }}"
                       href="{{ route('blog.index', ['status' => 'accepted']) }}">
                        Accepted
                        <span class="badge bg-success ms-1">{{ $counts['accepted'] }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $status === 'hidden' ? 'active' : '' }}"
                       href="{{ route('blog.index', ['status' => 'hidden']) }}">
                        Hidden
                        <span class="badge bg-dark ms-1">{{ $counts['hidden'] }}</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="50">#</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th width="200">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($blogs as $blog)
                        <tr>
                            <td>{{ $blog->id }}</td>
                            <td>
                                <div class="fw-semibold">{{ Str::limit($blog->title, 50) }}</div>
                                <small class="text-muted">{{ Str::limit($blog->content, 80) }}</small>
                            </td>
                            <td>{{ $blog->user->full_name ?? '—' }}</td>
                            <td>
                                @if($blog->image)
                                    <img src="{{ asset('storage/' . $blog->image) }}"
                                         alt="blog" width="60" height="40"
                                         class="rounded object-fit-cover">
                                @else
                                    <span class="text-muted small">No image</span>
                                @endif
                            </td>
                            <td>
                                @if($blog->status === 'accepted')
                                    <span class="badge bg-success">Accepted</span>
                                @elseif($blog->status === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @else
                                    <span class="badge bg-dark">Hidden</span>
                                @endif
                            </td>
                            <td>
                                <small>{{ $blog->created_at->format('d M Y') }}</small>
                            </td>
                            <td>
                                <div class="d-flex gap-1 flex-wrap">

                                    {{-- Accept --}}
                                    @if($blog->status !== 'accepted')
                                    <form action="{{ route('blog.accept', $blog->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm"
                                                title="Accept">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    @endif

                                    {{-- Hide --}}
                                    @if($blog->status !== 'hidden')
                                    <form action="{{ route('blog.hide', $blog->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-secondary btn-sm"
                                                title="Hide">
                                            <i class="fas fa-eye-slash"></i>
                                        </button>
                                    </form>
                                    @endif

                                    {{-- Edit --}}
                                    <a href="{{ route('blog.edit', $blog->id) }}"
                                       class="btn btn-primary btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('blog.destroy', $blog->id) }}" method="POST"
                                          onsubmit="return confirm('Delete this blog?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                No blogs found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($blogs->hasPages())
        <div class="card-footer">
            {{ $blogs->appends(['status' => $status])->links() }}
        </div>
        @endif
    </div>

</div>
@endsection