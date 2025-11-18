<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        $user = User::all();
        if (Auth::check()) {
            return redirect('/');
        }
        return view("auth.login");
    }

    public function register(){
        $user = User::all();
        return view("auth.register");
    }

    public function login(Request $request){
        $request->validate([
            "email"=> "required|email",
            "password"=> "required"
        ]);

        $user = User::where("email",$request->email)->first();

        if($user->count() == 0){
            if(Hash::check($request->password,$user->password)){
                Auth::login($user);
                return redirect("/")->with("successLogin", "Login Success!");
            }else{
                return redirect("/login")->with("errorLogin","Password Incorrect!");
            }
        }else{
            return redirect("/login")->with("errorLogin","Wrong email, please try again!");
        }
        
        return view("home.index");
    }
}