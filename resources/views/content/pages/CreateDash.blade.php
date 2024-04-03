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
                <div class="container">
                  <div class="card">
                      <div class="card-body">
                          <h1 class="card-title">Documentation and Compliance</h1>
                          <div class="table-responsive">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Department</th>
                                          <th>Documentation Name</th>
                                          <th>Checklist Item</th>
                                          <th>Status</th>
                                          <th>Notes</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($checklists as $checklist)
                                          <tr>
                                              <td>{{ $checklist->id }}</td>
                                              <td>{{ $checklist->department }}</td>
                                              <td>{{ $checklist->documentation_name }}</td>
                                              <td>{{ $checklist->checklist_item }}</td>
                                              <td>
                                                  @if ($checklist->status === 'approve')
                                                      <span class="badge bg-success">Approved</span>
                                                  @elseif ($checklist->status === 'reject')
                                                      <span class="badge bg-danger">Rejected</span>
                                                  @elseif ($checklist->status === 'comply')
                                                      <span class="badge bg-warning">Complied</span>
                                                  @endif
                                              </td>
                                              <td>{{ $checklist->notes }}</td>
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>





                <div class="container">
                    <div class="card">
                        <div class="card-body">

                            <div class="container mt-4">
                              <!-- Checklist Form -->
                              <form action="{{ route('checklist.store') }}" method="POST">
                                  @csrf


                                  <div class="card">
                                      <div class="card-body">
                                          <h5 class="card-title"><!-- Button to trigger modal -->
                                             <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rulesModal">
                                              View Rules & Regulations
                                            </button></h5>

                                            <div class="mb-3">
                                              <label for="department" class="form-label">Department</label>
                                              <input type="text" class="form-control" id="department" name="department" placeholder="Enter department">
                                          </div>

                                          <div class="table-responsive">
                                              <table class="table">
                                                  <thead>
                                                      <tr>
                                                          <th>Documentation Name</th>
                                                          <th>Checklist</th>
                                                          <th>Status</th>
                                                          <th>Notes</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <!-- Documentation Name, Checklist, Status, and Notes -->
                                                      <tr>
                                                          <td>
                                                              <input type="text" class="form-control" name="documentation_name" placeholder="Enter documentation name">
                                                          </td>
                                                          <td>
                                                              <input type="text" class="form-control" name="checklist_item" placeholder="Enter checklist item">
                                                          </td>
                                                          <td>
                                                            <div class="mb-3">
                                                              <label for="status" class="form-label">Status</label>
                                                              <div class="form-check">
                                                                  <input class="form-check-input" type="radio" name="status" id="status_approve" value="approve" {{ old('status') == 'approve' ? 'checked' : '' }}>
                                                                  <label class="form-check-label" for="status_approve">Approve</label>
                                                              </div>
                                                              <div class="form-check">
                                                                  <input class="form-check-input" type="radio" name="status" id="status_reject" value="reject" {{ old('status') == 'reject' ? 'checked' : '' }}>
                                                                  <label class="form-check-label" for="status_reject">Reject</label>
                                                              </div>
                                                              <div class="form-check">
                                                                  <input class="form-check-input" type="radio" name="status" id="status_comply" value="comply" {{ old('status') == 'comply' ? 'checked' : '' }}>
                                                                  <label class="form-check-label" for="status_comply">Comply</label>
                                                              </div>
                                                              @error('status')
                                                              <div class="text-danger">{{ $message }}</div>
                                                              @enderror
                                                          </div>

                                                        </td>

                                                          <td>
                                                              <input type="text" class="form-control" name="notes" placeholder="Enter notes">
                                                          </td>
                                                      </tr>
                                                      <!-- Add more rows for documentation name, checklist, status, and notes -->
                                                  </tbody>
                                              </table>
                                          </div>
                                      </div>
                                  </div>

                                  <!-- Submit Button -->
                                  <div class="mt-3">
                                      <button type="submit" class="btn btn-primary">Submit</button>
                                  </div>
                                  <!-- End Submit Button -->
                              </form>
                          </div>

                            <!-- End Checklist Form -->
                        </div><!-- End Card Body -->
                    </div><!-- End Card -->
                </div><!-- End Container -->


    </section>

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
    </div>
    </div><!-- End Row -->
    </section><!-- End Section -->

@endsection
