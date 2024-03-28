<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Log;
use PDF;
use Dompdf\Dompdf;
use App\Models\ChecklistItem;
use Illuminate\Support\Facades\Http;
use League\Csv\Writer;
use Intervention\Image\Facades\Image;




class CreateController extends Controller
{

  public function index()
  {
    $checklistItems = ChecklistItem::all();
      // Make a GET request to fetch all transactions
      $response = Http::get('https://fms5-iasipgcc.fguardians-fms.com/payment');

      // Check if the request was successful
      if ($response->successful()) {
          // Extract the JSON data from the response
          $transactions = $response->json();
  // Get approved checklist items
  $approvedChecklistItems = ChecklistItem::where('status', 'Approved')->get();

  // Get rejected checklist items
  $rejectedChecklistItems = ChecklistItem::where('status', 'Rejected')->get();

  // Get complied checklist items
  $compliedChecklistItems = ChecklistItem::where('status', 'Complied')->get();
          // Return the view with the transactions data
          return view('content.pages.createdash', compact('transactions','checklistItems','approvedChecklistItems', 'rejectedChecklistItems', 'compliedChecklistItems'));
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
    try {
        // Validate the incoming request
        $request->validate([
            'department' => 'required|string', // Add validation for department
            'checklist_items' => 'required|array',
            'status' => 'required|in:approve,reject,comply',
        ]);

        $department = $request->input('department');
        $checklistItems = $request->input('checklist_items');
        $status = $request->input('status');
        
        // Log the values for debugging
        Log::info('Department: ' . $department);
        Log::info('Checklist Items: ' . print_r($checklistItems, true));
        Log::info('Status: ' . $status);

        // Perform actions based on the status
        switch ($status) {
            case 'approve':
                // Update the status of selected items to 'Approved'
                ChecklistItem::whereIn('id', $checklistItems)->update(['status' => 'Approved', 'department' => $department]);
                break;
            case 'reject':
                // Update the status of selected items to 'Rejected'
                ChecklistItem::whereIn('id', $checklistItems)->update(['status' => 'Rejected', 'department' => $department]);
                break;
            case 'comply':
                // Update the status of selected items to 'Complied'
                ChecklistItem::whereIn('id', $checklistItems)->update(['status' => 'Complied', 'department' => $department]);
                break;
            default:
                // Handle invalid status
                return redirect()->back()->with('error', 'Invalid status.');
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Checklist submitted successfully.');
    } catch (\Exception $e) {
        // Log the error for debugging
        Log::error('Error in storeChecklist: ' . $e->getMessage());

        // Redirect back with an error message
        return redirect()->back()->with('error', 'An error occurred. Please try again later.');
    }
}


}
