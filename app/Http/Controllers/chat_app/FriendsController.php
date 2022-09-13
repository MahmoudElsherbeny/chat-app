<?php

namespace App\Http\Controllers\chat_app;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\User_friend;
use Exception;

class FriendsController extends Controller
{
    // show friends page
    public function index($type)
    {
        if($type == 'all') {
            $user_friends = Auth::user()->friends()->where('status', 2)->get();
            $friends_for_user = Auth::user()->friending()->where('status', 2)->get();
            $friends_relations = $user_friends->merge($friends_for_user);
        }
        elseif($type == 'block') {
            $friends_relations = Auth::user()->friending()->where('status', 0)->get();
        }
        elseif($type == 'requests_send') {
            $friends_relations = Auth::user()->friending()->where('status', 1)->get();
        }
        else {
            return Redirect::back();
        }

        return view('chat_app.friends.friends')->with('friends_relations', $friends_relations);
    }

    // show friend requests page
    public function requests()
    {
        $friend_requests = Auth::user()->friends()->where('status', 1)->get();
        return view('chat_app.friends.requests')->with('friend_requests', $friend_requests);
    }

    //add friend request
    public function add($user_id) {
        $friend = User_friend::IsFriend($user_id)->first();
        try {
            if(!$friend) {
                User_friend::create([
                    'user_id' => Auth::id(),
                    'friend_id' => $user_id,
                    'status' => 1
                ]);
            }
        } catch(Exception $e) {
            Session::flash('error', 'Error: '.$e->getMessage());
        }

        return Redirect::back();
    }

    //block user
    public function block($user_id) {
        $friend = User_friend::IsFriend($user_id)->first();
        try {
            if($friend) {
                $friend->update(['status' => 0]);
            }
            else {
                User_friend::create([
                    'user_id' => Auth::id(),
                    'friend_id' => $user_id,
                    'status' => 0
                ]);
            }
        } catch(Exception $e) {
            Session::flash('error', 'Error: '.$e->getMessage());
        }

        return Redirect::back();
    }

    // unblock user
    public function unblock($user_id) {
        $friend = User_friend::IsBlocked($user_id)->first();
        $chat_with = Chat::ChatWith($user_id)->first();

        try {
            if($friend) {
                $chat_with ? $friend->update(['status' => 2]) : $friend->delete();
            }
        } catch(Exception $e) {
            Session::flash('error', 'Error: '.$e->getMessage());
        }

        return Redirect::back();
    }

    // accept friend request
    public function accept($id) {
        $request = User_friend::findOrFail($id);
        try {
            $request->update(['status' => 2]);
        } catch(Exception $e) {
            Session::flash('error', 'Error: '.$e->getMessage());
        }

        return Redirect::back();
    }

    //delete user or refuse friend request
    public function delete($id) {
        $request = User_friend::findOrFail($id);
        try {
            $request->delete();
        } catch(Exception $e) {
            Session::flash('error', 'Error: '.$e->getMessage());
        }

        return Redirect::back();
    }
}
