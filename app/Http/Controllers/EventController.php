<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Http\Requests\RequestPhotos;
use App\Models\category;
use App\Models\Evenement;
use App\Models\images_event;
use App\Models\photo;
use App\Models\VoteEvent;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function createForm(){
        $categories = category::all();
        return view('events.create', compact('categories'));
    }
    public function createEvent(EventRequest $request){
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_extension = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $path = 'images/';
            $file->move($path, $file_name);
            $validated['image'] = $path . '/' . $file_name;
        }
        Evenement::create($validated);
        return redirect()->back()->with('msg', 'event created successfully');
    }
    public function displayEvents(){
        $events = Evenement::with('voteEvent')->get();
        $categories = category::all();
        return view('events.displayEvents', compact('events', 'categories'));
    }
    public function deleteEvent($id){
        $voteEvent = VoteEvent::where('evenement_id', $id);
        $voteEvent->delete();
        $event = Evenement::find($id);
        $event->delete();
        return redirect()->back();
    }
    public function updateEvent(EventRequest $request, $id){
        $validated = $request->validated();
        $imagePath = $request->file('image')->store('images', 'public');
        $imageUrl = asset('storage/' . $imagePath);
        $validated['image'] = $imageUrl;
        $event = Evenement::find($id);
        $event->update($validated);
        return redirect()->back();
    }
    public function readEvent($id){
        $categories = category::all();
        $events = Evenement::where('id', $id)->with('voteEvent')->get();
        return view('events/readEvent', compact('events', 'categories'));
    }
}
