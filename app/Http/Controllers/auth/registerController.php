<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class registerController extends Controller
{
    public function __construct(protected AuthService $authService){
        
    }
    public function create(){
        return view('auth.register');
    }
    public function storeRegister(Request $request){
        return $this->authService->storeRegister($request);
    }
}