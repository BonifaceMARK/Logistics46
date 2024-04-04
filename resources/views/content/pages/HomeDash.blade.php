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

                  <div class="row">


                </div>




                <!-- Modal -->
                <div class="modal fade" id="carDeliveredModal" tabindex="-1" role="dialog" aria-labelledby="carDeliveredModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="carDeliveredModalLabel">Car Delivered</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                  <!-- Button to trigger the modal -->

              </div>
          </div>
          <div class="card-body"  style="background-image: url('{{ asset('assets/img/dash1.jpg') }}'); background-size: cover; background-position: center;">
           <br>
            <div class="row">
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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#carDeliveredModal">
                          View
                      </button>
                    </div>
                </div>
            </div>

                  <div class="col-md-12 mb-12">
                  <div class="card">
                    <div class="card-body">
                        <!-- Container for the chart -->
                        <div id="chart"></div>
                    </div>
                  </div>
                </div>

              </div><!-- End Row -->
               <!-- Container for the chart -->


               <script>
                // Define a function to render the chart
                function renderChart() {
                    // Chart data passed from controller
                    const vehicleBrands = @json($vehicleBrands);
                    const loadCapacities = @json($loadCapacities);

                    // Create chart options
                    const options = {
                        chart: {
                            type: 'bar'
                        },
                        series: [{
                            name: 'Load Capacity',
                            data: loadCapacities
                        }],
                        xaxis: {
                            categories: vehicleBrands,
                            title: {
                                text: 'Vehicle Brands'
                            }
                        },
                        yaxis: {
                            title: {
                                text: 'Load Capacity'
                            }
                        },
                        title: {
                            text: 'Vehicle Load Capacities'
                        }
                    };

                    // Initialize the chart with options
                    const chart = new ApexCharts(document.querySelector("#chart"), options);

                    // Render the chart
                    chart.render();
                }

                // Check if ApexCharts is loaded, then render the chart
                if (typeof ApexCharts === 'undefined') {
                    // If ApexCharts is not loaded, wait for it to load
                    document.addEventListener('apexcharts:loaded', renderChart);
                } else {
                    // If ApexCharts is already loaded, render the chart immediately
                    renderChart();
                }
            </script>

          </div><!-- End Card Body -->
      </div><!-- End Card -->
  </div><!-- End Col -->
</div><!-- End Row -->

<!-- Modal -->
<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
          <div class="modal-header">
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
