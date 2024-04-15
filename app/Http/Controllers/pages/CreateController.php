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
use App\Mail\approve;
use App\Mail\rejected;
use Illuminate\Support\Facades\Mail;

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
          $response = Http::get('https://supplier-g49.bbox-express.com/api/vendors-unverified');
          $vendors = $response->json();

          return view('content.pages.CreateDash', compact('vendors','edifacts', 'carriers', 'edifactContent', 'transactions', 'complyCarriers', 'rejectedCarriers', 'approvedCarriers'));
      }
  }

  
public function approve(Request $request)
{
  dd($request->email);
  $response = Http::get('https://supplier-g49.bbox-express.com/api/Verified-vendors?id='. $request->id .'&status='. $request->status .'');
  // Mail::to();

  $message = json_decode($response);
  if($message->message != 'Error!'){
    return redirect()->back()->with('success', 'Vendor Succesfully Verified !');
  } else {
    return redirect()->back()->with('error', 'Something Went Wrong!');
  }

}
public function saveInvoice(Request $request)
{
    // Validate the request
    $request->validate([
        'content' => 'required|string',
    ]);

   
    $edifact = new Edifact();
    $edifact->content = $request->input('content');
    $edifact->save();

    return response()->json(['message' => 'Invoice saved successfully'], 200);
}


public function saveEdi(Request $request)
{

    $request->validate([
        'content' => 'required|string',
    ]);

    try {
 
        Edifact::create([
            'content' => $request->input('content'),
        ]);

        return response()->json(['message' => 'EDIFACT content saved successfully'], 200);
    } catch (\Exception $e) {
      
        return response()->json(['error' => 'Failed to save EDIFACT content'], 500);
    }
}

  public function updateStatus(Request $request)
  {
   
      $request->validate([
          'carrier_id' => 'required|integer',
          'status' => 'required|in:approve,reject,comply',
      ]);

    
      $carrier = LmsG50Carrier::findOrFail($request->carrier_id);

   
      $carrier->status = $request->status;
      $carrier->save();

  
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
 
          $validatedData = $request->validate([
            'department' => 'required|string|max:255',
            'documentation_name' => 'required|string|max:255',
            'checklist_item' => 'required|string|max:255',
            'status' => 'required|in:approve,reject,comply',
            'notes' => 'nullable|string|max:255',
        ]);

        $checklist = new Checklist([
            'department' => $validatedData['department'],
            'documentation_name' => $validatedData['documentation_name'],
            'checklist_item' => $validatedData['checklist_item'],
            'status' => $validatedData['status'],
            'notes' => $validatedData['notes'],
        ]);

        $checklist->save();



      return view('content.pages.CreateDash', compact('checklist'));
  }

}
