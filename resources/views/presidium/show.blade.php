@extends('layouts.app')

@section('title', $presidium->name)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Presidium Member Details</h1>
        <div>
            <a href="{{ route('presidium.edit', $presidium) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('presidium.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if($presidium->image)
                        <img src="{{ asset('storage/' . $presidium->image) }}" 
                             alt="{{ $presidium->name }}" 
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
                            <td>{{ $presidium->id }}</td>
                        </tr>
                        <tr>
                            <th>Name:</th>
                            <td>{{ $presidium->name }}</td>
                        </tr>
                        <tr>
                            <th>Position:</th>
                            <td>{{ $presidium->position }}</td>
                        </tr>
                        <tr>
                            <th>Created At:</th>
                            <td>{{ $presidium->created_at->format('F d, Y h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated:</th>
                            <td>{{ $presidium->updated_at->format('F d, Y h:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection