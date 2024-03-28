<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\HomeController;
use App\Http\Controllers\pages\CreateController;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\authentications\RegisterBasic;


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

  Route::get('/fetch-data', [CreateController::class, 'fetch']);
  Route::get('/transactions/{id}',  [CreateController::class, 'showPayment'])->name('transactions.show');

  Route::post('/checkliststore',  [CreateController::class, 'storeChecklist'])->name('checklist.store');
});
