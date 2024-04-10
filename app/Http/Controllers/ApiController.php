<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Checklist;
use App\Models\LmsG50Carrier;

class ApiController extends Controller
{
    function fetchPaymentData() {
        $response = Http::get('https://fms5-iasipgcc.fguardians-fms.com/payment');

        // Check if the request was successful
        if ($response->successful()) {
            // Return the response body (JSON, XML, etc.)
            return $response->body();
        } else {
            // If the request failed, return null or handle the error as needed
            return null;
        }
    }
    public function checklistApi()
    {
        // Fetch all the checklist data
        $checklistData = Checklist::all();

        // Return the data as JSON
        return response()->json($checklistData);
    }

    public function storeCert(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'company_name' => 'required|string',
            'company_address' => 'required|string',
            'contact_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'certificate_of_business_registration_image' => 'nullable|string',
            'certificate_of_dti_image' => 'nullable|string',
            'business_license_image' => 'nullable|string',
            'certificate_of_bir_image' => 'nullable|string',
            'certificate_of_insurance_image' => 'nullable|string',
        ]);

        // Create a new Carrier instance
        $carrier = new LmsG50Carrier();
        $carrier->company_name = $request->company_name;
        $carrier->company_address = $request->company_address;
        $carrier->contact_name = $request->contact_name;
        $carrier->email = $request->email;
        $carrier->phone = $request->phone;
        $carrier->certificate_of_business_registration_image = $request->certificate_of_business_registration_image;
        $carrier->certificate_of_dti_image = $request->certificate_of_dti_image;
        $carrier->business_license_image = $request->business_license_image;
        $carrier->certificate_of_bir_image = $request->certificate_of_bir_image;
        $carrier->certificate_of_insurance_image = $request->certificate_of_insurance_image;

        // Save the Carrier instance to the database
        $carrier->save();

        // Return a success response
        return response()->json(['message' => 'Carrier created successfully'], 201);
    }
}
