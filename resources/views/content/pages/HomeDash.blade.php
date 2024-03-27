@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('content')


    <div class="container">
        <div class="card">

            <!-- Card with an image on top -->
            <div class="card">
                <img src="{{ asset('assets/img/ediprocess.png') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><strong>Electronic Data Intercharge</strong></h5>
                    <p class="card-text">Electronic Data Interchange (EDI) is a method of exchanging business documents
                        between organizations in a standardized electronic format. These documents can include purchase
                        orders, invoices, shipping notices, and more. Instead of relying on paper-based documents that are
                        prone to errors, delays, and manual processing, EDI enables the seamless exchange of structured data
                        directly between computer systems.</p>
                </div>


            </div><!-- End Card with an image on top -->

            <div class="card">
                <div class="card-body pdf-viewer">
                    <h4 class="card-title"><strong>American National Standards Institute (ANSI) Accredited Standards
                            Committee (ASC) X12.</strong></h4>
                    <iframe src="{{ asset('assets/img/ansi.pdf') }}" width="100%" height="600px" frameborder="0"></iframe>
                </div>
            </div>


        </div>
    </div>
@endsection
