@extends('chat_app.layouts.app')
@section('title') Friends Requests @endsection

@section('content')

<div class="friends_suggestions">
    @if(count($friend_requests) > 0)
        @foreach ($friend_requests as $request)
            <div class="suggestion">
                <div class="photo">
                    <img src="{{ asset($request->user_info && $request->user_info->image ? $request->user_info->image : 'chat_app/images/profile_avatar.png') }}" />
                </div>
                <div class="desc-contact">
                    <p class="name">{{ $request->name }}</p>
                    <p class="message">{{ $request->user_info ? $request->user_info->status : '' }}</p>
                </div>
                <div class="actions">
                    {!! Form::Open(['url' => route('friends.accept', ['id' => $request->pivot->id])]) !!}
                        <button type="submit" class="btn-none"><i class="fa fa-check"></i></button>
                    {!! Form::Close() !!}
                    {!! Form::Open(['url' => route('friends.delete', ['id' => $request->pivot->id])]) !!}
                        <button type="submit" class="btn-none"><i class="fa fa-times"></i></button>
                    {!! Form::Close() !!}
                </div>
            </div>
        @endforeach
    @else
        <div class="empty_content text-center">
            No Requests For Now
        </div>
    @endif
</div>

@endsection