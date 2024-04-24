<?php
namespace App\Services;

use App\Http\Middleware\User;
use App\Interface\InterfaceAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService{
    public function __construct(protected InterfaceAuth $interfaceAuth){
        
    }
    public function store(Request $request){
        return $this->interfaceAuth->store($request);
    }
    public function logout(Request $request){
        return $this->interfaceAuth->logout($request);
    }
    public function storeRegister(Request $request){
        return $this->interfaceAuth->storeRegister($request);
    }
}