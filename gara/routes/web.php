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
Route::get('/listings/create',[ListingController::class,'create'])->middleware('auth');
//store the new gig
Route::post('/listings',[ListingController::class,'store']);

//edit page Form
Route::get('/listings/{listings}/edit',[ListingController::class,'edit'])->middleware('auth');

//update Listing
Route::put('/listings/{listings}',[ListingController::class,'update'])->middleware('auth'); 
//Delete Listing
Route::delete('/listings/{listings}',[ListingController::class,'destroy'])->middleware('auth'); 
// Single Listing
Route::get('/listing/{listing}',[ListingController::class,'show']);

//Listing Manage 
Route::get('/listings/manage',[ListingController::class,'manage'])->middleware('auth');


//show Register Form 
Route::get('register',[UserController::class,'create'])->middleware('guest');
//Create new User 
Route::post('/users',[UserController::class,'store']);
//user Logout
Route::post('/logout',[UserController::class,'logout'])->middleware('auth');
//Show Login page
Route::get('login',[UserController::class,'login'])->name('login')->middleware('guest');;
//user Sign In
Route::post('/users/auth',[UserController::class,'auth']);