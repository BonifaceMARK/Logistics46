<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
class ApiController extends Controller
{
  public function updateMessage()
  {
      try {
          // Send a GET request to the external API to fetch messages
          $response = Http::get('http://192.168.3.198:8000/communication');

          // Check if the request was successful
          if ($response->successful()) {
              // Extract messages from the response
              $messages = $response->json();

              // Return the messages as JSON response
              return response()->json($messages);
          } else {
              // If the request was not successful, log the error
              Log::error('Error fetching messages from external API: ' . $response->status());

              // Return an error response
              return response()->json(['error' => 'Failed to fetch messages from external API'], $response->status());
          }
      } catch (\Exception $e) {
          // If an exception occurs, log the error
          Log::error('Exception occurred while fetching messages from external API: ' . $e->getMessage());

          // Return an error response
          return response()->json(['error' => 'Failed to fetch messages from external API'], 500);
      }
  }
}
