<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    // All Listing 
    public function index(){

        return view('listings.index', [
            'headings' => 'latest listings',
            'listings' => Listing::latest()->filter(request(['tag','search']))->get()
        ]);
    }
    //Single Listing
    public function show(Listing $listing){
        if ($listing) {
            return view('listings.show',[
           
           'listing' => $listing
       ]);   
           }else{
               abort('404');
           }
       
    }
    public function create (){
        return view('listings.create');
    }
    public function store (Request $request){

        dd($request->all());

    }
}
