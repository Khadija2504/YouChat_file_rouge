<?php

namespace App\Http\Controllers;

use App\Models\video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function addVideoForm(){
        return view('video.addVideo');
    }
    public function addVideo(Request $request){
        $validated = $request->validate([
            'video' => 'required',
            'titre' => 'required',
            'description' => 'max:2000',
        ]);
        // dd($request->titre);

        // $videoPath = $request->file('video')->store('videos', 'public');
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $file_extension = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $path = 'videos/';
            $file->move($path, $file_name);
            $validated['video'] = $path . '/' . $file_name;
        }
        $user_id = auth()->user()->id;

        Video::create([
            'video' => $validated['video'],
            'user_id' => $user_id,
            'titre' => $request->titre,
            'description' => $request->description,
        ]);

        return redirect()->back();
    }
    public function displayReels(){
        $videos = video::with('videoVotes')->get();
        return view('video.videos', compact('videos'));
    }
}
