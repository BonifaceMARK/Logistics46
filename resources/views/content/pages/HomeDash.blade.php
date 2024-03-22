@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('content')


    <div class="container">
        <div class="card">
            <div class="card-header">Regulations</div>
            <div class="card-body">


                @if ($regulations->isEmpty())
                    <p>No regulations found.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Jurisdiction</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($regulations as $regulation)
                                <tr>
                                    <td>{{ $regulation->title }}</td>
                                    <td>{{ $regulation->jurisdiction }}</td>
                                    <td>{{ $regulation->category }}</td>
                                    <td>{{ $regulation->description }}</td>
                                    <td>{{ $regulation->created_at }}</td>
                                    <td>
                                        <a href="{{ route('regulations.show', $regulation->id) }}" class="btn btn-primary"><i
                                                class="fa-solid fa-print"></i></a>
                                        <!-- Add Edit and Delete buttons here if needed -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Departments</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Contact Person</th>
                                    <th>Contact Email</th>
                                    <th>Contact Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($departments as $department)
                                    <tr>
                                        <td>{{ $department->department_id }}</td>
                                        <td>{{ $department->name }}</td>
                                        <td>{{ $department->contact_person }}</td>
                                        <td>{{ $department->contact_email }}</td>
                                        <td>{{ $department->contact_phone }}</td>
                                        <td>
                                            <a href="{{ route('departments.show', $department) }}"
                                                class="btn btn-sm btn-primary"><i class="fa-solid fa-print"></i></a>
                                            <!-- Add buttons for edit and delete if needed -->
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No departments found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Compliance Documents</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Document Type</th>
                                    <th>Upload Date</th>
                                    <th>Expiration Date</th>
                                    <th>Related Regulation ID</th>
                                    <th>Actions</th> <!-- New column for actions -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($documents as $document)
                                    <tr>
                                        <td>{{ $document->document_id }}</td>
                                        <td>{{ $document->title }}</td>
                                        <td>{{ $document->document_type }}</td>
                                        <td>{{ $document->upload_date }}</td>
                                        <td>{{ $document->expiration_date }}</td>
                                        <td>{{ $document->related_regulation_id }}</td>
                                        <td>
                                            <a href="{{ route('documents.show', $document->id) }}"
                                                class="btn btn-primary"><i class="fa-solid fa-print"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
