@extends('layouts.app')

@section('title', 'Hall Details')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Hall Details</h1>
        <a href="{{ route('hall.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">ID:</th>
                            <td>{{ $hall->id }}</td>
                        </tr>
                        <tr>
                            <th>Name:</th>
                            <td>{{ $hall->name }}</td>
                        </tr>
                        <tr>
                            <th>EC:</th>
                            <td>{{ $hall->ec ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>President:</th>
                            <td>{{ $hall->president }}</td>
                        </tr>
                        <tr>
                            <th>Secretary:</th>
                            <td>{{ $hall->secretary }}</td>
                        </tr>
                        <tr>
                            <th>Created At:</th>
                            <td>{{ $hall->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    </table>
                </div>
                
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <h5>President Image</h5>
                            @if($hall->president_image)
                                <img src="{{ asset('storage/' . $hall->president_image) }}" 
                                     class="img-fluid rounded border" 
                                     style="max-height: 200px; width: auto;">
                            @else
                                <div class="text-center text-muted p-4 border rounded">
                                    <i class="fas fa-user fa-3x mb-2"></i>
                                    <p>No Image</p>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-4">
                            <h5>Secretary Image</h5>
                            @if($hall->secretary_image)
                                <img src="{{ asset('storage/' . $hall->secretary_image) }}" 
                                     class="img-fluid rounded border" 
                                     style="max-height: 200px; width: auto;">
                            @else
                                <div class="text-center text-muted p-4 border rounded">
                                    <i class="fas fa-user fa-3x mb-2"></i>
                                    <p>No Image</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection