@extends('layouts.layoutMaster')

@section('title', 'Department Details')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $department->name }}</div>

                    <div class="card-body">
                        <p><strong>Department ID:</strong> {{ $department->department_id }}</p>
                        <p><strong>Contact Person:</strong> {{ $department->contact_person }}</p>
                        <p><strong>Contact Email:</strong> {{ $department->contact_email }}</p>
                        <p><strong>Contact Phone:</strong> {{ $department->contact_phone }}</p>

                        <!-- Add more details if needed -->
                        <div class="mt-3">
                            <a href="{{ route('home') }}" class="btn btn-secondary">Back to Departments</a>
                            <!-- Add edit and delete buttons if needed -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
