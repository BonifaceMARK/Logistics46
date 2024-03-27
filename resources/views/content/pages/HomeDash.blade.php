@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('content')

    <section>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title"><Strong>What is <i class="fa-solid fa-question"></i></Strong></h1>

                    <!-- Vertical Pills Tabs -->
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-home" type="button" role="tab"
                                    aria-controls="v-pills-home" aria-selected="true">Compliance Regulatory</button>
                                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-profile" type="button" role="tab"
                                    aria-controls="v-pills-profile" aria-selected="false">Company Standards</button>
                                <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-messages" type="button" role="tab"
                                    aria-controls="v-pills-messages" aria-selected="false">Electronic Data
                                    Intercharge</button>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                    aria-labelledby="v-pills-home-tab">
                                    <!-- Card with an image on left -->
                                    <div class="card mb-3">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img src="{{ asset('assets/img/compliance.jpg') }}"
                                                    class="img-fluid rounded-start" alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title"><strong>What is Complaince Regulatory?</strong>
                                                    </h5>
                                                    <p class="card-text">Compliance with regulations refers to the act
                                                        of ensuring that an organization or individual is following all
                                                        applicable
                                                        laws, rules, and regulations that govern their industry or activity.
                                                        This can include laws and regulations related to environmental
                                                        protection,
                                                        labor practices, financial reporting, data privacy, and many other
                                                        areas.
                                                        Compliance with regulations is important because failure to comply
                                                        can
                                                        result in legal penalties, fines, reputational damage, and other
                                                        negative
                                                        consequences.</p>
                                                    <p>Compliance can be achieved through a variety of methods, such as
                                                        self-audits, internal controls, training and education programs, and
                                                        third-party audits. Ultimately, compliance with regulations is a
                                                        critical
                                                        aspect of operating a responsible and sustainable business or
                                                        engaging
                                                        in any activity that is subject to regulatory oversight.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End Card with an image on left -->
                                </div>
                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                    aria-labelledby="v-pills-profile-tab">
                                    <!-- Card with an image on left -->
                                    <div class="card mb-3">
                                        <div class="row g-0">
                                            <div class="col-md-6">
                                                <img src="{{ asset('assets/img/standards.jpg') }}"
                                                    class="img-fluid rounded-start" alt="...">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card-body">
                                                    <div class="general">
                                                        <div class="logistics">
                                                            <h5 class="card-title"><strong>What is Company
                                                                    Standards ?</strong></h5>
                                                            <ul>
                                                                <li>
                                                                    <strong>Safety Regulations:</strong> Comply with
                                                                    regulations
                                                                    for safe transportation of goods, including packaging,
                                                                    labeling,
                                                                    and handling hazardous materials (e.g., IMDG Code, ADR).
                                                                </li>
                                                                <li>
                                                                    <strong>Customs Regulations:</strong> Adhere to customs
                                                                    procedures and trade regulations for import and export
                                                                    activities.
                                                                </li>
                                                                <li>
                                                                    <strong>Environmental Regulations:</strong> Follow
                                                                    guidelines
                                                                    for sustainable practices and waste management during
                                                                    transportation activities.
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <div class="general">
                                                        <ul>
                                                            <li>
                                                                <strong>Code of Conduct:</strong> Establish a company-wide
                                                                code
                                                                of conduct outlining ethical behavior, anti-corruption
                                                                practices,
                                                                and conflict of interest policies.
                                                            </li>
                                                            <li>
                                                                <strong>Data Privacy:</strong> Implement and adhere to data
                                                                privacy regulations, such as GDPR (EU) or CCPA (CA),
                                                                regarding
                                                                data collection, storage, and usage.
                                                            </li>
                                                            <li>
                                                                <strong>Financial Reporting Standards:</strong> Follow
                                                                relevant
                                                                accounting standards (e.g., IFRS, US GAAP) for accurate
                                                                financial reporting and record-keeping.
                                                            </li>
                                                            <li>
                                                                <strong>Internal Controls:</strong> Maintain robust internal
                                                                controls to ensure the integrity of financial transactions,
                                                                prevent fraud, and promote operational efficiency.
                                                            </li>
                                                            <li>
                                                                <strong>Incident Reporting:</strong> Establish clear
                                                                procedures
                                                                for reporting incidents like accidents, security breaches,
                                                                and
                                                                ethical violations.
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End Card with an image on left -->
                                </div>
                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                    aria-labelledby="v-pills-messages-tab">
                                    <div class="card">
                                        <img src="{{ asset('assets/img/ediprocess.png') }}" class="card-img-top"
                                            alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><strong> What is Electronic Data Interchange ?</strong>
                                            </h5>
                                            <p class="card-text">Electronic Data Interchange (EDI) is a method of exchanging
                                                business documents between organizations in a standardized electronic
                                                format.
                                                These documents can include purchase orders, invoices, shipping notices, and
                                                more. Instead of relying on paper-based documents that are prone to errors,
                                                delays, and manual processing, EDI enables the seamless exchange of
                                                structured data directly between computer systems.</p>
                                        </div>
                                    </div><!-- End Card -->
                                </div>
                            </div><!-- End Tab Content -->
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Standards for Compliance</h5>

                                <!-- Bordered Tabs Justified -->
                                <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                                    <li class="nav-item flex-fill" role="presentation">
                                        <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#bordered-justified-home" type="button" role="tab"
                                            aria-controls="home" aria-selected="true">Ansi x12</button>
                                    </li>
                                    <li class="nav-item flex-fill" role="presentation">
                                        <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#bordered-justified-profile" type="button" role="tab"
                                            aria-controls="profile" aria-selected="false">Checklist</button>
                                    </li>
                                    <li class="nav-item flex-fill" role="presentation">
                                        <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab"
                                            data-bs-target="#bordered-justified-contact" type="button" role="tab"
                                            aria-controls="contact" aria-selected="false">Contact</button>
                                    </li>
                                </ul>
                                <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                                    <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class="card">
                                            <div class="card-body pdf-viewer">
                                                <h4 class="card-title"><strong>American National Standards Institute (ANSI)
                                                        Accredited
                                                        Standards
                                                        Committee (ASC) X12.</strong></h4>
                                                <iframe src="{{ asset('assets/img/ansi.pdf') }}" width="100%"
                                                    height="600px" frameborder="0"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="bordered-justified-profile" role="tabpanel"
                                        aria-labelledby="profile-tab">
                                        <section>
                                            <div class="container">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Company Checklist</h5>

                                                        <!-- Checklist -->
                                                        <ul class="list-group">
                                                            <li class="list-group-item">
                                                                <strong>1. </strong> Obtain necessary licenses/permits
                                                                (Obtain and maintain all required licenses and permits to
                                                                operate legally.)
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>2. </strong> Comply with safety regulations
                                                                (Implement safety measures to prevent accidents and comply
                                                                with all safety regulations.)
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>3. </strong> Provide proper training (Train
                                                                employees on company policies, job duties, and safety
                                                                protocols.)
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>4. </strong> Implement security measures (Protect
                                                                the company's assets, information, and employees with
                                                                security measures.)
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>5. </strong> Follow environmental regulations
                                                                (Comply with environmental regulations to prevent pollution
                                                                and minimize the company's impact on the environment.)
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>6. </strong> Document all procedures (Document all
                                                                company policies and procedures to ensure consistency and
                                                                compliance.)
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>7. </strong> Ensure proper labeling (Properly label
                                                                all products to ensure accurate information and compliance
                                                                with labeling regulations.)
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>8. </strong> Verify quality control (Implement
                                                                quality control measures to ensure consistent product
                                                                quality and compliance with industry standards.)
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>9. </strong> Keep accurate records (Keep accurate
                                                                and up-to-date records to comply with legal and regulatory
                                                                requirements and aid in decision-making.)
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>10. </strong> Maintain confidentiality (Protect
                                                                sensitive information and maintain confidentiality to comply
                                                                with legal and ethical obligations.)
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>11. </strong> Comply with labor laws (Comply with
                                                                labor laws to ensure fair treatment of employees and prevent
                                                                legal issues.)
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>12. </strong> Avoid discrimination/harassment
                                                                (Prevent discrimination and harassment in the workplace to
                                                                maintain a safe and inclusive work environment.)
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>13. </strong> Establish a code of ethics (Establish
                                                                a code of ethics to guide company behavior and ensure
                                                                compliance with legal and ethical standards.)
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>14. </strong> Follow financial regulations (Comply
                                                                with financial regulations to maintain accurate financial
                                                                records and prevent legal issues.)
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>15. </strong> Implement data privacy measures
                                                                (Protect customer data and comply with data privacy
                                                                regulations to prevent data breaches and legal issues.)
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>16. </strong> Protect intellectual property (Protect
                                                                company intellectual property through patents, trademarks,
                                                                and copyrights to prevent infringement and maintain
                                                                exclusivity.)
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>17. </strong> Comply with import/export laws (Comply
                                                                with import and export regulations to prevent legal issues
                                                                and ensure smooth international trade.)
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>18. </strong> Follow advertising guidelines (Follow
                                                                advertising guidelines to ensure truthful and non-deceptive
                                                                advertising and comply with advertising regulations.)
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>19. </strong> Implement anti-bribery measures
                                                                (Implement anti-bribery measures to prevent bribery and
                                                                comply with anti-bribery regulations.)
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>20. </strong> Comply with tax laws (Comply with tax
                                                                laws to prevent legal issues and maintain accurate financial
                                                                records.)
                                                            </li>
                                                        </ul>
                                                        <!-- End Checklist -->
                                                    </div><!-- End Card Body -->
                                                </div><!-- End Card -->
                                            </div><!-- End Container -->
                                        </section>


                                    </div>
                                    <div class="tab-pane fade" id="bordered-justified-contact" role="tabpanel"
                                        aria-labelledby="contact-tab">
                                        Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis cumque.
                                        Accusantium quibusdam perspiciatis qui qui omnis magnam. Officiis accusamus impedit
                                        molestias nostrum veniam. Qui amet ipsum iure. Dignissimos fuga tempore dolor.
                                    </div>
                                </div><!-- End Bordered Tabs Justified -->

                            </div>
                        </div>

                    </div><!-- End Row -->
                </div><!-- End Card Body -->
            </div><!-- End Card -->
        </div><!-- End Container -->
    </section>

@endsection
