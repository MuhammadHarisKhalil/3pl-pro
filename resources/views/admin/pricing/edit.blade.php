{{-- filepath: /home/manafa-tech/Public/3pl/resources/views/admin/pricing/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Pricing Plan')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Pricing Plan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pricing.update', $plan) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-bold">Plan Name</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $plan->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="price" class="form-label fw-bold">Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $plan->price) }}" required>
                                    </div>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="duration" class="form-label fw-bold">Duration</label>
                                    <select name="duration" id="duration" class="form-select @error('duration') is-invalid @enderror">
                                        <option value="Monthly" {{ old('duration', $plan->duration) == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                                        <option value="Quarterly" {{ old('duration', $plan->duration) == 'Quarterly' ? 'selected' : '' }}>Quarterly</option>
                                        <option value="Yearly" {{ old('duration', $plan->duration) == 'Yearly' ? 'selected' : '' }}>Yearly</option>
                                    </select>
                                    @error('duration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="icon" class="form-label fw-bold">Icon</label>
                                    <div class="input-group">
                                        <span class="input-group-text">fa-</span>
                                        <input type="text" name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon', $plan->icon) }}" placeholder="box">
                                    </div>
                                    <small class="text-muted">Enter a Font Awesome icon name (e.g., "box", "truck")</small>
                                    @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label for="display_order" class="form-label fw-bold">Display Order</label>
                                    <input type="number" name="display_order" id="display_order" class="form-control @error('display_order') is-invalid @enderror" value="{{ old('display_order', $plan->display_order) }}">
                                    @error('display_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Popular</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_popular" id="is_popular" value="1" {{ old('is_popular', $plan->is_popular) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_popular">Mark as Popular</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Status</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $plan->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Description</label>
                            <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $plan->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <hr class="my-4">
                        
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5>Plan Features</h5>
                                <button type="button" class="btn btn-sm btn-success" id="add-feature">
                                    <i class="fas fa-plus"></i> Add Feature
                                </button>
                            </div>
                            
                            <div id="features-container">
                                <!-- Existing features will be loaded here -->
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.pricing.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i> Update Plan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const featuresContainer = document.getElementById('features-container');
        const addFeatureBtn = document.getElementById('add-feature');
        let featureCount = 0;
        
        function addFeature(feature = null) {
            const featureRow = document.createElement('div');
            featureRow.className = 'feature-row row mb-3 align-items-center';
            
            featureRow.innerHTML = `
                <div class="col-md-9">
                    <input type="text" name="features[${featureCount}][feature_text]" 
                           class="form-control" placeholder="Enter feature" 
                           value="${feature ? feature.feature_text : ''}">
                    ${feature && feature.id ? `<input type="hidden" name="features[${featureCount}][id]" value="${feature.id}">` : ''}
                </div>
                <div class="col-md-2">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" 
                               name="features[${featureCount}][is_included]" 
                               value="1" ${!feature || feature.is_included ? 'checked' : ''}>
                        <label class="form-check-label">Included</label>
                    </div>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-sm btn-danger remove-feature">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            
            featuresContainer.appendChild(featureRow);
            
            // Add event listener to remove button
            featureRow.querySelector('.remove-feature').addEventListener('click', function() {
                featureRow.remove();
            });
            
            featureCount++;
        }
        
        // Load existing features
        const existingFeatures = @json($plan->features);
        
        if (existingFeatures.length > 0) {
            existingFeatures.forEach(feature => {
                addFeature(feature);
            });
        } else {
            // Add initial empty feature if no existing features
            addFeature();
        }
        
        // Add feature button click handler
        addFeatureBtn.addEventListener('click', function() {
            addFeature();
        });
    });
</script>
@endsection
@endsection