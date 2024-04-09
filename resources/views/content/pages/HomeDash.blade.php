@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('content')


<div class="container-fluid">
  <div class="row">
      <div class="col-lg-12">
          <div class="card mb-3">
              <div class="card-header bg-primary text-white" style="background-image: url('{{ asset('assets/img/bg.jpg') }}'); background-size: cover; background-position: center;">
                  <div class="d-flex justify-content-between align-items-center">
                      <div class="d-flex align-items-center">
                          <img src="{{ asset('assets/img/logo/bbox-express-logo.png') }}" alt="Bbox Express Logo" class="img-fluid mr-3" style="max-width: 200px;">
                          <h1 class="violet-text-shadow" style="font-size: 80px; color: rgb(121, 74, 148);"><strong>Bbox Express</strong></h1>
                        </div>
                      <div class="row">
                          <!-- Additional content if needed -->
                      </div>
                  </div>
              </div>
              <div class="card-body" >
                  <br>
                  <div class="row">
                    <div class="card">
                      <div class="card-header">
                          Process EDIFACTS
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th>ID</th>
                                          <th>Fleet Management</th>
                                          <th>Payment Gateways</th> <!-- Empty table column for buttons -->
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td>1</td>
                                          <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vehicleListModal">
                                            Process Edifact
                                          </button>
                                          </td>
                                          <td>
                                              <!-- You can put buttons here -->
                                            <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Process Edifact
</button>

                                          </td>
                                      </tr>
                                      <!-- Add more rows as needed -->
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>


                  <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="vehicleListModal" tabindex="-1" aria-labelledby="vehicleListModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="vehicleListModalLabel">Vehicle List</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="table-responsive">
                  <table class="table">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Vehicle ID</th>
                              <th>Brand</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($drivers as $vehicle)
                          <tr>
                              <td>{{ $vehicle['id'] }}</td>
                              <td>{{ $vehicle['vehicle_id'] }}</td>
                              <td>{{ $vehicle['vehicle_brand'] }}</td>
                              <td>
                                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vehicleModal{{ $vehicle['id'] }}">
                                      View Details
                                  </button>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>

@foreach ($drivers as $vehicle)
<div class="modal fade" id="vehicleModal{{ $vehicle['id'] }}" tabindex="-1" aria-labelledby="vehicleModal{{ $vehicle['id'] }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vehicleModal{{ $vehicle['id'] }}Label">Vehicle Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID:</strong> {{ $vehicle['id'] }}</p>
                <p><strong>Vehicle ID:</strong> {{ $vehicle['vehicle_id'] }}</p>
                <p><strong>Brand:</strong> {{ $vehicle['vehicle_brand'] }}</p>
                <p><strong>Year Model:</strong> {{ $vehicle['year_model'] }}</p>
                <p><strong>Type:</strong> {{ $vehicle['vehicle_type'] }}</p>
                <p><strong>Plate Number:</strong> {{ $vehicle['plate_number'] }}</p>
                <p><strong>Load Capacity:</strong> {{ $vehicle['load_capacity'] }}</p>
                <p><strong>Status:</strong> {{ $vehicle['status'] }}</p>
                <p><strong>Created At:</strong> {{ $vehicle['created_at'] }}</p>
                <p><strong>Updated At:</strong> {{ $vehicle['updated_at'] }}</p>
                <!-- Add more vehicle details as needed -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="processEDIFACT({{ $vehicle['id'] }})">Process to EDIFACT</button>
            </div>
        </div>
    </div>
</div>

<script>
  function processToEDIFACT(vehicleId) {
      // Fetch necessary data associated with the vehicle ID
      var vehicleData = {
          id: vehicleId,
          // Add more data fields if needed
      };

      // Send AJAX request to process vehicle into EDIFACT format
      $.ajax({
          type: "POST",
          url: "{{ route('vehicles.processToEDIFACT') }}",
          data: {
              vehicle: vehicleData,
              _token: '{{ csrf_token() }}'
          },
          success: function(response) {
              // Display the EDIFACT data in a modal
              $('#edifactModalContent').text(response.edifact);
              $('#edifactModal').modal('show');
          },
          error: function(xhr, status, error) {
              // Handle error response
              console.error(xhr.responseText);
              alert('Failed to process vehicle to EDIFACT format');
          }
      });
  }
