<!-- filepath: /home/manafa-tech/Public/3pl/resources/views/admin/quotes/show.blade.php -->
@extends('layouts.app')

@section('title', 'Quote Request Details')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Quote Request #{{ $quote->id }}</h1>
        <a href="{{ route('admin.quotes.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to List
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Quote Details</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Name:</div>
                        <div class="col-md-8">{{ $quote->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Email:</div>
                        <div class="col-md-8">
                            <a href="mailto:{{ $quote->email }}">{{ $quote->email }}</a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Phone:</div>
                        <div class="col-md-8">
                            @if($quote->phone)
                                <a href="tel:{{ $quote->phone }}">{{ $quote->phone }}</a>
                            @else
                                <span class="text-muted">Not provided</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Service:</div>
                        <div class="col-md-8">{{ $quote->service->title ?? 'Not specified' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Message:</div>
                        <div class="col-md-8">
                            @if($quote->message)
                                {{ $quote->message }}
                            @else
                                <span class="text-muted">No message provided</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Date Requested:</div>
                        <div class="col-md-8">{{ $quote->created_at->format('F d, Y g:i A') }}</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Status Update</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.quotes.update-status', $quote) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-3">
                            <label for="status" class="form-label fw-bold">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="pending" {{ $quote->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ $quote->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ $quote->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="declined" {{ $quote->status == 'declined' ? 'selected' : '' }}>Declined</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="notes" class="form-label fw-bold">Internal Notes</label>
                            <textarea name="notes" id="notes" rows="4" class="form-control">{{ $quote->notes }}</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save me-2"></i> Update Status
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Actions</h5>
                </div>
                <div class="card-body">
                    <a href="mailto:{{ $quote->email }}" class="btn btn-info w-100 mb-2">
                        <i class="fas fa-envelope me-2"></i> Email Client
                    </a>
                    
                    <form action="{{ route('admin.quotes.destroy', $quote) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to delete this quote request?')">
                            <i class="fas fa-trash me-2"></i> Delete Request
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection