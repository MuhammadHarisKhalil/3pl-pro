<!-- filepath: /home/manafa-tech/Public/3pl/resources/views/admin/services/index.blade.php -->
@extends('layouts.app')

@section('title', 'Manage Services')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Services</h1>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i> Add New Service
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
                            <th width="70">Image</th>
                            <th>Title</th>
                            <th>Icon</th>
                            <th>Short Description</th>
                            <th width="80">Order</th>
                            <th width="80">Featured</th>
                            <th width="80">Status</th>
                            <th width="120">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                            <tr>
                                <td>
                                    @if($service->image)
                                        <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-secondary rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                            <i class="fas fa-image text-white"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $service->title }}</td>
                                <td>
                                    @if($service->icon)
                                        <i class="fa fa-{{ $service->icon }}"></i> 
                                        <code>{{ $service->icon }}</code>
                                    @else
                                        <span class="text-muted">None</span>
                                    @endif
                                </td>
                                <td>{{ Str::limit($service->short_description, 50) }}</td>
                                <td>{{ $service->display_order }}</td>
                                <td>
                                    @if($service->is_featured)
                                        <span class="badge bg-info">Featured</span>
                                    @else
                                        <span class="badge bg-secondary">No</span>
                                    @endif
                                </td>
                                <td>
                                    @if($service->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this service?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No services found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection