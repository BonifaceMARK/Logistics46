@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts.layoutMaster')

@section('title', 'Edi & Compliance')

@section('content')
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


<div class="container-fluid mt-4">

  <div class="card">
    <div class="card-header" style="background-image: url('{{ asset('assets/img/dash1.jpg') }}'); background-size: cover; background-position: center;">
     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pdfModal">
        Edifact ansi-x12
    </button>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  View Processed Edifact
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-image: url('{{ asset('assets/img/edi.jpg') }}'); background-size: cover; background-position: center;">
        <h1 class="modal-title text-white" id="exampleModalLabel">Edifacts</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @foreach ($edifactContent as $edifact)
        <div class="card mb-3">
          <div class="card-body">
            <pre>{{ $edifact->content }}</pre>
          </div>
        </div>
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>










    </div>
    <div class="card-body">

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
                                    <i class="fa-solid fa-bars"></i>
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

  <div class="card">
    <div class="card-header bg-primary text-white" style="background-image: url('{{ asset('assets/img/logistics.jpg') }}'); background-size: cover;">


          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rulesModal">
              View Rules & Regulations
          </button>
          <!-- Button trigger modal -->




      </div>

<div class="card">
  <div class="card-body">
      <table class="table">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Company</th>
                  <th>Status</th>
                  <th>Created At</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
              @foreach($vendors as $vendor)
                  <tr>
                      <td>{{ $vendor['id'] }}</td>
                      <td>{{ $vendor['name'] }}</td>
                      <td>{{ $vendor['company'] }}</td>
                      <td>{{ $vendor['status'] }}</td>
                      <td>{{ \Carbon\Carbon::parse($vendor['created_at'])->format('Y-m-d H:i:s') }}</td>
<td>
  <div class="d-flex">
  <form action="/approve" method="GET">
    <input type="text" class="d-none" name='id' value="{{$vendor['id']}}">
    <input type="text" class="d-none" name='status' value="Verified">
    <input type="text" class="d-none" name='email' value="{{$vendor['email']}}">
  <button type="submit" class="btn btn-primary" name="Approve">Approve</button>
</form>

<form action="">
  <input type="text" class="d-none" name='id' value="{{$vendor['id']}}">
    <input type="text" class="d-none" name='status' value="Verified">
    <input type="text" class="d-none" name='email' value="{{$vendor['email']}}">
  <button type="submit" class="btn btn-primary" name="Reject">Reject</button>
</form>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vendorModal" name="Comply">Comply</button>
</div><!-- Modal -->
<div class="modal fade" id="vendorModal" tabindex="-1" aria-labelledby="vendorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="vendorModalLabel">Vendor Compliance</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="mb-3">
          <label for="complianceReason" class="form-label">Reason for Compliance</label>
          <textarea class="form-control" id="complianceReason" name="complianceReason" rows="3"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Confirm</button>
      </div>
    </div>
  </div>
</div>


</td>

                  </tr>
              @endforeach
          </tbody>
      </table>
  </div>
</div>

