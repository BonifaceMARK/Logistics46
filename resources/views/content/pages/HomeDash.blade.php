@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('content')


<div class="row">
  <div class="col-lg-12">
      <div class="card mb-3">
        <div class="card-header bg-primary text-white" style="background-image: url('{{ asset('assets/img/bg.jpg') }}'); background-size: cover; background-position: center;">
              <div class="d-flex justify-content-between align-items-center">
                  <div style="display: flex; align-items: center;">
                      <img src="{{ asset('assets/img/logo/bbox-express-logo.png') }}" alt="Bbox Express Logo" style="max-width: 200px; padding: 10px;">
                      <h1 class="text" style="margin: 0 0 0 10px; font-size: 80px; text-shadow: -1px -1px 0 WHITE, 2px -1px 0 WHITE, -1px 2px 0 WHITE, 2px 2px 0 WHITE; color: rgb(110, 82, 175);"><strong>Bbox Express</strong></h1>


                  </div>
                  <!-- Button to trigger the modal -->
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pdfModal">
                      Ansi-X12
                  </button>
              </div>
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-md-3 mb-4">
                      <div class="card">
                          <div class="card-header">
                              <h5 class="card-title m-0">Car Delivered</h5>
                          </div>
                          <div class="card-body">
                              <ul class="timeline mb-0 pb-1">
                                  @foreach($drivers as $driver)
                                  <li class="timeline-item ps-4 border-left-dashed pb-1">
                                      <span class="timeline-indicator-advanced timeline-indicator-success">
                                          <i class="ti ti-circle-check"></i>
                                      </span>
                                      <div class="timeline-event px-0 pb-0">
                                          <div class="timeline-header">
                                              <small class="text-success text-uppercase fw-medium">VEHICLE</small>
                                          </div>
                                          <h6 class="mb-1">{{ $driver['vehicle_brand'] }}</h6>
                                          <p class="text-muted mb-0">Plate Number: {{ $driver['plate_number'] }}</p>
                                          <p class="text-muted mb-0">Load Capacity: {{ $driver['load_capacity'] }}</p>
                                      </div>
                                  </li>
                                  @endforeach
                              </ul>
                          </div>
                      </div>
                  </div>

                  <div class="col-md-3 mb-3">
                      <div class="card card-border-shadow-primary">
                          <div class="card-body">
                              <div class="d-flex align-items-center mb-2 pb-1">
                                  <div class="avatar me-2">
                                      <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-truck ti-md"></i></span>
                                  </div>
                                  <h4 class="ms-1 mb-0">{{ count($drivers) }}</h4>
                              </div>
                              <p class="mb-1">On route drivers</p>
                          </div>
                      </div>
                  </div>
              </div><!-- End Row -->
          </div><!-- End Card Body -->
      </div><!-- End Card -->
  </div><!-- End Col -->
</div><!-- End Row -->

<!-- Modal -->
<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="pdfModalLabel">Compliance Standards</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <div class="card">
                  <div class="card-body pdf-viewer">
                      <h4 class="card-title">
                          American National Standards Institute (ANSI) Accredited Standards Committee (ASC) X12.
                      </h4>
                      <iframe src="{{ asset('assets/img/ansi.pdf') }}" width="100%" height="600px" frameborder="0"></iframe>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

@endsection
