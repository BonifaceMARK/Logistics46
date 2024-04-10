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

  <div class="card">
    <div class="card-header bg-primary text-white" style="background-image: url('{{ asset('assets/img/logistics.jpg') }}'); background-size: cover;">


          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rulesModal">
              View Rules & Regulations
          </button>
          <!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approvedCarriersModal">
  View Approved Carriers
</button>
<!-- Button trigger modal for rejected carriers -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectedCarriersModal">
  View Rejected Carriers
</button>
<!-- Button trigger modal for comply carriers -->
<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#complyCarriersModal">
  View Comply Carriers
</button>

<!-- Modal for comply carriers -->
<div class="modal fade" id="complyCarriersModal" tabindex="-1" aria-labelledby="complyCarriersModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="complyCarriersModalLabel">Comply Carriers</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container mt-4">
          <div class="row row-cols-12 row-cols-md-12 g-12">
            <!-- Display comply carriers -->
            @foreach($complyCarriers as $carrier)
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{ $carrier->company_name }}</h5>
                  <p class="card-text">Company Address: {{ $carrier->company_address }}</p>
                  <p class="card-text">Contact Name: {{ $carrier->contact_name }}</p>
                  <p class="card-text">Email: {{ $carrier->email }}</p>
                  <p class="card-text">Phone: {{ $carrier->phone }}</p>
                  <p class="card-text">Notes: {{ $carrier->notes ?? 'N/A' }}</p>
                  <p class="card-text">Status: {{ $carrier->status }}</p>
                  <hr>
                  <p class="card-text">Certificate of Business Registration:</p>
                  @if($carrier->certificate_of_business_registration_image)
                    <img src="{{ $carrier->certificate_of_business_registration_image }}" alt="Certificate of Business Registration" style="max-width: 100%; height: auto;">
                  @else
                    <p>N/A</p>
                  @endif
                  <hr>
                  <p class="card-text">Certificate of DTI:</p>
                  @if($carrier->certificate_of_dti_image)
                    <img src="{{ $carrier->certificate_of_dti_image }}" alt="Certificate of DTI" style="max-width: 100%; height: auto;">
                  @else
                    <p>N/A</p>
                  @endif
                  <hr>
                  <p class="card-text">Business License:</p>
                  @if($carrier->business_license_image)
                    <img src="{{ $carrier->business_license_image }}" alt="Business License" style="max-width: 100%; height: auto;">
                  @else
                    <p>N/A</p>
                  @endif
                  <hr>
                  <p class="card-text">Certificate of BIR:</p>
                  @if($carrier->certificate_of_bir_image)
                    <img src="{{ $carrier->certificate_of_bir_image }}" alt="Certificate of BIR" style="max-width: 100%; height: auto;">
                  @else
                    <p>N/A</p>
                  @endif
                  <hr>
                  <p class="card-text">Certificate of Insurance:</p>
                  @if($carrier->certificate_of_insurance_image)
                    <img src="{{ $carrier->certificate_of_insurance_image }}" alt="Certificate of Insurance" style="max-width: 100%; height: auto;">
                  @else
                    <p>N/A</p>
                  @endif
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for rejected carriers -->
<div class="modal fade" id="rejectedCarriersModal" tabindex="-1" aria-labelledby="rejectedCarriersModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="rejectedCarriersModalLabel">Rejected Carriers</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container mt-4">
          <div class="row row-cols-12 row-cols-md-12 g-12">
            <!-- Display rejected carriers -->
            @foreach($rejectedCarriers as $carrier)
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{ $carrier->company_name }}</h5>
                  <p class="card-text">Company Address: {{ $carrier->company_address }}</p>
                  <p class="card-text">Contact Name: {{ $carrier->contact_name }}</p>
                  <p class="card-text">Email: {{ $carrier->email }}</p>
                  <p class="card-text">Phone: {{ $carrier->phone }}</p>
                  <p class="card-text">Notes: {{ $carrier->notes ?? 'N/A' }}</p>
                  <p class="card-text">Status: {{ $carrier->status }}</p>
                  <hr>
                  <p class="card-text">Certificate of Business Registration:</p>
                  @if($carrier->certificate_of_business_registration_image)
                    <img src="{{ $carrier->certificate_of_business_registration_image }}" alt="Certificate of Business Registration" style="max-width: 100%; height: auto;">
                  @else
                    <p>N/A</p>
                  @endif
                  <hr>
                  <p class="card-text">Certificate of DTI:</p>
                  @if($carrier->certificate_of_dti_image)
                    <img src="{{ $carrier->certificate_of_dti_image }}" alt="Certificate of DTI" style="max-width: 100%; height: auto;">
                  @else
                    <p>N/A</p>
                  @endif
                  <hr>
                  <p class="card-text">Business License:</p>
                  @if($carrier->business_license_image)
                    <img src="{{ $carrier->business_license_image }}" alt="Business License" style="max-width: 100%; height: auto;">
                  @else
                    <p>N/A</p>
                  @endif
                  <hr>
                  <p class="card-text">Certificate of BIR:</p>
                  @if($carrier->certificate_of_bir_image)
                    <img src="{{ $carrier->certificate_of_bir_image }}" alt="Certificate of BIR" style="max-width: 100%; height: auto;">
                  @else
                    <p>N/A</p>
                  @endif
                  <hr>
                  <p class="card-text">Certificate of Insurance:</p>
                  @if($carrier->certificate_of_insurance_image)
                    <img src="{{ $carrier->certificate_of_insurance_image }}" alt="Certificate of Insurance" style="max-width: 100%; height: auto;">
                  @else
                    <p>N/A</p>
                  @endif
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

      </div>
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
                          <th>Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($carriers as $carrier)
                      <tr>
                          <td>{{ $carrier->company_name }}</td>
                          <td>{{ $carrier->company_address }}</td>
                          <td>{{ $carrier->contact_name }}</td>
                          <td>{{ $carrier->email }}</td>
                          <td>{{ $carrier->phone }}</td>
                          <td>
                              @if($carrier->certificate_of_business_registration_image)
                              <img src="{{ $carrier->certificate_of_business_registration_image }}" alt="Certificate of Business Registration" style="max-width: 100px;">
                              @else
                              N/A
                              @endif
                          </td>
                          <td>
                              @if($carrier->certificate_of_dti_image)
                              <img src="{{ $carrier->certificate_of_dti_image }}" alt="Certificate of DTI" style="max-width: 100px;">
                              @else
                              N/A
                              @endif
                          </td>
                          <td>
                              @if($carrier->business_license_image)
                              <img src="{{ $carrier->business_license_image }}" alt="Business License" style="max-width: 100px;">
                              @else
                              N/A
                              @endif
                          </td>
                          <td>
                              @if($carrier->certificate_of_bir_image)
                              <img src="{{ $carrier->certificate_of_bir_image }}" alt="Certificate of BIR" style="max-width: 100px;">
                              @else
                              N/A
                              @endif
                          </td>
                          <td>
                              @if($carrier->certificate_of_insurance_image)
                              <img src="{{ $carrier->certificate_of_insurance_image }}" alt="Certificate of Insurance" style="max-width: 100px;">
                              @else
                              N/A
                              @endif
                          </td>
                          <td>
                              <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#notesAndStatusModal{{ $carrier->id }}">Notes & Status</button>
                              <!-- Modal -->
                              <div class="modal fade" id="notesAndStatusModal{{ $carrier->id }}" tabindex="-1" aria-labelledby="notesAndStatusModalLabel{{ $carrier->id }}" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="notesAndStatusModalLabel{{ $carrier->id }}">Notes & Status</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                              <form action="{{ route('carriers.save-notes-status', ['id' => $carrier->id]) }}" method="POST">
                                                  @csrf
                                                  <div class="form-group">
                                                      <textarea class="form-control mb-3" name="notes" rows="4" placeholder="Enter notes here..."></textarea>
                                                      <div class="btn-group" role="group" aria-label="Status">
                                                          <label class="btn btn-success">
                                                              <input type="radio" name="status" value="approve"> Approve
                                                          </label>
                                                          <label class="btn btn-danger">
                                                              <input type="radio" name="status" value="reject"> Reject
                                                          </label>
                                                          <label class="btn btn-info">
                                                              <input type="radio" name="status" value="comply"> Comply
                                                          </label>
                                                      </div>
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


