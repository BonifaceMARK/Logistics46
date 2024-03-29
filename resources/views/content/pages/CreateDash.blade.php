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
                <section class="col-lg-12">
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="card-title">Documentation</h1>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Transaction Name</th>
                                                <th>Transaction Type</th>
                                                <th>Transaction Amount</th>
                                                <th>Reason For Cancellation</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transactions as $transaction)
                                                <tr>
                                                    <td>{{ $transaction['id'] }}</td>
                                                    <td>{{ $transaction['transactionName'] }}</td>
                                                    <td>{{ $transaction['transactionType'] }}</td>
                                                    <td>{{ $transaction['transactionAmount'] }}</td>
                                                    <td>{{ $transaction['reasonForCancellation'] }}</td>
                                                    <td>{{ $transaction['created_at'] }}</td>
                                                    <td>
                                                        <!-- Button to trigger modal -->
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#transactionModal{{ $transaction['id'] }}">
                                                            Open Transaction Details
                                                        </button>
                                                        <div class="modal fade"
                                                            id="transactionModal{{ $transaction['id'] }}" tabindex="-1"
                                                            aria-labelledby="transactionModalLabel{{ $transaction['id'] }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="transactionModalLabel{{ $transaction['id'] }}">
                                                                            Invoice Receipt
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body" id="transactionModalContent"
                                                                        style="background-color: #fff;">
                                                                        <div class="container-fluid">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <h6>Invoice ID:
                                                                                        {{ $transaction['id'] }}</h6>
                                                                                    <p>Transaction Date:
                                                                                        {{ $transaction['transactionDate'] }}
                                                                                    </p>
                                                                                    <p>Transaction Name:
                                                                                        {{ $transaction['transactionName'] }}
                                                                                    </p>
                                                                                    <p>Transaction Type:
                                                                                        {{ $transaction['transactionType'] }}
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <p>Amount:
                                                                                        {{ $transaction['transactionAmount'] }}
                                                                                    </p>
                                                                                    <p>Reason for Cancellation:
                                                                                        {{ $transaction['reasonForCancellation'] ?? 'N/A' }}
                                                                                    </p>
                                                                                    <p>Transaction Status:
                                                                                        {{ $transaction['transactionStatus'] }}
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-3">
                                                                                <div class="col">
                                                                                    <table class="table table-bordered">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Description</th>
                                                                                                <th>Quantity</th>
                                                                                                <th>Unit Price</th>
                                                                                                <th>Total</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td>{{ $transaction['transactionName'] }}
                                                                                                </td>
                                                                                                <td>1</td>
                                                                                                <td>{{ $transaction['transactionAmount'] }}
                                                                                                </td>
                                                                                                <td>{{ $transaction['transactionAmount'] }}
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="button" class="btn btn-primary"
                                                                            id="printBtn">Print as
                                                                            Image</button>
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
                        </div>
                    </div>
                </section>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
                <script>
                    var downloadCounter = 1; // Initialize counter

                    document.getElementById('printBtn').addEventListener('click', function() {
                        html2canvas(document.getElementById('transactionModalContent'), {
                            onrendered: function(canvas) {
                                var img = canvas.toDataURL('image/jpeg'); // Convert canvas to image as JPEG
                                var link = document.createElement('a');

                                // Generate filename with an incremented ID
                                var filename = 'payment_invoice_' + downloadCounter + '.jpg';

                                link.download = filename; // Set filename
                                link.href = img;
                                link.click();

                                downloadCounter++; // Increment counter
                            }
                        });
                    });
                </script>




                <div class="container">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Company Checklist</h5>

                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <ul class="nav nav-tabs" id="checklistTabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="approved-tab" data-bs-toggle="tab"
                                                    href="#approved" role="tab" aria-controls="approved"
                                                    aria-selected="true">Approved</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="rejected-tab" data-bs-toggle="tab" href="#rejected"
                                                    role="tab" aria-controls="rejected"
                                                    aria-selected="false">Rejected</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="complied-tab" data-bs-toggle="tab" href="#complied"
                                                    role="tab" aria-controls="complied"
                                                    aria-selected="false">Complied</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="checklistTabsContent">
                                            <div class="tab-pane fade show active" id="approved" role="tabpanel"
                                                aria-labelledby="approved-tab">
                                                <div class="card mt-3">
                                                    <div class="card-header">Approved Checklists</div>
                                                    <div class="card-body">
                                                        <ul class="list-group">
                                                            @forelse($approvedChecklists as $checklist)
                                                                <li class="list-group-item">
                                                                    <strong>Department:</strong>
                                                                    {{ $checklist->department }}
                                                                    <br>
                                                                    <strong>Status:</strong>
                                                                    {{ ucfirst($checklist->status) }}
                                                                    <br>
                                                                    <strong>Checked:</strong>
                                                                    <ul>
                                                                        @foreach ($checklist->checklist_items as $item)
                                                                            <li>{{ $item }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            @empty
                                                                <li class="list-group-item">No approved checklist items
                                                                    found.</li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="rejected" role="tabpanel"
                                                aria-labelledby="rejected-tab">
                                                <div class="card mt-3">
                                                    <div class="card-header">Rejected Checklists</div>
                                                    <div class="card-body">
                                                        <ul class="list-group">
                                                            @forelse($rejectedChecklists as $checklist)
                                                                <li class="list-group-item">
                                                                    <strong>Department:</strong>
                                                                    {{ $checklist->department }}
                                                                    <br>
                                                                    <strong>Status:</strong>
                                                                    {{ ucfirst($checklist->status) }}
                                                                    <br>
                                                                    <strong>Checked:</strong>
                                                                    <ul>
                                                                        @foreach ($checklist->checklist_items as $item)
                                                                            <li>{{ $item }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            @empty
                                                                <li class="list-group-item">No rejected checklist items
                                                                    found.</li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="complied" role="tabpanel"
                                                aria-labelledby="complied-tab">
                                                <div class="card mt-3">
                                                    <div class="card-header">Complied Checklists</div>
                                                    <div class="card-body">
                                                        <ul class="list-group">
                                                            @forelse($compliedChecklists as $checklist)
                                                                <li class="list-group-item">
                                                                    <strong>Department:</strong>
                                                                    {{ $checklist->department }}
                                                                    <br>
                                                                    <strong>Status:</strong>
                                                                    {{ ucfirst($checklist->status) }}
                                                                    <br>
                                                                    <strong>Checked:</strong>
                                                                    <ul>
                                                                        @foreach ($checklist->checklist_items as $item)
                                                                            <li>{{ $item }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            @empty
                                                                <li class="list-group-item">No complied checklist items
                                                                    found.</li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Checklist Form -->
                            <form action="{{ route('checklist.store') }}" method="POST">
                                @csrf
                                <!-- Department Select Option -->
                                <div class="mb-3">
                                    <label for="department" class="form-label">Department</label>
                                    <select class="form-select" id="department" name="department">
                                        <!-- Added name attribute for form submission -->
                                        <option selected disabled>Select department</option>
                                        <option value="Logistics41">Logistics41</option>
                                        <option value="Logistics42">Logistics42</option>
                                        <option value="Logistics43">Logistics43</option>
                                        <option value="Logistics44">Logistics44</option>
                                        <option value="Logistics45">Logistics45</option>
                                        <option value="Logistics46">Logistics46</option>
                                        <option value="Logistics47">Logistics47</option>
                                        <option value="Logistics48">Logistics48</option>
                                        <option value="Logistics49">Logistics49</option>
                                        <option value="Logistics50">Logistics50</option>
                                        <!-- Add more departments as needed -->
                                    </select>
                                </div>

                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input type="checkbox" name="checklist_items[]" class="form-check-input"
                                                id="item_1"
                                                value="Obtain necessary licenses/permits (Obtain and maintain all required licenses and permits to operate legally.)">
                                            <label class="form-check-label" for="item_1">
                                                Obtain necessary licenses/permits (Obtain and maintain all required licenses
                                                and permits to operate legally.)
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input type="checkbox" name="checklist_items[]" class="form-check-input"
                                                id="item_2"
                                                value="Comply with safety regulations (Implement safety measures to prevent accidents and comply with all safety regulations.)">
                                            <label class="form-check-label" for="item_2">
                                                Comply with safety regulations (Implement safety measures to prevent
                                                accidents and comply with all safety regulations.)
                                            </label>
                                        </div>
                                    </li>
                                    <!-- Repeat this pattern for each checklist item -->
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input type="checkbox" name="checklist_items[]" class="form-check-input"
                                                id="item_3"
                                                value="Provide proper training (Train employees on company policies, job duties, and safety protocols.)">
                                            <label class="form-check-label" for="item_3">
                                                Provide proper training (Train employees on company policies, job duties,
                                                and safety protocols.)
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input type="checkbox" name="checklist_items[]" class="form-check-input"
                                                id="item_4"
                                                value="Implement security measures (Protect the company's assets, information, and employees with security measures.)">
                                            <label class="form-check-label" for="item_4">
                                                Implement security measures (Protect the company's assets, information, and
                                                employees with security measures.)
                                            </label>
                                        </div>
                                    </li>
                                    <!-- Add the rest of the checklist items in the same format -->
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input type="checkbox" name="checklist_items[]" class="form-check-input"
                                                id="item_5"
                                                value="Follow environmental regulations (Comply with environmental regulations to prevent pollution and minimize the company's impact on the environment.)">
                                            <label class="form-check-label" for="item_5">
                                                Follow environmental regulations (Comply with environmental regulations to
                                                prevent pollution and minimize the company's impact on the environment.)
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input type="checkbox" name="checklist_items[]" class="form-check-input"
                                                id="item_6"
                                                value="Document all procedures (Document all company policies and procedures to ensure consistency and compliance.)">
                                            <label class="form-check-label" for="item_6">
                                                Document all procedures (Document all company policies and procedures to
                                                ensure consistency and compliance.)
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input type="checkbox" name="checklist_items[]" class="form-check-input"
                                                id="item_7"
                                                value="Ensure proper labeling (Properly label all products to ensure accurate information and compliance with labeling regulations.)">
                                            <label class="form-check-label" for="item_7">
                                                Ensure proper labeling (Properly label all products to ensure accurate
                                                information and compliance with labeling regulations.)
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input type="checkbox" name="checklist_items[]" class="form-check-input"
                                                id="item_8"
                                                value="Verify quality control (Implement quality control measures to ensure consistent product quality and compliance with industry standards.)">
                                            <label class="form-check-label" for="item_8">
                                                Verify quality control (Implement quality control measures to ensure
                                                consistent product quality and compliance with industry standards.)
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input type="checkbox" name="checklist_items[]" class="form-check-input"
                                                id="item_9"
                                                value="Keep accurate records (Keep accurate and up-to-date records to comply with legal and regulatory requirements and aid in decision-making.)">
                                            <label class="form-check-label" for="item_9">
                                                Keep accurate records (Keep accurate and up-to-date records to comply with
                                                legal and regulatory requirements and aid in decision-making.)
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input type="checkbox" name="checklist_items[]" class="form-check-input"
                                                id="item_10"
                                                value="Maintain confidentiality (Protect sensitive information and maintain confidentiality to comply with legal and ethical obligations.)">
                                            <label class="form-check-label" for="item_10">
                                                Maintain confidentiality (Protect sensitive information and maintain
                                                confidentiality to comply with legal and ethical obligations.)
                                            </label>
                                        </div>
                                    </li>
                                    <!-- Continue adding the rest of the checklist items -->
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input type="checkbox" name="checklist_items[]" class="form-check-input"
                                                id="item_11"
                                                value="Comply with labor laws (Comply with labor laws to ensure fair treatment of employees and prevent legal issues.)">
                                            <label class="form-check-label" for="item_11">
                                                Comply with labor laws (Comply with labor laws to ensure fair treatment of
                                                employees and prevent legal issues.)
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input type="checkbox" name="checklist_items[]" class="form-check-input"
                                                id="item_12"
                                                value="Avoid discrimination/harassment (Prevent discrimination and harassment in the workplace to maintain a safe and inclusive work environment.)">
                                            <label class="form-check-label" for="item_12">
                                                Avoid discrimination/harassment (Prevent discrimination and harassment in
                                                the workplace to maintain a safe and inclusive work environment.)
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input type="checkbox" name="checklist_items[]" class="form-check-input"
                                                id="item_13"
                                                value="Establish a code of ethics (Establish a code of ethics to guide company behavior and ensure compliance with legal and ethical standards.)">
                                            <label class="form-check-label" for="item_13">
                                                Establish a code of ethics (Establish a code of ethics to guide company
                                                behavior and ensure compliance with legal and ethical standards.)
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input type="checkbox" name="checklist_items[]" class="form-check-input"
                                                id="item_14"
                                                value="Follow financial regulations (Comply with financial regulations to maintain accurate financial records and prevent legal issues.)">
                                            <label class="form-check-label" for="item_14">
                                                Follow financial regulations (Comply with financial regulations to maintain
                                                accurate financial records and prevent legal issues.)
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input type="checkbox" name="checklist_items[]" class="form-check-input"
                                                id="item_15"
                                                value="Implement data privacy measures (Protect customer data and comply with data privacy regulations to prevent data breaches and legal issues.)">
                                            <label class="form-check-label" for="item_15">
                                                Implement data privacy measures (Protect customer data and comply with data
                                                privacy regulations to prevent data breaches and legal issues.)
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input type="checkbox" name="checklist_items[]" class="form-check-input"
                                                id="item_16"
                                                value="Protect intellectual property (Protect company intellectual property through patents, trademarks, and copyrights to prevent infringement and maintain exclusivity.)">
                                            <label class="form-check-label" for="item_16">
                                                Protect intellectual property (Protect company intellectual property through
                                                patents, trademarks, and copyrights to prevent infringement and maintain
                                                exclusivity.)
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input type="checkbox" name="checklist_items[]" class="form-check-input"
                                                id="item_17"
                                                value="Comply with import/export laws (Comply with import and export regulations to prevent legal issues and ensure smooth international trade.)">
                                            <label class="form-check-label" for="item_17">
                                                Comply with import/export laws (Comply with import and export regulations to
                                                prevent legal issues and ensure smooth international trade.)
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input type="checkbox" name="checklist_items[]" class="form-check-input"
                                                id="item_18"
                                                value="Follow advertising guidelines (Follow advertising guidelines to ensure truthful and non-deceptive advertising and comply with advertising regulations.)">
                                            <label class="form-check-label" for="item_18">
                                                Follow advertising guidelines (Follow advertising guidelines to ensure
                                                truthful and non-deceptive advertising and comply with advertising
                                                regulations.)
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input type="checkbox" name="checklist_items[]" class="form-check-input"
                                                id="item_19"
                                                value="Implement anti-bribery measures (Implement anti-bribery measures to prevent bribery and comply with anti-bribery regulations.)">
                                            <label class="form-check-label" for="item_19">
                                                Implement anti-bribery measures (Implement anti-bribery measures to prevent
                                                bribery and comply with anti-bribery regulations.)
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input type="checkbox" name="checklist_items[]" class="form-check-input"
                                                id="item_20"
                                                value="Comply with tax laws (Comply with tax laws to prevent legal issues and maintain accurate financial records.)">
                                            <label class="form-check-label" for="item_20">
                                                Comply with tax laws (Comply with tax laws to prevent legal issues and
                                                maintain accurate financial records.)
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <!-- End Checklist -->
                                <!-- Status -->
                                <div class="mt-3">
                                    <p>Status:</p>
                                    <!-- Radio buttons for status -->
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="approve"
                                            value="approve">
                                        <label class="form-check-label" for="approve">Approve</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="reject"
                                            value="reject">
                                        <label class="form-check-label" for="reject">Reject</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="comply"
                                            value="comply">
                                        <label class="form-check-label" for="comply">Comply</label>
                                    </div>
                                </div>
                                <!-- End Status -->
                                <!-- Submit Button -->
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                <!-- End Submit Button -->
                            </form>
                            <!-- End Checklist Form -->
                        </div><!-- End Card Body -->
                    </div><!-- End Card -->
                </div><!-- End Container -->


    </section>


    </div>
    </div><!-- End Row -->
    </section><!-- End Section -->
@endsection
