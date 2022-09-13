@extends('chat_app.layouts.app')
@section('title') Home @endsection

@section('content')

<div class="friends_suggestions">
    @foreach ($users as $user)
        <div class="suggestion">
            <div class="photo">
                <img src="{{ asset($user->user_info && $user->user_info->image ? $user->user_info->image : 'chat_app/images/profile_avatar.png') }}" />
            </div>
            <div class="desc-contact">
                <p class="name">{{ $user->name }}</p>
                <p class="message">{{ $user->user_info ? $user->user_info->status : '' }}</p>
            </div>
            <div class="actions">
                {!! Form::Open(['url' => route('friends.add', ['user_id' => $user->id])]) !!}
                    <button type="submit" class="btn-none"><i class="fa fa-user-plus"></i></button>
                {!! Form::Close() !!}
                {!! Form::Open(['url' => route('friends.block', ['user_id' => $user->id])]) !!}
                    <button type="submit" class="btn-none"><i class="fa fa-ban"></i></button>
                {!! Form::Close() !!}
            </div>
        </div>
    @endforeach
</div>

@endsection