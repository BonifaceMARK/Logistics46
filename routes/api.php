<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Http;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

function fetchPaymentData() {
  $response = Http::get('https://fms5-iasipgcc.fguardians-fms.com/payment');

  // Check if the request was successful
  if ($response->successful()) {
      // Decode the JSON response body into an array
      return $response->json();
  } else {
      // If the request failed, return null or handle the error as needed
      return null;
  }
}

Route::get('/fetch-payment-data', function () {
  // Call the fetchPaymentData function
  $paymentData = fetchPaymentData();

  if ($paymentData !== null) {
      // If payment data is received, return it as a response
      return response()->json(['data' => $paymentData]);
  } else {
      // If payment data retrieval failed, return an error response
      return response()->json(['error' => 'Failed to fetch payment data.'], 500);
  }
});
