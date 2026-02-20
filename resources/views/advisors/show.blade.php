@extends('layouts.app')

@section('title', $advisor->name)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Advisor Details</h1>
        <div>
            <a href="{{ route('advisors.edit', $advisor) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('advisors.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if($advisor->image)
                        <img src="{{ asset('storage/' . $advisor->image) }}" 
                             alt="{{ $advisor->name }}" 
                             class="img-fluid" 
                             style="max-width: 250px; max-height: 250px; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center mx-auto" 
                             style="width: 250px; height: 250px;">
                            <i class="fas fa-user fa-5x text-secondary"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <table class="table">
                        <tr>
                            <th style="width: 150px;">ID:</th>
                            <td>{{ $advisor->id }}</td>
                        </tr>
                        <tr>
                            <th>Name:</th>
                            <td>{{ $advisor->name }}</td>
                        </tr>
                        <tr>
                            <th>Position:</th>
                            <td>{{ $advisor->position }}</td>
                        </tr>
                        <tr>
                            <th>Created At:</th>
                            <td>{{ $advisor->created_at->format('F d, Y h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated:</th>
                            <td>{{ $advisor->updated_at->format('F d, Y h:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection