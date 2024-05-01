<?php

namespace App\Http\Controllers;

use App\Models\FriendsList;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendsListController extends Controller
{
    // public function follow($id){
    //     $message = 'New follower';
    //     if(Auth::user()->acceptation == 'auto'){
    //         $followed = FriendsList::create([
    //             'user_id' => Auth::user()->id,
    //             'friend_id' => $id,
    //             'status' => 'valid',
    //         ]);
    //     } else{
    //         $followed = FriendsList::create([
    //             'user_id' => Auth::user()->id,
    //             'friend_id' => $id,
    //             'status' => 'invalid',
    //         ]);
    //     }
    //     Notification::create([
    //         'user_id' => $id,
    //         'message' => $message,
    //         'sender_id' => auth()->user()->id,
    //         'type' => 'follower',
    //         'data_id' => 'no data',
    //     ]);
    //     return redirect()->back();
    // }

    public function follow($id) {
        try {
            $message = 'New follower';
            $status = Auth::user()->acceptation == 'auto' ? 'valid' : 'invalid';
                $existingFollow = FriendsList::where('user_id', Auth::user()->id)
                ->where('friend_id', $id)
                ->exists();
    
            if (!$existingFollow) {
                $followed = FriendsList::create([
                    'user_id' => Auth::user()->id,
                    'friend_id' => $id,
                    'status' => $status,
                ]);
    
                Notification::create([
                    'user_id' => $id,
                    'message' => $message,
                    'sender_id' => auth()->user()->id,
                    'type' => 'follower',
                    'data_id' => 'no data',
                ]);
    
                return response()->json(['message' => 'Followed successfully', 'status' => $status]);
            } else {
                return response()->json(['message' => 'Already followed']);
            }
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Database error: ' . $exception->getMessage()], 500);
        } catch (ValidationException $exception) {
            return response()->json(['error' => 'Validation error: ' . $exception->getMessage()], 422);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'An unexpected error occurred: ' . $exception->getMessage()], 500);
        }
    }

    public function listFollowers(){
        $followers = FriendsList::where('friend_id', Auth::user()->id)->get();
        return view('users/list_followers', compact('followers'));
    }
    public function listFollowings(){
        $followings = FriendsList::where('user_id', Auth::user()->id)->get();
        return view('users/list_followings', compact('followings'));
    }

    public function EditProfile(){
        $users = User::where('id', Auth::user()->id)->get();
        $followers = FriendsList::where('friend_id', Auth::user()->id)->get()->count();
        return view('users.updateProfile', compact('users', 'followers'));
    }
    public function updateProfile(Request $request){
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'avatar' => ['required'],
            'about' => ['required'],
            'contry' => ['nullable'],
            'city' => ['nullable'],
        ]);
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $file_extension = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $path = 'avatars';
            $file->move($path, $file_name);
            $validated['avatar'] = $path . '/' . $file_name;
        }
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->update($validated);
        return redirect()->back();
    }

    public function acceptation($id){
        $friendsList = FriendsList::where('id', $id);
        $friends = FriendsList::find($id);
        $validation = 'valid';
        $friendsList->update([
            'status' => $validation,
        ]);
        $message = auth()->user()->name . 'is accepted you as a foller';
        Notification::create([
            'user_id' => $friends->friend_id,
            'message' => $message,
            'sender_id' => auth()->user()->id,
            'type' => 'follower',
            'data_id' => $id,
        ]);
        return redirect()->back()->with('message', 'The user has been accepted successfully');
    }
    public function block($id){
        $friendsList = FriendsList::where('user_id', Auth::user()->id)->where('friend_id', $id)->first();
        if(isset($friendsList)){
            if($friendsList->blocked == '0'){
                $friendsList->blocked = "1";
                $friendsList->save();
            } else{
                $friendsList->blocked = "0";
                $friendsList->save();
            }
            
        }
        return redirect()->back()->with('message', 'The user has been blocked successfully');
    }
    // public function profile($id){
    //     $users = User::where('id', $id)->with('followers')->get();
    //     return view('users.profile', compact('users', 'id'));
    // }
    public function profile($id) {
        $users = User::where('id', $id)->with('followers', 'posts', 'videos', 'reels', 'events')->get();
        $user = User::findOrFail($id);
        $isFollowed = FriendsList::where('user_id', Auth::id())
            ->where('friend_id', $id)
            ->exists();
        $isBlocked = FriendsList::where('user_id', Auth::id())
            ->where('blocked', '1')->exists();
        $followers = FriendsList::where('friend_id', Auth::user()->id)->get()->count();
        return view('users.profile', compact('users', 'id','user','isFollowed', 'followers', 'isBlocked'));
    }
    public function unfollow($id){
        $friendList = FriendsList::where('user_id', Auth::user()->id)->where('friend_id', $id)->first();
        $friendList->delete();
        return redirect()->back();
    }

    public function shareProfile($userId, $conversationId){
        $user = User::where('id', $userId)->first();
        $message = "<a href='http://127.0.0.1:8000/profile/$userId'> $user->about </a>";
        $sendMessage = Message::create([
            'chat_id' => $conversationId,
            'from_id' => Auth::user()->id,
            'to_id' => Auth::user()->id,
            'message' => $message,
        ]);
        return response()->json([
            'msg' => 'user share successful',
            'success' => true,
            'sendMessage' => $sendMessage,
        ]);
    }
    public function status($statusData){
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        // dd($statusData);
        $user->update([
            'status' => $statusData,
        ]);
        return response()->json([
            'msg' => 'status updated successfully',
            'user' => $user,
        ]);
    }
    public function acceptationChoose($acceptation){
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user->update([
            'acceptation' => $acceptation,
        ]);
        return response()->json([
            'msg' => 'updating acceptation successfully',
            'user' => $user,
        ]);
    }
}