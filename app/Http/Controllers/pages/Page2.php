<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ComplianceDepartment;


class Page2 extends Controller
{
  public function index()
{
    $departments = ComplianceDepartment::all();
    return view('content.pages.pages-page2', compact('departments'));
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
    return redirect()->route('pages-page-2')->with('success', 'Department created successfully.');
}




public function showDepartment($id)
{
    // Retrieve the department by ID
    $department = ComplianceDepartment::findOrFail($id);

    // Pass the department to the view
    return view('departments.show', compact('department'));
}

}
