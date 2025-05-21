<!-- filepath: /home/manafa-tech/Public/3pl/resources/views/admin/services/create.blade.php -->
@extends('layouts.app')

@section('title', 'Add New Service')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Add New Service</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row mb-4">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label fw-bold">Service Title</label>
                                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="slug" class="form-label fw-bold">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}">
                                    <small class="text-muted">Leave empty to auto-generate</small>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="short_description" class="form-label fw-bold">Short Description</label>
                            <textarea name="short_description" id="short_description" rows="2" class="form-control @error('short_description') is-invalid @enderror">{{ old('short_description') }}</textarea>
                            <small class="text-muted">Brief description shown on service cards (max 500 characters)</small>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Full Description</label>
                            <textarea name="description" id="description" rows="6" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="icon" class="form-label fw-bold">Icon</label>
                                    <div class="input-group">
                                        <span class="input-group-text">fa-</span>
                                        <input type="text" name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon', 'truck') }}" placeholder="truck">
                                    </div>
                                    <small class="text-muted">Enter a Font Awesome icon name (e.g., "truck", "warehouse")</small>
                                    @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="image" class="form-label fw-bold">Featured Image</label>
                                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                    <small class="text-muted">Recommended size: 800x600 pixels</small>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="display_order" class="form-label fw-bold">Display Order</label>
                                    <input type="number" name="display_order" id="display_order" class="form-control @error('display_order') is-invalid @enderror" value="{{ old('display_order', 0) }}">
                                    @error('display_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-bold d-block">Featured</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">Show on Homepage</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-bold d-block">Status</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i> Save Service
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Auto-generate slug from title
    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');
        
        titleInput.addEventListener('keyup', function() {
            if (!slugInput.value) {
                slugInput.value = titleInput.value
                    .toLowerCase()
                    .replace(/[^\w ]+/g, '')
                    .replace(/ +/g, '-');
            }
        });
    });
</script>
@endsection