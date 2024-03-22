@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Create Page')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <h4> User Page</h4>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Create Department</h5>
                        <!-- Default Tabs -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                    type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                    type="button" role="tab" aria-controls="profile"
                                    aria-selected="false">View</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                    type="button" role="tab" aria-controls="contact"
                                    aria-selected="false">Create</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2" id="myTabContent">
                            <div class="col-md-8 tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">



                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
                                                                            class="btn btn-sm btn-primary">View</a>
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
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <div class="card">
                                                <div class="card-header">Create Department</div>

                                                <div class="card-body">
                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif

                                                    <form method="POST" action="{{ route('departments.store') }}">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="department_id">Department ID</label>
                                                            <input type="text" class="form-control" id="department_id"
                                                                name="department_id" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Name</label>
                                                            <input type="text" class="form-control" id="name"
                                                                name="name" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="contact_person">Contact Person</label>
                                                            <input type="text" class="form-control" id="contact_person"
                                                                name="contact_person" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="contact_email">Contact Email</label>
                                                            <input type="email" class="form-control" id="contact_email"
                                                                name="contact_email" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="contact_phone">Contact Phone</label>
                                                            <input type="text" class="form-control" id="contact_phone"
                                                                name="contact_phone" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Create
                                                            Department</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Default Tabs -->

                    </div>
                </div>



            </div>

        </div>
    </section>


@endsection
