<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function Forget(){
        return view('auth.resetPassword');
    }

    public function ForgetPassword(Request $request){
        $request->validate([
            'email' => "required|email|exists:users,email",
        ]);
    
        $token = Str::random(64);
    
        PasswordResetToken::updateOrCreate(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => now()]
        );

        Mail::send("auth.ForgetPasswordEmail", ['token' => $token], function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Reset Your Password');
        });
    
        return redirect()->to(route('forget.password'))->with("success", "Password reset email sent");
    }

    public function resetPassword($token){
        return view('auth.newPassword', compact('token'));
    }

public function ResetPasswordPost(Request $request){
    $request->validate([
          "email" => "required|email|exists:users",
          "password" => "required|string|min:8|confirmed",
    ]);

    $resetPassword = PasswordResetToken::where('email', $request->email)
                                         ->where('token', $request->token)
                                         ->first();

    if(!$resetPassword){
        return redirect()->route('reset.password')->with('error', "Invalid or expired token");
    }

    $dd = User::where("email", $request->email)->update(["password" => Hash::make($request->password)]);
    $resetPassword->delete();

    return redirect()->route('login')->with('success', 'Password reset successfully');
}
}