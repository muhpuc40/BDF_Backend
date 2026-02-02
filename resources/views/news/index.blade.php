@extends('layouts.app')

@section('title', 'News Management')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>News Management</h1>
        <a href="{{ route('news.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add News
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Author</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($news as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ Str::limit($item->title, 50) }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $item->category }}</span>
                            </td>
                            <td>{{ $item->date->format('M d, Y') }}</td>
                            <td>{{ $item->author }}</td>
                            <td>
                                <a href="{{ route('news.show', $item) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <!-- Add edit/delete buttons here if needed -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $news->links() }}
        </div>
    </div>
</div>
@endsection