<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Recipe;
use Session;

class PagesController extends Controller
{
    public function getHome(){
        //return view('pages.home')->withTest('Test Value'); 
        //shorthand to create a variable named $test that holds the value of 'Test Value'
        //can send arrays too

        //omitting select * from Recipe::select(*)->with(foobar);
        $recipes = Recipe::with('ingredients')
        ->join('users', 'recipes.user_id', '=', 'users.id')
        ->select('recipes.*', 'users.name as username')
        ->orderBy('recipes.id', 'desc')->paginate(10);

        return view('pages.home')->withRecipes($recipes);
    }

    public function getDashboard(){
        return view('pages.dashboard');
    }

    public function getEdit(){
        return view('pages.edit');
    }
    public function getLogin(){
        return view('pages.login');
    }
    public function storeLogin(Request $request){
        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            Session::flash('success', 'You have Logged In Successfully');
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        
        Session::flash('error', 'The provided credentials do not match our records');
        return redirect()->back()->withInput($request->only('email'));
    }

    public function loginCheck(){

    }
    public function destroyLogin(Request $request){

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Session::flash('error', 'You have been Logged Out');

        return redirect('/');
    }
    public function getRegister(){
        return view('pages.register');
    }
    public function storeRegister(Request $request){
       /* Needed to use Validator 
        $request->validate([
            'name' => ['required', 'string', 'unique:users', 'max:255'],
            'email' => ['required', 'string', 'unique:users', 'email', 'max:255'],
            'password' => ['required'],
        ]);
        */
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:users', 'max:255'],
            'email' => ['required', 'string', 'unique:users', 'email', 'max:255'],
            'password' => ['required', 'min:8'],
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

       
        event(new Registered($user));

        Auth::login($user);

        Session::flash('success', 'Your Account has been successfully Registered | Click the Button above to Start');
        return redirect(RouteServiceProvider::HOME);
    }

    public function copyFlash(){
        Session::flash('success', 'Recipe has been Copied to Clipboard - Ctrl + V to Paste');

        return redirect()->back();
    }

}