<div class="card-title">Pending Certificates</div>
      <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                  <tr>
                      <th>Company Name</th>
                      <th>Company Address</th>
                      <th>Contact Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Certificate of Business Registration</th>
                      <th>Certificate of DTI</th>
                      <th>Business License</th>
                      <th>Certificate of BIR</th>
                      <th>Certificate of Insurance</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($carriers as $carrier)
                      <tr>
                          <td>{{ $carrier['companyName'] }}</td>
                          <td>{{ $carrier['companyAddress'] }}</td>
                          <td>{{ $carrier['contactName'] }}</td>
                          <td>{{ $carrier['email'] }}</td>
                          <td>{{ $carrier['phone'] }}</td>
                          <td>
                            @if(isset($carrier['certificateBusiness']))
                                <a href="#" data-bs-toggle="modal" data-bs-target="#certificateBusinessModal{{ $carrier['id'] }}">
                                    <img src="{{ $carrier['certificateBusiness'] }}" alt="Certificate of Business Registration" style="max-width: 100px;">
                                </a>
                                <!-- Modal -->
                                <div class="modal fade" id="certificateBusinessModal{{ $carrier['id'] }}" tabindex="-1" aria-labelledby="certificateBusinessModalLabel{{ $carrier['id'] }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="certificateBusinessModalLabel{{ $carrier['id'] }}">Certificate of Business Registration</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{ $carrier['certificateBusiness'] }}" alt="Certificate of Business Registration" style="max-width: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                N/A
                            @endif
                        </td>

                        <td>
                          @if(isset($carrier['certificateDTI']))
                              <a href="#" data-bs-toggle="modal" data-bs-target="#certificateDTIModal{{ $carrier['id'] }}">
                                  <img src="{{ $carrier['certificateDTI'] }}" alt="Certificate of DTI" style="max-width: 100px;">
                              </a>
                              <!-- Modal -->
                              <div class="modal fade" id="certificateDTIModal{{ $carrier['id'] }}" tabindex="-1" aria-labelledby="certificateDTIModalLabel{{ $carrier['id'] }}" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="certificateDTIModalLabel{{ $carrier['id'] }}">Certificate of DTI</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                              <img src="{{ $carrier['certificateDTI'] }}" alt="Certificate of DTI" style="max-width: 100%;">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          @else
                              N/A
                          @endif
                      </td>

                      <td>
                        @if(isset($carrier['businessLicense']))
                            <a href="#" data-bs-toggle="modal" data-bs-target="#businessLicenseModal{{ $carrier['id'] }}">
                                <img src="{{ $carrier['businessLicense'] }}" alt="Business License" style="max-width: 100px;">
                            </a>
                            <!-- Modal -->
                            <div class="modal fade" id="businessLicenseModal{{ $carrier['id'] }}" tabindex="-1" aria-labelledby="businessLicenseModalLabel{{ $carrier['id'] }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="businessLicenseModalLabel{{ $carrier['id'] }}">Business License</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ $carrier['businessLicense'] }}" alt="Business License" style="max-width: 100%;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            N/A
                        @endif
                    </td>

                    <td>
                      @if(isset($carrier['certificateBIR']))
                          <a href="#" data-bs-toggle="modal" data-bs-target="#certificateBIRModal{{ $carrier['id'] }}">
                              <img src="{{ $carrier['certificateBIR'] }}" alt="Certificate of BIR" style="max-width: 100px;">
                          </a>
                          <!-- Modal -->
                          <div class="modal fade" id="certificateBIRModal{{ $carrier['id'] }}" tabindex="-1" aria-labelledby="certificateBIRModalLabel{{ $carrier['id'] }}" aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="certificateBIRModalLabel{{ $carrier['id'] }}">Certificate of BIR</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                          <img src="{{ $carrier['certificateBIR'] }}" alt="Certificate of BIR" style="max-width: 100%;">
                                      </div>
                                  </div>
                              </div>
                          </div>
                      @else
                          N/A
                      @endif
                  </td>

                  <td>
                    @if(isset($carrier['certificateInsurance']))
                        <a href="#" data-bs-toggle="modal" data-bs-target="#certificateInsuranceModal{{ $carrier['id'] }}">
                            <img src="{{ $carrier['certificateInsurance'] }}" alt="Certificate of Insurance" style="max-width: 100px;">
                        </a>
                        <!-- Modal -->
                        <div class="modal fade" id="certificateInsuranceModal{{ $carrier['id'] }}" tabindex="-1" aria-labelledby="certificateInsuranceModalLabel{{ $carrier['id'] }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="certificateInsuranceModalLabel{{ $carrier['id'] }}">Certificate of Insurance</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ $carrier['certificateInsurance'] }}" alt="Certificate of Insurance" style="max-width: 100%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        N/A
                    @endif
                </td>

                <td style="color:
                @if($carrier['status'] == 'Pending')
                    orange;
                @elseif($carrier['status'] == 'Approve')
                    green;
                @elseif($carrier['status'] == 'Rejected')
                    red;
                @else
                    black;
                @endif">
                {{ $carrier['status'] }}
            </td>

                          <td>
                              <!-- Button trigger modal -->
                              <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#notesAndStatusModal{{ $carrier['id'] }}">Notes & Status</button>
                              <!-- Modal -->
                              <div class="modal fade" id="notesAndStatusModal{{ $carrier['id'] }}" tabindex="-1" aria-labelledby="notesAndStatusModalLabel{{ $carrier['id'] }}" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="notesAndStatusModalLabel{{ $carrier['id'] }}">Notes & Status</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            <form action="{{ route('carriers.save-notes-status', ['id' => $carrier['id']]) }}" method="POST">
                                              @csrf

                                              <div class="form-group">
                                                  <textarea class="form-control mb-3" name="notes" rows="4" placeholder="Enter notes here..."></textarea>
                                                  <div class="btn-group" role="group" aria-label="Status">
                                                      <label class="btn btn-success">
                                                          <input type="radio" name="status" value="Approve"> Approve
                                                      </label>
                                                      <label class="btn btn-danger">
                                                          <input type="radio" name="status" value="Reject"> Reject
                                                      </label>
                                                      <label class="btn btn-info">
                                                          <input type="radio" name="status" value="Comply"> Comply
                                                      </label>
                                                  </div>
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="submit" class="btn btn-primary">Save Notes & Status</button>
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                              </div>
                                          </form>

                                      </div>
                                  </div>
                              </div>
                              <!-- End Modal -->
                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>

          </div>
      </div>
  </div>
