<?php
namespace App\Interface;

use Illuminate\Http\Request;

interface InterfaceAuth {
    public function store(Request $request);
    public function logout(Request $request);
    public function storeRegister(Request $request);
}