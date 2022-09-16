@extends('chat_app.layouts.app')
@section('title') Friends Requests @endsection

@section('content')

<div class="friends_suggestions_header">
    <a href="{{ route('friends.index', ['type' => 'all']) }}" class="item"> All Friends</a>
    <span>|</span>
    <a href="{{ route('friends.index', ['type' => 'block']) }}" class="item"> Block Menu</a>
    <span>|</span>
    <a href="{{ route('friends.index', ['type' => 'requests_send']) }}" class="item"> Requests Sent</a>
</div>

<div class="friends_suggestions">
    @if(count($friends_relations) > 0)
        @foreach ($friends_relations as $friend)
            <div class="suggestion">
                <div class="photo">
                    <img src="{{ asset($friend->user_info && $friend->user_info->image ? $friend->user_info->image : 'chat_app/images/profile_avatar.png') }}" />
                </div>
                <div class="desc-contact">
                    <p class="name">{{ $friend->name }}</p>
                    @if($friend->pivot->status == 2)
                        <p class="info">{{ $friend->email }} {{ $friend->user_info ? ' | '.$friend->user_info->phone : '' }}</p>
                    @endif
                    <p class="message">{{ $friend->user_info ? $friend->user_info->status : '' }}</p>
                </div>
                <div class="actions">
                    @if($friend->pivot->status == 2) <!--  friends list  -->
                        <a href="{{ route('chat.conversation', ['user_id' => $friend->id]) }}" title="chat"><i class="fa fa-comment"></i></a>
                        {!! Form::Open(['url' => route('friends.delete', ['id' => $friend->pivot->id])]) !!}
                            <button type="submit" class="btn-none" title="delete friend"><i class="fa fa-trash"></i></button>
                        {!! Form::Close() !!}
                        {!! Form::Open(['url' => route('friends.block', ['user_id' => $friend->id])]) !!}
                            <button type="submit" class="btn-none" title="block"><i class="fa fa-ban"></i></button>
                        {!! Form::Close() !!}
                    @elseif($friend->pivot->status == 1)  <!--  friend requests sent list  -->
                        {!! Form::Open(['url' => route('friends.delete', ['id' => $friend->pivot->id])]) !!}
                            <button type="submit" class="btn-none" title="delete friend"><i class="fa fa-trash"></i></button>
                        {!! Form::Close() !!}
                    @elseif($friend->pivot->status == 0)  <!-- blocks list  -->
                        {!! Form::Open(['url' => route('friends.unblock', ['user_id' => $friend->id])]) !!}
                            <button type="submit" class="btn-none" title="unblock"><i class="fa fa-unlock"></i></button>
                        {!! Form::Close() !!}
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <div class="empty_content text-center">
            No Data To Show
        </div>
    @endif
</div>

@endsection