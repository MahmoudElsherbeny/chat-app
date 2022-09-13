@extends('chat_app.layouts.app')
@section('title') {{ Auth::user()->name }} @endsection

@section('content')
@if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@else
    <div class="alert alert-error">{{ Session::get('error') }}</div>
@endif

<div class="profile_container">
    {!! Form::open(['url' => route('profile.update', ['id' => Auth::id(), 'name' =>Auth::user()->name]), 'files' => true]) !!}
        <div class="form-group form-image">
            <input id="image_input" type="file" name="image" class="image_input" />
            <div class="photo">
                <img src="{{ asset(Auth::user()->user_info && Auth::user()->user_info->image ? Auth::user()->user_info->image : 'chat_app/images/profile_avatar.png') }}" />
                <label for="image_input" class="chose_photo"> <i class="fa fa-pencil"></i> </label>
            </div>

            @error('image')
                <div class="error-msg">{{ message }}</div>
            @enderror
        </div>

        <div class="form-group form-input">
            <div class="row">
                <div class="col-md-3 text-right">
                    <label>Name:</label>
                </div>
                <div class="col-md-9">
                    <input class="@error('name') error-input @enderror" type="text" name="name" value="{{ old('name', Auth::user()->name) }}"  />
                    @error('name')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group form-input">
            <div class="row">
                <div class="col-md-3 text-right">
                    <label>Status:</label>
                </div>
                <div class="col-md-9">
                    <input class="@error('name') error-input @enderror" type="text" name="status" value="{{ Auth::user()->user_info ? old('status', Auth::user()->user_info->status) : '' }}"  />
                    @error('status')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group form-input">
            <div class="row">
                <div class="col-md-3 text-right">
                    <label>Phone:</label>
                </div>
                <div class="col-md-9">
                    <input class="@error('phone') error-input @enderror" type="text" name="phone" value="{{ Auth::user()->user_info ? old('phone', Auth::user()->user_info->phone): '' }}"  />
                    @error('phone')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    {!! Form::close() !!}
</div>

@endsection