</script>

@endforeach





<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">External Data Table</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card col-lg-12">
          <div class="card-body">
              <h1 class="card-title">Transaction List</h1>
              @if (count($transactions) > 0)
                  <div class="table-responsive">
                      <table class="table table-striped">
                          <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Transaction Name</th>


                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($transactions as $transaction)
                                  <tr>
                                      <td>{{ $transaction['id'] }}</td>
                                      <td>{{ $transaction['transactionName'] }}</td>

                                      <td>
                                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#transactionModal{{ $transaction['id'] }}">
                                              View Details
                                          </button>
                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              @else
                  <p>No transactions found.</p>
              @endif
          </div>
      </div>
      </div>
    </div>
  </div>
</div>

@foreach ($transactions as $transaction)
<!-- Modal -->
<div class="modal fade" id="transactionModal{{ $transaction['id'] }}" tabindex="-1" role="dialog" aria-labelledby="transactionModal{{ $transaction['id'] }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transactionModal{{ $transaction['id'] }}Label">Transaction Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Store transaction details in hidden input field -->
                <input type="hidden" id="transactionDetails{{ $transaction['id'] }}" value="{{ json_encode($transaction) }}">

                <!-- Display transaction details -->
                <p><strong>ID:</strong> {{ $transaction['id'] }}</p>
                <p><strong>Reference:</strong> {{ $transaction['reference'] }}</p>
                <p><strong>Product Name:</strong> {{ $transaction['productName'] }}</p>
                <p><strong>Transaction Name:</strong> {{ $transaction['transactionName'] }}</p>
                <p><strong>Payment Method:</strong> {{ $transaction['paymentMethod'] }}</p>
                <p><strong>Card Type:</strong> {{ $transaction['cardType'] }}</p>
                <p><strong>Transaction Type:</strong> {{ $transaction['transactionType'] }}</p>
                <p><strong>Transaction Amount:</strong> ${{ number_format($transaction['transactionAmount'], 2) }}</p>
                <p><strong>Transaction Date:</strong> {{ \Carbon\Carbon::parse($transaction['transactionDate'])->format('Y-m-d') }}</p>
                <p><strong>Transaction Status:</strong> {{ $transaction['transactionStatus'] }}</p>
                <!-- Add other transaction details as needed -->

                <!-- Button to process into EDIFACT or ANSI-X12 -->
                        </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="processToEDIFACT({{ $transaction['id'] }})">Process to EDIFACT</button>

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal for displaying EDIFACT data -->
<div class="modal fade" id="edifactModal" tabindex="-1" role="dialog" aria-labelledby="edifactModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="edifactModalLabel">EDIFACT</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <pre id="edifactModalContent"></pre>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="printEDIFACT()">Print</button>
          </div>
      </div>
  </div>
</div>

<script>
  function printEDIFACT() {
      var edifactContent = document.getElementById('edifactModalContent').innerText;
      var printWindow = window.open('', '', 'width=800,height=600');
      printWindow.document.write('<html><head><title>EDIFACT Data</title></head><body>');
      printWindow.document.write('<pre>' + edifactContent + '</pre>');
      printWindow.document.write('</body></html>');
      printWindow.document.close();
      printWindow.print();
  }
</script>

<script>
   function processToEDIFACT(transactionId) {
    // Get the transaction details from the hidden input field
    var transactionDetails = JSON.parse($('#transactionDetails' + transactionId).val());

    // Send AJAX request to process transaction into EDIFACT format
    $.ajax({
        type: "POST",
        url: "{{ route('transactions.processToEDIFACT') }}",
        data: {
            transaction: transactionDetails,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            // Display the EDIFACT data in a modal
            $('#edifactModalContent').text(response.edifact);
            $('#edifactModal').modal('show');
        },
        error: function(xhr, status, error) {
            // Handle error response
            console.error(xhr.responseText);
            alert('Failed to process transaction to EDIFACT format');
        }
    });
}

</script>




<!-- Modal -->
<div class="modal fade" id="chartModal" tabindex="-1" aria-labelledby="chartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="chartModalLabel">Route Delivery Analytics</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="col-md-12">
                  <div class="card mb-3">
                      <div class="card-body">
                          <!-- Container for the chart -->
                          <div id="chart"></div>
                          <div id="bar"></div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>

                      <div class="col-md-3">
                          <div class="card mb-3">
                              <div class="card-body">
                                  <div class="d-flex align-items-center mb-2">
                                      <div class="avatar mr-2">
                                          <span class="avatar-initial rounded bg-primary text-white"><i class="ti ti-truck"></i></span>
                                      </div>
                                      <h4 class="mb-0">{{ count($drivers) }}</h4>
                                  </div>
                                  <p class="mb-1">On route drivers</p>
                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#carDeliveredModal">View</button>
         <!-- Button to trigger modal -->
         <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#chartModal">
          Open Chart
        </button>
                              </div>
                          </div>
                      </div>
                  </div>
                  <br>

          </div><!-- End Card -->
      </div><!-- End Col -->
  </div><!-- End Row -->
</div><!-- End Container -->

<script>
  // Define a function to render the chart
  function renderChart() {
      // Chart data passed from controller
      const vehicleBrands = @json($vehicleBrands);
      const loadCapacities = @json($loadCapacities);

      // Create chart options
      const options = {
          chart: {
              type: 'line'
          },
          series: [{
              name: 'Load Capacity',
              data: loadCapacities
          }],
          xaxis: {
              categories: vehicleBrands,
              title: {
                  text: 'Vehicle Brands',

              }
          },
          yaxis: {
              title: {
                  text: 'Load Capacity',

              }
          },
          title: {
              text: 'Vehicle Load Capacities',

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
    text: 'Vehicle Brands',

}
},
yaxis: {
title: {
    text: 'Load Capacity',

}
},
title: {
text: 'Vehicle Load Capacities',

}
};

// Initialize the chart with options
const chart = new ApexCharts(document.querySelector("#bar"), options);

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
           <!-- Modal -->
           <div class="modal fade"   id="carDeliveredModal" tabindex="-1" role="dialog" aria-labelledby="carDeliveredModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-left" role="document">
                <div class="modal-content" style="background-image: url('{{ asset('assets/img/car.jpg') }}'); background-size: cover;">
                    <div class="modal-header" >
                        <h3 class="modal-title text-white" id="carDeliveredModalLabel"><strong>Car Delivered</strong></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="timeline mb-0 pb-1">
                                    @foreach($drivers as $driver)
                                    <li class="timeline-item ps-4 border-left-dashed pb-1" style="background-color: transparent;">
                                        <span class="timeline-indicator-advanced timeline-indicator-success"   style="background-color: transparent;">
                                            <i class="ti ti-circle-check"  style="background-color: transparent;"></i>
                                        </span>
                                        <div class="timeline-event px-0 pb-0" style="background-color: transparent;">
                                            <div class="timeline-header"  style="background-color: transparent;">
                                                <small class="text-success text-uppercase fw-medium" style="color: transparent;">VEHICLE</small>
                                            </div>
                                            <h4 class="mb-1" ><strong>{{ $driver['vehicle_brand'] }}</strong></h4>
                                            <p class="text-muted mb-0" style="color: transparent;">Plate Number: {{ $driver['plate_number'] }}</p>
                                            <p class="text-muted mb-0" style="color: transparent;">Load Capacity: {{ $driver['load_capacity'] }}</p>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="color: transparent;">
                        <button  type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
          </div>
@endsection
