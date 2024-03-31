<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class registerController extends Controller
{
    public function create(){
        return view('auth.register');
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'avatar' => ['required'],
            'password' => ['required'],
        ]);
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $file_extension = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $path = 'avatars/';
            $file->move($path, $file_name);
            $validated['avatar'] = $path . '/' . $file_name;
        }
        $randomNumbers = mt_rand(1000, 9999);

        $name = $request->name;

        $nameParts = explode(' ', $name);

        $firstWord = $nameParts[0];

        $user_name = $firstWord . '#' . $randomNumbers;
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_name' => $user_name,
            'avatar' => $validated['avatar'],
            'password' => Hash::make($request->password),
        ]);
        event(new Registered($user));
        return redirect()->route('login');
    }
}