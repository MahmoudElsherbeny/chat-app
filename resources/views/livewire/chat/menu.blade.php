<div>
    <!--
    <div class="discussion search">
        <div class="searchbar">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input type="text" wire:model.defer="search" placeholder="Search..." />
        </div>
    </div>
-->

    <div class="discussions_container" wire:poll>
        @foreach ($chats as $chat)
            <div class="discussion message-active">
                <a href="{{ route('chat.conversation', ['user_id' => $chat->sender_id == Auth::id() ? $chat->receiver->id : $chat->sender->id]) }}">
                    <div class="photo">
                        <img src="
                            @if(App\Models\User_friend::UserFriendRelation($chat->sender_id, $chat->receiver_id, 0)->first())
                                'chat_app/images/profile_avatar.png'
                            @else
                                @if ($chat->sender_id == Auth::id())
                                    {{ asset($chat->receiver->user_info && $chat->receiver->user_info->image ? $chat->receiver->user_info->image : 'chat_app/images/profile_avatar.png') }} 
                                @else
                                    {{ asset($chat->sender->user_info && $chat->sender->user_info->image ? $chat->sender->user_info->image : 'chat_app/images/profile_avatar.png') }}
                                @endif
                            @endif
                            " />
                        <div class="online"></div>
                    </div>
                    <div class="desc-contact">
                        <p class="name">
                            @if(App\Models\User_friend::UserFriendRelation($chat->sender_id, $chat->receiver_id, 0)->first())
                                undefined user
                            @else
                                {{ $chat->sender_id == Auth::id() ? $chat->receiver->name : $chat->sender->name }}</p>
                            @endif
                        <p class="message">{{ $chat->conversations->last()->message }}</p>
                    </div>

                    <div class="text-right" style="width: 22%">
                        @if(count($chat->conversations->where('receiver_id', Auth::id())->where('is_read', 0)) > 0)
                            <div class="badge">{{ count($chat->conversations->where('receiver_id', Auth::id())->where('is_read', 0)) }}</div>
                        @endif

                        <div class="conversation_time text-right">
                            {{ $chat->conversations->last()->created_at->diffForHumans() }}
                        </div>
                    </div>
                </a> 
            </div> 
        @endforeach
    </div>

</div>
