<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

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
// All Listings
Route::get('/', [ListingController::class,'index']);


//Create a new gig
Route::get('/listings/create',[ListingController::class,'create']);
//store the new gig
Route::post('/listings',[ListingController::class,'store']);

//edit page Form
Route::get('/listings/{listings}/edit',[ListingController::class,'edit']);

//update Listing
Route::put('/listings/{listings}',[ListingController::class,'update']); 
//Delete Listing
Route::delete('/listings/{listings}',[ListingController::class,'destroy']); 
// Single Listing
Route::get('/listing/{listing}',[ListingController::class,'show']);
//show Register Form 
Route::get('register',[UserController::class,'create']);
//Create new User 
Route::post('/users',[UserController::class,'store']);