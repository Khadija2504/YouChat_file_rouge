<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function create(Request $request){
        return view('auth/login');
    }
    public function store(Request $request){
        $validate = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if(Auth::attempt($validate)){
            $request->session()->regenerate();
            $user = User::where('id', Auth::id())->first();
            if($user->role === 'user'){
                return redirect()->route('home');
            } else{
                return redirect()->route('dashboard');
            }
        // return redirect()->route('welcome');
        }
        return redirect()->back()->with('worning', 'wrong email or password');
    }
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}