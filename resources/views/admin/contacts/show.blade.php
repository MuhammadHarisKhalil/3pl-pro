@extends('layouts.app')

@section('title', 'View Contact')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>View Contact</h1>
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Name:</div>
                <div class="col-md-9">{{ $contact->name }}</div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Email:</div>
                <div class="col-md-9">{{ $contact->email }}</div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Subject:</div>
                <div class="col-md-9">{{ $contact->subject }}</div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Sent on:</div>
                <div class="col-md-9">{{ $contact->created_at->format('F d, Y \a\t h:i A') }}</div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Message:</div>
                <div class="col-md-9">
                    <div class="p-3 bg-light rounded">
                        {{ $contact->message }}
                    </div>
                </div>
            </div>
            
            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.contacts.edit', $contact) }}" class="btn btn-warning">
                    <i class="fa fa-edit"></i> Edit
                </a>
                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this contact?')">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection