@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Dashboard')

@section('content')


<div class="container-fluid">
  <div class="row">
      <div class="col-lg-12">
          <div class="card mb-3">
              <div class="card-header bg-primary text-white" style="background-image: url('{{ asset('assets/img/bg.jpg') }}'); background-size: cover; background-position: center;">
                  <div class="d-flex justify-content-between align-items-center">
                      <div class="d-flex align-items-center">
                          <img src="{{ asset('assets/img/logo/bbox-express-logo.png') }}" alt="Bbox Express Logo" class="img-fluid mr-3" style="max-width: 200px;">
                          <h1 class="violet-text-shadow" style="font-size: 80px; color: rgb(79, 25, 110);"><strong>Bbox Express</strong></h1>
                      </div>
                      <div class="row">
                          <!-- Additional content if needed -->
                      </div>
                  </div>
              </div>
              <div class="card-body">
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
                  <!-- End Modal -->

                  <div class="row">
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
                                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#chartModal">Open Chart</button>
                              </div>
                          </div>
                      </div>
                      <!-- Add more columns as needed -->
                  </div>
              </div><!-- End Card Body -->
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
                <div class="modal-content">
                    <div class="modal-header" >
                        <h3 class="modal-title " id="carDeliveredModalLabel"><strong>Delivery Cars</strong></h3>
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
          <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card h-80">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('assets/img/compliance.jpg') }}" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><strong>What is Compliance Regulatory?</strong></h5>
                                    <p class="card-text">Compliance with regulations refers to the act of ensuring that an organization or individual is following all applicable laws, rules, and regulations that govern their industry or activity. This can include laws and regulations related to environmental protection, labor practices, financial reporting, data privacy, and many other areas. Compliance with regulations is important because failure to comply can result in legal penalties, fines, reputational damage, and other negative consequences.</p>
                                    <p>Compliance can be achieved through a variety of methods, such as self-audits, internal controls, training and education programs, and third-party audits. Ultimately, compliance with regulations is a critical aspect of operating a responsible and sustainable business or engaging in any activity that is subject to regulatory oversight.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="row g-0">
                            <div class="col-md-6">
                                <img src="{{ asset('assets/img/standards.jpg') }}" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-12">
                                <div class="card-body">
                                    <h5 class="card-title"><strong>What is Company Standards?</strong></h5>
                                    <ul>
                                        <li><strong>Safety Regulations:</strong> Comply with regulations for safe transportation of goods, including packaging, labeling, and handling hazardous materials (e.g., IMDG Code, ADR).</li>
                                        <li><strong>Customs Regulations:</strong> Adhere to customs procedures and trade regulations for import and export activities.</li>
                                        <li><strong>Environmental Regulations:</strong> Follow guidelines for sustainable practices and waste management during transportation activities.</li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <ul>
                                        <li><strong>Code of Conduct:</strong> Establish a company-wide code of conduct outlining ethical behavior, anti-corruption practices, and conflict of interest policies.</li>
                                        <li><strong>Data Privacy:</strong> Implement and adhere to data privacy regulations, such as GDPR (EU) or CCPA (CA), regarding data collection, storage, and usage.</li>
                                        <li><strong>Financial Reporting Standards:</strong> Follow relevant accounting standards (e.g., IFRS, US GAAP) for accurate financial reporting and record-keeping.</li>
                                        <li><strong>Internal Controls:</strong> Maintain robust internal controls to ensure the integrity of financial transactions, prevent fraud, and promote operational efficiency.</li>
                                        <li><strong>Incident Reporting:</strong> Establish clear procedures for reporting incidents like accidents, security breaches, and ethical violations.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('assets/img/ediprocess.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><strong>What is Electronic Data Interchange?</strong></h5>
                            <p class="card-text">Electronic Data Interchange (EDI) is a method of exchanging business documents between organizations in a standardized electronic format. These documents can include purchase orders, invoices, shipping notices, and more. Instead of relying on paper-based documents that are prone to errors, delays, and manual processing, EDI enables the seamless exchange of structured data directly between computer systems.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
