<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class googleAuthController extends Controller
{
    public function redirect(){

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            
            $user = User::where('social_id', $google_user->getId())->first();
            $randomNumbers = mt_rand(1000, 9999);

            $name = $google_user->getName();

            $nameParts = explode(' ', $name);

            $firstWord = $nameParts[0];

            $user_name = $firstWord . '#' . $randomNumbers;
            if (!$user) {
                $existingUser = User::where('email', $google_user->getEmail())->first();
            if ($existingUser) {

                Auth::login($existingUser);
                return redirect()->intended('home');
            }
                $new_user = User::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                    'avatar' => $google_user->getAvatar(),
                    'user_name' => $user_name,
                ]);
                Auth::login($new_user);
                return redirect()->intended('home');
            } else {
                Auth::login($user);
                return redirect()->intended('home');
            }
        } catch (\Throwable $th) {
            dd("something went wrong! " . $th->getMessage());
        }
    }

    public function handleGoogleCallbackOrganisateur(){
        try {
            $google_user = Socialite::driver('google')->user();
            
            $user = User::where('social_id', $google_user->getId())->first();
            $randomNumbers = mt_rand(1000, 9999);
            $identifiant_unique = $google_user->getName() . '#' . $randomNumbers;
            if (!$user) {
                $new_user = User::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                    'avatar' => $google_user->getAvatar(),
                    'identifiant_unique' => $identifiant_unique,
                    'role' => 'organisateur',
                ]);
                // $user->assignRole('organisateur');
                Auth::login($new_user);
                return redirect()->intended('dashboard');
            } else {
                Auth::login($user);
                return redirect()->intended('dashboard');
            }
        } catch (\Throwable $th) {
            dd("something went wrong! " . $th->getMessage());
        }
    }
}
