@extends('layouts.layoutMaster')

@section('title', 'Compliance Regulation Details')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">{{ $regulation->title }}</h1>
        </div>
        <div class="card-body">
            <p><strong>Jurisdiction:</strong> {{ $regulation->jurisdiction }}</p>
            <p><strong>Category:</strong> {{ $regulation->category }}</p>
            <p><strong>Description:</strong> {{ $regulation->description }}</p>
            <p><strong>Created At:</strong> {{ $regulation->created_at }}</p>
            <p><strong>Updated At:</strong> {{ $regulation->updated_at }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('home') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
