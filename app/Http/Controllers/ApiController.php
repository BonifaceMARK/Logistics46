<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Checklist;
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
}
