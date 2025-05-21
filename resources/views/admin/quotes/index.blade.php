<!-- filepath: /home/manafa-tech/Public/3pl/resources/views/admin/quotes/index.blade.php -->
@extends('layouts.app')

@section('title', 'Manage Quote Requests')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Quote Requests</h1>

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
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Service</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quotes as $quote)
                            <tr>
                                <td>{{ $quote->id }}</td>
                                <td>{{ $quote->name }}</td>
                                <td>{{ $quote->email }}</td>
                                <td>{{ $quote->service->title ?? 'N/A' }}</td>
                                <td>
                                    @if($quote->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($quote->status == 'in_progress')
                                        <span class="badge bg-info">In Progress</span>
                                    @elseif($quote->status == 'completed')
                                        <span class="badge bg-success">Completed</span>
                                    @elseif($quote->status == 'declined')
                                        <span class="badge bg-danger">Declined</span>
                                    @endif
                                </td>
                                <td>{{ $quote->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.quotes.show', $quote) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.quotes.destroy', $quote) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this quote?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No quote requests found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-3">
                {{ $quotes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection