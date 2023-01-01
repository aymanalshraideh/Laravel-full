<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function create()
  {
    return view('users.register');
  }
  public function store(Request $request)
  {
    $formFields = $request->validate([
      'name' => 'required|min:3',
      'email' => 'required|unique:users|email',
      'password' => 'required|confirmed|min:6',
    ]);
    //Hash Password
    $formFields['password'] = bcrypt($formFields['password']);
    //create User
    $user = User::create($formFields);
    auth()->login($user);

    return redirect('/')->with('message', 'User created successfully and Logged in!');
  }
  // Logout
  public function logout(Request $request)
  {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerate();
    return redirect('/')->with('message', 'You have been logged out');
  }
  // Show Login Form
  public function login(){
    return view('users.login');
  }
  // authenticate user
  public function auth(Request $request){
    $formFields=$request->validate([
      'email' => 'required|email',
      'password' => 'required'
    ]);
    if(auth()->attempt($formFields)){
      $request->session()->regenerate();
      return redirect('/')->with('message', 'You are now logged in !! ');
    }

    return back()->withErrors(['email'=>'Invalid email'])->onlyInput('email');
  }
}
