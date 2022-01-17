<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login.index', ['title' => 'login']);
    }

    public function auth(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email:dns', 'max:255'],
            'password' => ['required', 'min:8', 'max:255']
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            $user = User::where('id', Auth::id())->first();
            if($user->is_admin == false){
                return redirect()->intended('/');
            }elseif($user->is_admin == true){
                return redirect()->intended('/admin');
            }
        }

        return back()->with('failed', 'Incorrect email or password!');

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
