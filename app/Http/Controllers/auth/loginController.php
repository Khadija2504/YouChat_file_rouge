<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function __construct(protected AuthService $authService){
        
    }
    public function create(Request $request){
        return view('auth/login');
    }
    public function store(Request $request){
        return $this->authService->store($request);
    }
    public function logout(Request $request): RedirectResponse
    {
        return $this->authService->logout($request);
        
    }
}