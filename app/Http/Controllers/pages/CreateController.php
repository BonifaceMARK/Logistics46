<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ComplianceDocument;
use App\Models\ComplianceRegulation;
use App\Models\ComplianceDepartment;


class CreateController extends Controller
{

  public function index()
  {
    $regulations = ComplianceRegulation::all();
      return view('content.pages.createdash', compact('regulations'));
  }
  public function storeRegulation(Request $request)
{
    // Validate the request
    $request->validate([
        'regulation_id' => 'required|integer',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'jurisdiction' => 'required|string|max:100',
        'category' => 'required|string|max:100',
    ]);

    // Create a new ComplianceRegulation instance
    ComplianceRegulation::create($request->all());

    // Redirect back with success message
    return redirect()->route('pages-page2')->with('success', 'Regulation created successfully.');
}

public function storeDepartment(Request $request)
{
    // Validate the request
    $request->validate([
        'department_id' => 'required|integer|unique:lms_g46_Compliancedepartments',
        'name' => 'required|string',
        'contact_person' => 'required|string',
        'contact_email' => 'required|email',
        'contact_phone' => 'required|string',
    ]);

    // Create a new ComplianceDepartment instance
    $department = new ComplianceDepartment();
    $department->department_id = $request->department_id;
    $department->name = $request->name;
    $department->contact_person = $request->contact_person;
    $department->contact_email = $request->contact_email;
    $department->contact_phone = $request->contact_phone;
    $department->save();

    // Redirect back with success message
    return redirect()->route('pages-page2')->with('success', 'Department created successfully.');
}

public function storeDocument(Request $request)
{
    // Validate the request data
    $request->validate([
      'document_id' => 'required|integer|unique:lms_g46_compliancedocuments',
      'title' => 'required|string|max:255',
      'document_type' => 'required|string|max:100',
      'file_path' => 'required|string|max:255',
      'upload_date' => 'required|date',
      'expiration_date' => 'nullable|date',
      'related_regulation_id' => 'required'
  ]);



    // Create a new ComplianceDocument instance
    ComplianceDocument::create($request->all());

    // Redirect back with success message
    return redirect()->route('pages-page2')->with('success', 'Document created successfully.');
}

public function showRegulation($id)
{
    $regulation = ComplianceRegulation::findOrFail($id);
    return view('regulations.show', compact('regulation'));
}



public function showDepartment($id)
{
    // Retrieve the department by ID
    $department = ComplianceDepartment::findOrFail($id);

    // Pass the department to the view
    return view('departments.show', compact('department'));
}
public function showDocument($id)
{
    // Find the document by ID
    $document = ComplianceDocument::findOrFail($id);

    // Pass the document to the view
    return view('documents.show', compact('document'));
}


}
