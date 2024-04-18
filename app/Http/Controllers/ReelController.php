<?php

namespace App\Http\Controllers;

use App\Models\Reel;
use Illuminate\Http\Request;

class ReelController extends Controller
{
    public function displayReels(){
        $reels = Reel::with('votesReel')->get();
        return view('video.displayReels', compact('reels'));
    }
    public function addForm(){
        return view('video.addReelForm');
    }
    public function addReel(Request $request){
        $validated = $request->validate([
            'description' => 'max:2000',
            'reel' => 'required',
            'user_id' => 'required',
        ]);
        if ($request->hasFile('reel')) {
            $file = $request->file('reel');
            $file_extension = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $path = 'reels/';
            $file->move($path, $file_name);
            $validated['reel'] = $path . '/' . $file_name;
        }
        $reel = Reel::create($validated);
        return redirect()->back();
    }
    public function redirectBack(){
        return redirect()->back();
    }
}