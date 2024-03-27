<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Log;



class CreateController extends Controller
{

  public function index()
  {

     return view('content.pages.createdash');
  }


}
