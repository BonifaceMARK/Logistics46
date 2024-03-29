<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Log;
use PDF;
use Dompdf\Dompdf;
use App\Models\Checklist;
use Illuminate\Support\Facades\Http;
use League\Csv\Writer;
use Intervention\Image\Facades\Image;




class CreateController extends Controller
{

  public function index()
  {

      // Make a GET request to fetch all transactions
      $response = Http::get('https://fms5-iasipgcc.fguardians-fms.com/payment');

      // Check if the request was successful
      if ($response->successful()) {
          // Extract the JSON data from the response
          $transactions = $response->json();
          $approvedChecklists = Checklist::where('status', 'approve')->get();
          $rejectedChecklists = Checklist::where('status', 'reject')->get();
          $compliedChecklists = Checklist::where('status', 'comply')->get();

          // Return the view with the transactions data
          return view('content.pages.createdash', compact('transactions','approvedChecklists','rejectedChecklists','compliedChecklists'));
      } else {
          // Handle the case where the request was not successful
          return response()->json(['error' => 'Failed to fetch transactions from the external API'], $response->status());
      }
  }
  public function fetch()
  {
      // Make a GET request to fetch all transactions
      $response = Http::get('https://fms5-iasipgcc.fguardians-fms.com/payment');

      // Check if the request was successful
      if ($response->successful()) {
          // Extract the JSON data from the response
          $transactions = $response->json();

          // Return the view with the transactions data
          return view('content.pages.createdash', compact('transactions'));
      } else {
          // Handle the case where the request was not successful
          return response()->json(['error' => 'Failed to fetch transactions from the external API'], $response->status());
      }
  }
  public function showPayment($id)
  {
      // Make a GET request to fetch the transaction details by ID
      $response = Http::get('https://fms5-iasipgcc.fguardians-fms.com/payment/' . $id);

      // Check if the request was successful
      if ($response->successful()) {
          // Extract the JSON data from the response
          $transaction = $response->json();

          // Return the view with the transaction data
          return view('content.pages.createdash', compact('transaction'));
      } else {
          // Handle the case where the request was not successful
          return response()->json(['error' => 'Failed to fetch transaction details from the external API'], $response->status());
      }
  }

  public function storeChecklist(Request $request)
  {
      // Validate the request data
      $validatedData = $request->validate([
          'department' => 'required',
          'checklist_items' => 'required|array',
          'status' => 'required|in:approve,reject,comply',
      ]);

      // Create a new checklist item
      $checklist = Checklist::create([
          'department' => $validatedData['department'],
          'checklist_items' => $validatedData['checklist_items'],
          'status' => $validatedData['status'],
      ]);
      return view('content.pages.createdash', ['checklist' => $checklist]);
      // Optionally, you can return a response indicating success
      //return response()->json(['message' => 'Checklist item created successfully', 'data' => $checklist], 201);
  }

}
