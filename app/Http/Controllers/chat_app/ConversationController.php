<?php

namespace App\Http\Controllers\chat_app;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Chat;
use App\Models\Conversation;
use App\Models\User_friend;
use Exception;

class ConversationController extends Controller
{
    public function conversation($user_id) {
        $chat = Chat::ChatWith($user_id)->first();
        $chat_with = User::WithotCurrentUser()->findOrFail($user_id);
        $friend_relation_block = User_friend::UserFriendRelation(Auth::id(),$user_id,0)->first();

        //mark messages as read when other user visit chat
        if($chat && $chat->conversations) {
            $not_reads = $chat->conversations->where('receiver_id', Auth::id())->where('is_read', 0);
            foreach($not_reads as $conv) {
                $conv->update(['is_read' => 1]);
            } 
        }

        return $chat 
            ? view('chat_app.conversation.chat')->with([
                'chat' => $chat,
                'chat_with' => $chat_with,
                'friend_relation_block' => $friend_relation_block,
            ])
            : abort('404');
    }

    //send messages with livewire
}
