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
    $messages = Message::latest()->get();
     return view('content.pages.createdash', compact('messages'));
  }
  public function Message(Request $request)
  {
      $request->validate([
          'content' => 'required|string|max:255',

      ]);

      Message::create([
          'user_id' => auth()->id(), // Assuming the user is authenticated
          'content' => $request->input('content'),
      ]);

      return redirect()->route('pages-page2');
  }
  public function fetchMessage()
  {
      try {
          // Fetch transactions from the external API
          $messages = Message::all();

          // Return the transactions as JSON response
          return response()->json($messages);
      } catch (\Exception $e) {
          // Log the error
          Log::error('Error fetching fetching from external API: ' . $e->getMessage());

          // Return    an error response
          return response()->json(['error' => 'Failed to fetch message'], 500);
      }
  }

}
