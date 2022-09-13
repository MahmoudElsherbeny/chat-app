@extends('chat_app.layouts.app')
@section('title') Chat @endsection

@section('content')

<div class="chat">
    
    @livewire('chat.conversation', [
        'chat' => $chat,
        'chat_with' => $chat_with,
        'friend_relation_block' => $friend_relation_block,
    ])

</div>

@endsection

@section('js_code')

<script>
    function scroll_down() {
        document.getElementById('chat_page').scrollTop = document.getElementById('chat_page').scrollHeight
    }
    setInterval(scroll_down, 1000);
</script>

@endsection