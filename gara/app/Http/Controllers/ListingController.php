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
            'listings' => Listing::latest()->filter(request(['tag','search']))->Paginate(6)
            // 'listings' => Listing::latest()->filter(request(['tag','search']))->simplePaginate(4)

        ]);
    }
    //Single Listing
    public function show(Listing $listing){
        // dd($listing);

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


    //store listing
    public function store (Request $request){
     $formFeilds=$request->validate([
        'title'=>'required',
        'company'=>'required|unique:listings',
        'location'=>'required',
        'website'=>'required',
        'email'=>'required|email',
        'tags'=>'required',
        'description'=>'required',
     ]);
     if ($request->hasFile('logo')) {

        $formFeilds['logo']=$request->file('logo')->store('logos','public');
     }

     Listing::create($formFeilds);
        return redirect('/')->with('message', 'Success add Job');

    }
    //Show Edit page
     
     public function edit($id) {
        
      $listing=  Listing::where('id', $id)->first();
    //   dd($listing->title);  
      return view('listings.edit',['listing'=>$listing]);

     }
     //update listing
    public function update (Request $request,$id){
        $formFeilds=$request->validate([
           'title'=>'required',
           'company'=>'required',
           'location'=>'required',
           'website'=>'required',
           'email'=>'required|email',
           'tags'=>'required',
           'description'=>'required',
        ]);
        if ($request->hasFile('logo')) {
   
           $formFeilds['logo']=$request->file('logo')->store('logos','public');
        }
        $listing=  Listing::where('id', $id)->first();
        $listing->update($formFeilds);
           return back()->with('message', 'Success Updated Successfuly Job!');
   
       }
       public function destroy($id) {
        $listing=  Listing::where('id', $id)->first();
        $listing->delete();
        return redirect('/')->with('message', 'Listings Deleted Successfully !');
       }
       
    }
