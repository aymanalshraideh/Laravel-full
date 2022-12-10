<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create (){
        return view('users.register');
    }
    public function store(Request $request){
      $formFields=$request->validate([
        'name' => 'required|min:3',
        'email' => 'required|unique:users|email',
        'password' => 'required|confirmed|min:6',
      ]);
      //Hash Password
      $formFields['password']=bcrypt($formFields['password']);
      //create User
      $user=User::create($formFields);
      auth()->login($user);

      return redirect('/')->with('message', 'User created successfully and Logged in!');

    }
}
