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
    $checklists = Checklist::all();
    return view('content.pages.createdash', compact('checklists'));
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
