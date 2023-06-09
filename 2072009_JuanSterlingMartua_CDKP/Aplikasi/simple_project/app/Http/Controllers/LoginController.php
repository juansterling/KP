<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view("login");
    }
    
    public function signup(Request $request)
    {
        $dataemail = $request->emailsignup;
        $dataname = $request->namesignup;
        $datapassword = $request->passwordsignup;
        $dataconfirmpassword = $request->confirmpassword;
        $user = new User();
        if ($datapassword == $dataconfirmpassword) {
            $user->email = $dataemail;
            $user->name = $dataname;
            $user->role = "guest";
            $user->password = Hash::make($dataconfirmpassword);
            $user->save();
            $result = Auth::attempt(['email' => $dataemail, 'password' => $dataconfirmpassword]);
            if ($result) {
                return redirect('/home');
            } else {
                return back()->withErrors(["Wrong email/password"]);
                //return redirect("/login)
            }
        } else {
            return back()->withErrors(["Failed SignUp"]);
        }
    }
    public function login(Request $request)
    {
        $dataemail = $request->email;
        $datapassword = $request->password;
        $result = Auth::attempt(['email' => $dataemail, 'password' => $datapassword]);
        if ($result) {
            return redirect('/home');
        } else {
            return back()->withErrors(["Wrong email/password"]);
            //return redirect("/login)
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect("/login");
    }
}
