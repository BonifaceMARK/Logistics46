<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChecklistItem;


class HomeController extends Controller
{
  public function index()
{

    return view('content.pages.homedash');
}

}
