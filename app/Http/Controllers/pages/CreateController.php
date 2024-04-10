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
use App\Models\EDITranslator;
use EDI\Mapper\Mapping;
use EDI\Mapper\MappingFactory;
use App\Models\LmsG50Carrier;
use App\Models\Edifact;
use Illuminate\Support\Facades\Redirect;

class CreateController extends Controller
{

  public function index()
  {
      $rejectedCarriers = LmsG50Carrier::where('status', 'reject')->get();
      $approvedCarriers = LmsG50Carrier::where('status', 'approve')->get();
      $complyCarriers = LmsG50Carrier::where('status', 'comply')->get();
      $response = Http::get('https://fms5-iasipgcc.fguardians-fms.com/payment');
      $edifacts = Edifact::pluck('content')->toArray();
      $edifactContent = Edifact::all();

      if ($response->successful()) {
          $transactions = $response->json();
          $carrierResponse = Http::get('https://carrier-g50.bbox-express.com/api/carrier');

          $carriers = $carrierResponse->json();

          return view('content.pages.CreateDash', compact('edifacts', 'carriers', 'edifactContent', 'transactions', 'complyCarriers', 'rejectedCarriers', 'approvedCarriers'));
      }
  }

public function saveInvoice(Request $request)
{
    // Validate the request
    $request->validate([
        'content' => 'required|string',
    ]);

    // Create a new Edifact instance
    $edifact = new Edifact();
    $edifact->content = $request->input('content');
    $edifact->save();

    // Return a response indicating success
    return response()->json(['message' => 'Invoice saved successfully'], 200);
}


public function saveEdi(Request $request)
{
    // Validate the request data
    $request->validate([
        'content' => 'required|string',
    ]);

    try {
        // Save the EDIFACT content to the database
        Edifact::create([
            'content' => $request->input('content'),
        ]);

        // Return a success response
        return response()->json(['message' => 'EDIFACT content saved successfully'], 200);
    } catch (\Exception $e) {
        // Return an error response if something went wrong
        return response()->json(['error' => 'Failed to save EDIFACT content'], 500);
    }
}

  public function updateStatus(Request $request)
  {
      // Validate the request data
      $request->validate([
          'carrier_id' => 'required|integer',
          'status' => 'required|in:approve,reject,comply',
      ]);

      // Find the carrier by ID
      $carrier = LmsG50Carrier::findOrFail($request->carrier_id);

      // Update the status
      $carrier->status = $request->status;
      $carrier->save();

      // Return a response
      return response()->json(['success' => true]);
  }
 public function update(Request $request, $id)
 {
     $notes = $request->input('notes');
     $status = $request->input('status');
 
     $response = Http::put("https://carrier-g50.bbox-express.com/api/carrier/{$id}", [
         'notes' => $notes,
         'status' => $status,
     ]);
 
     if ($response->successful()) {
         return redirect()->back()->with('message', 'Carrier status updated successfully');
     } else {
         return redirect()->back()->with('error', 'Failed to update carrier status');
     }
 }
 
  public function storeChecklist(Request $request)
  {
          // Validate the request data
          $validatedData = $request->validate([
            'department' => 'required|string|max:255',
            'documentation_name' => 'required|string|max:255',
            'checklist_item' => 'required|string|max:255',
            'status' => 'required|in:approve,reject,comply',
            'notes' => 'nullable|string|max:255',
        ]);

        // Create a new checklist instance
        $checklist = new Checklist([
            'department' => $validatedData['department'],
            'documentation_name' => $validatedData['documentation_name'],
            'checklist_item' => $validatedData['checklist_item'],
            'status' => $validatedData['status'],
            'notes' => $validatedData['notes'],
        ]);

        // Save the checklist to the database
        $checklist->save();


      // Return the view with the created checklist item and other data
      return view('content.pages.createdash', compact('checklist'));
  }

}
