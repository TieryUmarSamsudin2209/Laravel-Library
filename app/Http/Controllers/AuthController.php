<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        if (Auth::check()) {
            return redirect('/');
        }
        return view("auth.login");
    }

    public function register(){
        if (Auth::check()) {
            return redirect('/');
        }
        return view("auth.register");
    }

    public function registerPost(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'member', // default member
        ]);

        // After register, redirect to login with success message
        return redirect('/login')->with('successRegister', 'Akun berhasil terdaftar, silakan login!');
    }

    public function login(Request $request){
        $request->validate([
            "email"=> "required|email",
            "password"=> "required"
        ]);

        $user = User::where("email",$request->email)->first();
        if(!$user){
            return redirect("/login")->with("errorLogin","Wrong email, please try again!");
        }
        if(Hash::check($request->password,$user->password)){
            Auth::login($user);
            // If admin, redirect to admin dashboard
            if(method_exists($user, 'hasRole') && $user->hasRole('admin')){
                return redirect('/admin')->with("successLogin", "Login Success!");
            }
            return redirect("/")->with("successLogin", "Login Success!");
        }else{
            return redirect("/login")->with("errorLogin","Password Incorrect!");
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}