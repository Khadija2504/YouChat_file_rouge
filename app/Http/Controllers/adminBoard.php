<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminBoard extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }
}