<!-- Modal -->
<div class="modal fade" id="approvedCarriersModal" tabindex="-1" aria-labelledby="approvedCarriersModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="approvedCarriersModalLabel">Approved Carriers</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container mt-4">
          <div class="row row-cols-12 row-cols-md-12 g-12">
            @foreach($approvedCarriers as $carrier)
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{ $carrier->company_name }}</h5>
                  <p class="card-text">Company Address: {{ $carrier->company_address }}</p>
                  <p class="card-text">Contact Name: {{ $carrier->contact_name }}</p>
                  <p class="card-text">Email: {{ $carrier->email }}</p>
                  <p class="card-text">Phone: {{ $carrier->phone }}</p>
                  <p class="card-text">Notes: {{ $carrier->notes ?? 'N/A' }}</p>
                  <p class="card-text">Status: {{ $carrier->status }}</p>
                  <hr>
                  <p class="card-text">Certificate of Business Registration:</p>
                  @if($carrier->certificate_of_business_registration_image)
                    <img src="{{ $carrier->certificate_of_business_registration_image }}" alt="Certificate of Business Registration" style="max-width: 100%; height: auto;">
                  @else
                    <p>N/A</p>
                  @endif
                  <hr>
                  <p class="card-text">Certificate of DTI:</p>
                  @if($carrier->certificate_of_dti_image)
                    <img src="{{ $carrier->certificate_of_dti_image }}" alt="Certificate of DTI" style="max-width: 100%; height: auto;">
                  @else
                    <p>N/A</p>
                  @endif
                  <hr>
                  <p class="card-text">Business License:</p>
                  @if($carrier->business_license_image)
                    <img src="{{ $carrier->business_license_image }}" alt="Business License" style="max-width: 100%; height: auto;">
                  @else
                    <p>N/A</p>
                  @endif
                  <hr>
                  <p class="card-text">Certificate of BIR:</p>
                  @if($carrier->certificate_of_bir_image)
                    <img src="{{ $carrier->certificate_of_bir_image }}" alt="Certificate of BIR" style="max-width: 100%; height: auto;">
                  @else
                    <p>N/A</p>
                  @endif
                  <hr>
                  <p class="card-text">Certificate of Insurance:</p>
                  @if($carrier->certificate_of_insurance_image)
                    <img src="{{ $carrier->certificate_of_insurance_image }}" alt="Certificate of Insurance" style="max-width: 100%; height: auto;">
                  @else
                    <p>N/A</p>
                  @endif
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  function saveNotesAndStatus(carrierId) {
      var notes = document.getElementById('notes' + carrierId).value;
      var status = document.querySelector('input[name="status"]:checked').value;

      fetch('{{ route("carriers.save-notes-status", ["id" => ":id"]) }}'.replace(':id', carrierId), {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({ notes: notes, status: status })
      })
      .then(response => {
          if (response.ok) {
              alert('Notes and status saved successfully.');
              location.reload();
          } else {
              alert('An error occurred while saving notes and status.');
          }
      })
      .catch(error => {
          console.error('Error:', error);
      });
  }
</script>


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
<Section>





</Section>

@endsection
