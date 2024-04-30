<?php
namespace App\Repositories;
use App\Interface\InterfaceAuth;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepositories implements InterfaceAuth{
    public function store(Request $request){
        // dd($request->all());
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
        }
        // return redirect()->back()->with('worning', 'wrong email or password');
    }
    public function logout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    public function storeRegister(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'avatar' => ['required', 'image', 'max:2048'],
            'password' => ['required', 'string', 'min:8'],
            'about' => ['required', 'string'],
            'country' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
        ]);
        
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $file_extension = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $path = 'avatars';
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
            'about' => $request->about,
            'contry' => $request->contry,
            'city' => $request->city,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('login');
    }
}