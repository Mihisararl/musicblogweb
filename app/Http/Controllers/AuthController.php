<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Register user
    public function register(Request $request){
        //validate
        $fields = $request->validate([
            'name'=>['required','max:255'],
            'email'=>['required','max:255','email','unique:users'],
            'password'=>['required','min:5','confirmed']
        ]);

        //register
        $user = User::create($fields);

        //login
        Auth::login($user);

        //redirect
       return redirect()->route('dashboard');

    }
    //login user
    public function login(Request $request){
         //validate
         $fields = $request->validate([
            'email'=>['required','max:255','email'],
            'password'=>['required']
        ]);
        
        //try to login
       if (Auth::attempt($fields, $request->remember)){
        return redirect()->intended('dashboard');

       }else{
        return back()->withErrors([
            'failed'=> 'The provided credentials do not match our records'
        ]);
       }

    }
    //logout user
    public function logout(Request $request){
        //logout user
        Auth::logout();
        //invalidate user's session
        $request->session()->invalidate();
        //regenerate csrf token
        $request->session()->regenerateToken();
        //redirect to home
        return redirect('/');
    }
}
