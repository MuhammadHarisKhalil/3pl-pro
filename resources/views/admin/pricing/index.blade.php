@extends('layouts.app')

@section('title', 'Manage Pricing Plans')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Pricing Plans</h1>
        <a href="{{ route('admin.pricing.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i> Add New Plan
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
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Duration</th>
                            <th>Features</th>
                            <th>Popular</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($plans as $plan)
                            <tr>
                                <td>{{ $plan->display_order }}</td>
                                <td>{{ $plan->name }}</td>
                                <td>${{ number_format($plan->price, 2) }}</td>
                                <td>{{ $plan->duration }}</td>
                                <td>{{ $plan->features->count() }}</td>
                                <td>
                                    @if($plan->is_popular)
                                        <span class="badge bg-success">Yes</span>
                                    @else
                                        <span class="badge bg-secondary">No</span>
                                    @endif
                                </td>
                                <td>
                                    @if($plan->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.pricing.edit', $plan) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.pricing.destroy', $plan) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this plan?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No pricing plans found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection