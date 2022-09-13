@extends('auth.layouts.app')
@section('title') Register @endsection

@section('content')

    {!! Form::Open(['class' => 'login100-form validate-form']) !!}
        <span class="login100-form-title p-b-35">Register</span>

        <div class="wrap-input100 @error('name') validate-input @enderror">
            <span class="label-input100">Name</span>
            <input class="input100" type="text" name="name" value="{{ old('name') }}" placeholder="Type your name">
            <span class="focus-input100" data-symbol="&#xf206;"></span>
        </div>
        <div class="m-b-20">
            @error('name')
                <div class="invalid-msg" role="alert">{{ $message }}</div>
            @enderror
        </div>

        <div class="wrap-input100 @error('email') validate-input @enderror">
            <span class="label-input100">Email</span>
            <input class="input100" type="text" name="email" value="{{ old('email') }}" placeholder="Type your email" autocomplete="email" >
            <span class="focus-input100" data-symbol="&#xf206;"></span>
        </div>
        <div class="m-b-20">
            @error('email')
                <div class="invalid-msg" role="alert">{{ $message }}</div>
            @enderror
        </div>

        <div class="wrap-input100 @error('password') validate-input @enderror">
            <span class="label-input100">Password</span>
            <input class="input100" type="password" name="password" placeholder="Type your password" autocomplete="current-password">
            <span class="focus-input100" data-symbol="&#xf190;"></span>
        </div>
        <div class="m-b-20">
            @error('password')
                <div class="invalid-msg" role="alert">{{ $message }}</div>
            @enderror
        </div>

        <div class="wrap-input100 @error('password_confirmation') validate-input @enderror">
            <span class="label-input100">Confirm Password</span>
            <input class="input100" type="password" name="password_confirmation" placeholder="Confirm your password" autocomplete="new-password">
            <span class="focus-input100" data-symbol="&#xf190;"></span>
        </div>
        <div class="m-b-20">
            @error('password_confirmation')
                <div class="invalid-msg" role="alert">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button type="submit" class="login100-form-btn">Register</button>
            </div>
        </div>

        <div class="flex-col-c p-t-50">
            <span class="txt1 p-b-17">Or Login Using</span>
            <a href="{{ route('login') }}" class="txt2">Login</a>
        </div>
    {!! Form::close() !!}

@endsection