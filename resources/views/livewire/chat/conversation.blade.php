<div>

    <div class="header-chat">
        <div class="photo">
            <img src="
            @if ($friend_relation_block)
                'chat_app/images/profile_avatar.png'
            @else
                {{ asset($chat_with->user_info && $chat_with->user_info->image ? $chat_with->user_info->image : 'chat_app/images/profile_avatar.png') }}
            @endif
            " />
        </div>
        <p class="name">{{ $friend_relation_block ? 'undefined user' : $chat_with->name }}</p>
        <i class="icon clickable fa fa-ellipsis-h right" aria-hidden="true"></i>
    </div>

    <div id="chat_page" class="messages-chat" wire:poll>
        @if($chat && $chat->conversations)

            @foreach ($chat->conversations as $index => $conversation)

                @if($conversation->sender_id == Auth::id())
                    <div class="message text-only">
                        <div class="response">
                            <p class="text">{{ $conversation->message }}</p>
                        </div>
                    </div>

                    @if($loop->last || isset($chat->conversations[$index+1]) && $chat->conversations[$index+1]['sender_id'] != Auth::id())
                        <p class="response-time time">{{ $conversation->created_at->diffForHumans() }}</p>
                    @endif
                @elseif($conversation->sender_id == $chat_with->id)
                    <div class="message text-only">
                        <p class="text"> {{ $conversation->message }}</p>
                    </div>

                    @if($loop->last || isset($chat->conversations[$index+1]) && $chat->conversations[$index+1]['sender_id'] != $chat_with->id)
                        <p class="time"> {{ $conversation->created_at->diffForHumans() }}</p>
                    @endif
                @endif

            @endforeach

        @else
            @if(!$friend_relation_block)
                <div class="chat_empty text-center">
                    Start Chat With <span class="text-capitalize">{{ $chat_with->name }}</span>
                </div>
            @endif
        @endif
    </div>
    
    <div class="footer-chat">
        @if ($friend_relation_block)
            <div class="text-center">Sorry can't contact with this user</div>
        @else
            {!! Form::open(['wire:submit.prevent' => 'send('.$chat_with->id.')']) !!}
                <i class="icon fa fa-smile-o clickable" style="font-size:25pt;" aria-hidden="true"></i>
                <input wire:model="message" type="text" name="message" class="write-message" placeholder="Type your message here" />
                <button type="submit" class="icon send clickable btn-none">
                    <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                </button>
            {!! Form::close() !!}
        @endif
    </div>

</div>
