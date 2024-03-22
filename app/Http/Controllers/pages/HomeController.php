<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ComplianceDocument;
use App\Models\ComplianceRegulation;
use App\Models\ComplianceDepartment;

class HomeController extends Controller
{
  public function index()
{
  $regulations = ComplianceRegulation::all();
    $departments = ComplianceDepartment::all();
    $documents = ComplianceDocument::all();
    return view('content.pages.homedash', compact('departments','documents','regulations'));
}

}
