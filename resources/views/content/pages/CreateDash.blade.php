@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts.layoutMaster')

@section('title', 'User Dashboard')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li><i class="text-center primary fa-solid fa-circle-exclamation"></i>{{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <!-- Default Tabs -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                    type="button" role="tab" aria-controls="home" aria-selected="true"><i
                                        class="fa-solid fa-house"></i> Home </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="regulation-tab" data-bs-toggle="tab"
                                    data-bs-target="#regulation" type="button" role="tab" aria-controls="regulation"
                                    aria-selected="false">Regulation <i class="fa-solid fa-circle-arrow-right"></i></button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                    type="button" role="tab" aria-controls="profile" aria-selected="false">Document <i
                                        class="fa-solid fa-circle-arrow-right"></i></button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                    type="button" role="tab" aria-controls="contact" aria-selected="false">Department
                                    <i class="fa-solid fa-circle-arrow-right"></i></button>
                            </li>
                        </ul>

                        <div class="tab-content pt-2" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <!-- Content for Home Tab -->
                            </div>

                            <div class="tab-pane fade" id="regulation" role="tabpanel" aria-labelledby="regulation-tab">
                                <!-- Content for Regulation Tab -->
                                <div class="container">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Create New Regulation</h3>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('regulations.store') }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="regulation_id" class="form-label">Regulation ID</label>
                                                    <input type="number" class="form-control" id="regulation_id"
                                                        name="regulation_id" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input type="text" class="form-control" id="title" name="title"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jurisdiction" class="form-label">Jurisdiction</label>
                                                    <input type="text" class="form-control" id="jurisdiction"
                                                        name="jurisdiction" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="category" class="form-label">Category</label>
                                                    <input type="text" class="form-control" id="category"
                                                        name="category" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Description</label>
                                                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <!-- Content for Profile Tab -->
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <div class="card">
                                                <h3 class="card-header">Create Document</h3>
                                                <div class="card-body">
                                                    <form method="POST" action="{{ route('documents.store') }}">
                                                        @csrf

                                                        <div class="form-group row">
                                                            <label for="document_id"
                                                                class="col-md-4 col-form-label text-md-right">Document
                                                                ID</label>

                                                            <div class="col-md-6">
                                                                <input id="document_id" type="number"
                                                                    class="form-control" name="document_id" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="title"
                                                                class="col-md-4 col-form-label text-md-right">Title</label>

                                                            <div class="col-md-6">
                                                                <input id="title" type="text" class="form-control"
                                                                    name="title" required autofocus>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="document_type"
                                                                class="col-md-4 col-form-label text-md-right">Document
                                                                Type</label>

                                                            <div class="col-md-6">
                                                                <input id="document_type" type="text"
                                                                    class="form-control" name="document_type" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="file_path"
                                                                class="col-md-4 col-form-label text-md-right">File
                                                                Path</label>

                                                            <div class="col-md-6">
                                                                <input id="file_path" type="text" class="form-control"
                                                                    name="file_path" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="upload_date"
                                                                class="col-md-4 col-form-label text-md-right">Upload
                                                                Date</label>

                                                            <div class="col-md-6">
                                                                <input id="upload_date" type="date"
                                                                    class="form-control" name="upload_date" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="expiration_date"
                                                                class="col-md-4 col-form-label text-md-right">Expiration
                                                                Date</label>

                                                            <div class="col-md-6">
                                                                <input id="expiration_date" type="date"
                                                                    class="form-control" name="expiration_date">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="related_regulation_id"
                                                                class="col-md-4 col-form-label text-md-right">Related
                                                                Regulation</label>
                                                            <div class="col-md-6">
                                                                <select id="related_regulation_id" class="form-control"
                                                                    name="related_regulation_id" required>
                                                                    <option value="">Select a related regulation
                                                                    </option>
                                                                    @foreach ($regulations as $regulation)
                                                                        <option value="{{ $regulation->regulation_id }}">
                                                                            {{ $regulation->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row mb-0">
                                                            <div class="col-md-6 offset-md-4">
                                                                <button type="submit" class="btn btn-primary">
                                                                    Create Document
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <!-- Content for Contact Tab -->
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <div class="card">
                                                <h3 class="card-header">Create Department</h3>
                                                <div class="card-body">
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
                                                            <input type="text" class="form-control"
                                                                id="contact_person" name="contact_person" required>
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
                        </div><!-- End Tab Content -->
                    </div><!-- End Card Body -->
                </div><!-- End Card -->
            </div><!-- End Col-lg-12 -->
        </div><!-- End Row -->
    </section><!-- End Section -->
@endsection
