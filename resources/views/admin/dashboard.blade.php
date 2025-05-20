@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-4">Admin Dashboard</h1>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Total Contacts</h6>
                                <h2 class="card-text">{{ \App\Models\Contact::count() }}</h2>
                            </div>
                            <i class="fa fa-envelope fa-3x opacity-50"></i>
                        </div>
                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-light mt-3">View All</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Recent Contacts</h6>
                                <h2 class="card-text">
                                    {{ \App\Models\Contact::where('created_at', '>=', now()->subDays(7))->count() }}</h2>
                            </div>
                            <i class="fa fa-calendar-alt fa-3x opacity-50"></i>
                        </div>
                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-light mt-3">View All</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Today's Contacts</h6>
                                <h2 class="card-text">{{ \App\Models\Contact::whereDate('created_at', today())->count() }}
                                </h2>
                            </div>
                            <i class="fa fa-clock fa-3x opacity-50"></i>
                        </div>
                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-light mt-3">View All</a>
                    </div>
                </div>
            </div>
            {{-- Add to your admin dashboard --}}
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-info-circle fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Site Information</h5>
                        <p class="card-text">Manage company contact details and social media links</p>
                        <a href="{{ route('admin.site-info.edit') }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i> Edit Information
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Recent Contact Messages</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(\App\Models\Contact::latest()->take(5)->get() as $contact)
                                        <tr>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->subject }}</td>
                                            <td>{{ $contact->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.contacts.show', $contact) }}"
                                                    class="btn btn-sm btn-info">View</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No recent contacts</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('admin.contacts.index') }}" class="btn btn-primary">View All Contacts</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
