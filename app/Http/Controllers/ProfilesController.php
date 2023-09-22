<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        return view('profiles.index')->withUser($user);
    }
    public function updateUsername(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:users', 'max:255'],
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } 

       $user = User::findOrFail(Auth::id()); 
       $user->name = $request->input('name');
       $user->save();

       Session::flash('success', 'Updated Username');
       return redirect()->route('profile.index'); 
    }

    public function updatePassword(Request $request)
    {
       $validator = Validator::make($request->all(), [
           'password' => ['required', 'min:8'] 
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } 

        if ($request->input('password') != $request->input('repeat')){
            Session::flash('error', 'Passwords do not match. Please Try Again');
        }
        else{
            $user = User::findOrFail(Auth::id()); 
            $user->password = $request->input('password');
            $user->save();

            Session::flash('success', 'Updated Password'); 
        }
        return redirect()->route('profile.index'); 
    }
    public function updateEmail(Request $request)
    {
        //function updates email column
       $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'unique:users', 'email', 'max:255'],
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } 

       $user = User::findOrFail(Auth::id()); 
       $user->email = $request->input('email');
       $user->save();

       Session::flash('success', 'Updated Email Address');
       return redirect()->route('profile.index');
    }
    public function deleteAccount()
    {
        $user = User::findOrFail(Auth::id()); 
        $user->delete(); 
        Auth::guard('web')->logout(); 

        Session::flash('error', 'Your account has been deleted. Have a nice life.');

        
        return redirect('/');
    }
}
