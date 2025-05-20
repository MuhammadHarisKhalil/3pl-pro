@extends('layouts.app')

@section('title', 'Edit Site Information')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Site Information</h4>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.site-info.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Simplified tab structure -->
                        <ul class="nav nav-tabs" id="siteTabs" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active" id="company-tab" data-bs-toggle="tab" data-bs-target="#company" type="button">
                                    Company Info
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="social-tab" data-bs-toggle="tab" data-bs-target="#social" type="button">
                                    Social Media
                                </button>
                            </li>
                        </ul>
                        
                        <div class="tab-content p-3 border border-top-0 rounded-bottom" id="siteTabsContent">
                            <!-- Company Tab -->
                            <div class="tab-pane fade show active" id="company" role="tabpanel">
                                <div class="row">
                                    @foreach($siteInfosByGroup['company'] ?? [] as $info)
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label for="company_{{ $info->key }}" class="form-label fw-bold">
                                                    {{ $info->display_name }}
                                                </label>
                                                
                                                @if(in_array($info->key, ['address']))
                                                    <textarea 
                                                        name="info[company][{{ $info->key }}]" 
                                                        id="company_{{ $info->key }}" 
                                                        class="form-control" 
                                                        rows="3">{{ $info->value }}</textarea>
                                                @else
                                                    <input 
                                                        type="{{ $info->key === 'email' ? 'email' : 'text' }}" 
                                                        name="info[company][{{ $info->key }}]" 
                                                        id="company_{{ $info->key }}" 
                                                        class="form-control" 
                                                        value="{{ $info->value }}">
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Social Tab -->
                            <div class="tab-pane fade" id="social" role="tabpanel">
                                <div class="row">
                                    @foreach($siteInfosByGroup['social'] ?? [] as $info)
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label for="social_{{ $info->key }}" class="form-label fw-bold">
                                                    {{ $info->display_name }}
                                                </label>
                                                <input 
                                                    type="url" 
                                                    name="info[social][{{ $info->key }}]" 
                                                    id="social_{{ $info->key }}" 
                                                    class="form-control" 
                                                    value="{{ $info->value }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i> Save Information
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
    // Ensure tabs are working correctly
    document.addEventListener('DOMContentLoaded', function() {
        var triggerTabList = [].slice.call(document.querySelectorAll('#siteTabs button'))
        triggerTabList.forEach(function(triggerEl) {
            var tabTrigger = new bootstrap.Tab(triggerEl)
            
            triggerEl.addEventListener('click', function(event) {
                event.preventDefault()
                tabTrigger.show()
            })
        })
    });
</script>
@endsection