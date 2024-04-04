<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\ChecklistItem;


class HomeController extends Controller
{

  public function index()
  {
      // Fetch data from the external API
      $response = Http::get('https://fleet-g43.bbox-express.com/api/vehicle');

      // Check if the request was successful
      if ($response->successful()) {
          // Extract the data from the response
          $drivers = $response->json()['driver'];

          // Extract vehicle brands and load capacities for the chart
          $vehicleBrands = [];
          $loadCapacities = [];
          foreach ($drivers as $driver) {
              $vehicleBrands[] = $driver['vehicle_brand'];
              $loadCapacities[] = (float) $driver['load_capacity'];
          }

          // Pass the data to the blade view
          return view('content.pages.homedash', compact('drivers', 'vehicleBrands', 'loadCapacities'));
      } else {
          // Handle the error if the request was not successful
          $errorMessage = $response->status() . ' - ' . $response->body();
          return view('errors.custom', compact('errorMessage'));
      }
  }

}
