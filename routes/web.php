<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\HomeController;
use App\Http\Controllers\pages\CreateController;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\api\CarrierApiController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Mail\approve;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Redirect to login page
Route::redirect(uri: '/', destination: 'login');

// locale
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

Route::middleware([
  'auth:sanctum',
  config('jetstream.auth_session'),
  'verified',
])->group(function () {
  Route::get('/dashboard', function () {
    return view('dashboard');
  })->name('dashboard');

  // Main Page Route

  Route::get('/', [HomeController::class, 'index'])->name('home');
  Route::get('/page-2', [CreateController::class, 'index'])->name('pages-page2');

  Route::get('/show/{id}', [HomeController::class, 'showTransaction'])->name('show.pay');

  Route::get('/process-edi/{id}', [HomeController::class, 'processEDI'])->name('process.edi');
  Route::post('/transactions/process-edifact', [HomeController::class, 'processToEDIFACT'])->name('transactions.processToEDIFACT');
  Route::post('/process-edifact', [HomeController::class, 'vehicleToEDIFACT'])->name('vehicles.processToEDIFACT');

  Route::get('/checkApi', [ApiController::class, 'checklistApi']);

  Route::post('/carriers/{id}/save-notes-status', [CreateController::class, 'saveNotesAndStatus'])->name('carriers.save-notes-status');

  Route::post('/save-invoice', [CreateController::class, 'saveInvoice'])->name('save-invoice');

  Route::post('/update/{id}', [CreateController::class, 'update'])->name('carriers.save-notes-status');

  Route::post('/save-edifact', [CreateController::class, 'saveEdi']);

  Route::post('/process-edifact', [HomeController::class, 'process'])->name('process.edifact');

  Route::get('/fetch-data', [CreateController::class, 'fetch']);
  Route::get('/transactions/{id}',  [CreateController::class, 'showPayment'])->name('transactions.show');
  Route::post('/process-transaction', [CreateController::class, 'processTransactionToEdi'])->name('edi.process');
  Route::post('/checkliststore',  [CreateController::class, 'storeChecklist'])->name('checklist.store');

  Route::get('/vendors', [CreateController::class, 'index']);


  Route::get('/approve', [CreateController::class, 'approve']);

  Route::get('/reject', [CreateController::class, 'reject']);
  Route::get('/send-otp-email', function () { $name = ['name' => 'OTP FOR ACC', 'body' => '123456', ]; Mail::to('matthewcrew1zx@gmail.com')->send(new approve($name)); return 'OTP Email sent successfully.';});


});
