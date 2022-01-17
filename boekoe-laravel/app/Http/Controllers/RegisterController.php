<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class registerController extends Controller
{
    public function index(){
        return view('register.index',['title' => 'Register']);
    }

    public function store(Request $request){
        $validatedRequest = $request->validate([
            'username' => ['required', 'min:4', 'max:100', 'unique:users'],
            'email' => ['required', 'email:dns', 'unique:users', 'max:255'],
            'password' => ['required', 'min:8', 'max:255', 'confirmed']
        ]);

        $validatedRequest['password'] = bcrypt($validatedRequest['password']);
        User::create($validatedRequest);
        return redirect('/login');

    }
}