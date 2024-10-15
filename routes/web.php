<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanRequestController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckIP;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 Route::get("/",[LoanRequestController::class,"index"]);
 Route::get("/loanrequest",[LoanRequestController::class,"loanrequest"]);
 Route::post("/submitLoanRequest",[LoanRequestController::class,"submitLoanRequest"]); 
 Route::get("/accessDenied",[LoanRequestController::class,"accessDenied"])->name("error.accessDenied");

Route::middleware([CheckIP::class])->group(function(){
    Route::get("/admin/viewRequest",[AdminController::class,"index"]);
    Route::post("/admin/updateStatus",[AdminController::class,"updateStatus"]);
    Route::post("/admin/deleterequest",[AdminController::class,"deleterequest"]);
   
});
 