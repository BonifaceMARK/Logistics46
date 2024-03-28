<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChecklistItem;


class HomeController extends Controller
{
  public function index()
{
  $checklistItems = ChecklistItem::all();
    return view('content.pages.homedash', compact('checklistItems'));
}
public function approvedDepartments()
{
    $approvedItems = ChecklistItem::where('status', 'Approved')->get();
    return view('content.pages.homedash', compact('approvedItems'));
}

public function rejectedDepartments()
{
    $rejectedItems = ChecklistItem::where('status', 'Rejected')->get();
    return view('content.pages.homedash', compact('rejectedItems'));
}

public function compliedDepartments()
{
    $compliedItems = ChecklistItem::where('status', 'Complied')->get();
    return view('content.pages.homedash', compact('compliedItems'));
}

}
