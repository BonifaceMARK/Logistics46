@extends('layouts.layoutMaster')

@section('title', 'Compliance Document Details')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Compliance Document Details</div>

                <div class="card-body">
                    <p><strong>Title:</strong> {{ $document->document_id }}</p>
                    <p><strong>Title:</strong> {{ $document->title }}</p>
                    <p><strong>Document Type:</strong> {{ $document->document_type }}</p>
                    <p><strong>File Path:</strong> {{ $document->file_path }}</p>
                    <p><strong>Upload Date:</strong> {{ $document->upload_date }}</p>
                    <p><strong>Expiration Date:</strong> {{ $document->expiration_date }}</p>
                    <p><strong>Related Regulation ID:</strong> {{ $document->related_regulation_id }}</p>

                    <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