</div>

<!-- Original Modal Template -->
@foreach ($transactions as $transaction)
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
                <!-- Button to trigger the Invoice Modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoiceModal{{ $transaction['id'] }}">
      View Invoice
  </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach ($transactions as $transaction)
    <!-- Modal for Invoice -->
    <div class="modal fade" id="invoiceModal{{ $transaction['id'] }}" tabindex="-1" role="dialog" aria-labelledby="invoiceModal{{ $transaction['id'] }}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white" style="background-image: url('{{asset('assets/img/edi.jpg')}}'); background-size: cover; background-position: center;">
                    <h5 class="modal-title" id="invoiceModal{{ $transaction['id'] }}Label">Invoice</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalContent{{ $transaction['id'] }}">
                    <!-- Invoice content here -->
                    <div class="invoice">
                        <div class="row">
                            <div class="col-6">
                                <h3>Invoice #{{ $transaction['id'] }}</h3>
                            </div>
                            <div class="col-6 text-end">
                                <p class="invoice-date"><strong>Date:</strong> {{ \Carbon\Carbon::parse($transaction['transactionDate'])->format('F j, Y') }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="invoice-details">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><strong>Reference:</strong></td>
                                        <td>{{ $transaction['reference'] }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Product Name:</strong></td>
                                        <td>{{ $transaction['productName'] }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Transaction Name:</strong></td>
                                        <td>{{ $transaction['transactionName'] }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Payment Method:</strong></td>
                                        <td>{{ $transaction['paymentMethod'] }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Card Type:</strong></td>
                                        <td>{{ $transaction['cardType'] }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Transaction Type:</strong></td>
                                        <td>{{ $transaction['transactionType'] }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Transaction Amount:</strong></td>
                                        <td>${{ number_format($transaction['transactionAmount'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Transaction Date:</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($transaction['transactionDate'])->format('F j, Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Transaction Status:</strong></td>
                                        <td>{{ $transaction['transactionStatus'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="printInvoice({{ $transaction['id'] }})">Print Invoice</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

<script>
    function printInvoice(transactionId) {
        // Get the content of the modal
        var modalContent = document.getElementById('modalContent' + transactionId).innerHTML;

        // Open a new window
        var printWindow = window.open('', '', 'height=600,width=800');

        // Write the content to the new window
        printWindow.document.write('<html><head><title>Print Invoice</title>');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<h1>Invoice</h1>');
        printWindow.document.write(modalContent);
        printWindow.document.write('</body></html>');

        // Print or save as PDF
        printWindow.print();
    }
</script>






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
              <button type="button" class="btn btn-primary" onclick="saveAndPrintEDIFACT()">Save & Print</button>
          </div>
      </div>
  </div>
</div>



<script>
  function saveAndPrintEDIFACT() {
      // Get the content of the EDIFACT modal
      var edifactContent = document.getElementById('edifactModalContent').textContent;

      // Send the content to your server using AJAX
      fetch('/save-edifact', {
          method: 'POST', // Explicitly specify the method as POST
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}', // Include CSRF token if needed
          },
          body: JSON.stringify({ content: edifactContent }),
      })
      .then(response => {
          if (response.ok) {
              // Successfully saved the content, now print it
              printEDIFACT(edifactContent);
          } else {
              // Handle error
              console.error('Failed to save EDIFACT content');
          }
      })
      .catch(error => {
          console.error('Error:', error);
      });
  }

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

<!-- Modal -->
<div class="modal fade" id="rulesModal" tabindex="-1" aria-labelledby="rulesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="rulesModalLabel">Rules & Regulations</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <ol>
                  <li>Obtain necessary licenses/permits (Obtain and maintain all required licenses and permits to operate legally.)</li>
                  <li>Comply with safety regulations (Implement safety measures to prevent accidents and comply with all safety regulations.)</li>
                  <li>Provide proper training (Train employees on company policies, job duties, and safety protocols.)</li>
                  <li>Implement security measures (Protect the company's assets, information, and employees with security measures.)</li>
                  <li>Follow environmental regulations (Comply with environmental regulations to prevent pollution and minimize the company's impact on the environment.)</li>
                  <li>Document all procedures (Document all company policies and procedures to ensure consistency and compliance.)</li>
                  <li>Ensure proper labeling (Properly label all products to ensure accurate information and compliance with labeling regulations.)</li>
                  <li>Verify quality control (Implement quality control measures to ensure consistent product quality and compliance with industry standards.)</li>
                  <li>Keep accurate records (Keep accurate and up-to-date records to comply with legal and regulatory requirements and aid in decision-making.)</li>
                  <li>Maintain confidentiality (Protect sensitive information and maintain confidentiality to comply with legal and ethical obligations.)</li>
                  <li>Comply with labor laws (Comply with labor laws to ensure fair treatment of employees and prevent legal issues.)</li>
                  <li>Avoid discrimination/harassment (Prevent discrimination and harassment in the workplace to maintain a safe and inclusive work environment.)</li>
                  <li>Establish a code of ethics (Establish a code of ethics to guide company behavior and ensure compliance with legal and ethical standards.)</li>
                  <li>Follow financial regulations (Comply with financial regulations to maintain accurate financial records and prevent legal issues.)</li>
                  <li>Implement data privacy measures (Protect customer data and comply with data privacy regulations to prevent data breaches and legal issues.)</li>
                  <li>Protect intellectual property (Protect company intellectual property through patents, trademarks, and copyrights to prevent infringement and maintain exclusivity.)</li>
                  <li>Comply with import/export laws (Comply with import and export regulations to prevent legal issues and ensure smooth international trade.)</li>
                  <li>Follow advertising guidelines (Follow advertising guidelines to ensure truthful and non-deceptive advertising and comply with advertising regulations.)</li>
                  <li>Implement anti-bribery measures (Implement anti-bribery measures to prevent bribery and comply with anti-bribery regulations.)</li>
                  <li>Comply with tax laws (Comply with tax laws to prevent legal issues and maintain accurate financial records.)</li>
                  <!-- Add more rules and regulations as needed -->
              </ol>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>







@endsection
