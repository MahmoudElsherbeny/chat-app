@extends('auth.layouts.app')
@section('title') Reset Password @endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success m-b-25" role="alert">
            {{ session('status') }}
        </div>
    @endif

    {!! Form::Open(['url' => route('password.update'), 'class' => 'login100-form validate-form']) !!}
        <input type="hidden" name="token" value="{{ $token }}">
        <span class="login100-form-title p-b-35">Reset password</span>

        <div class="wrap-input100 @error('email') validate-input @enderror">
            <span class="label-input100">Email</span>
            <input class="input100" type="text" name="email" value="{{ $email ?? old('email') }}" placeholder="Type your email" autocomplete="email" >
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

        <div class="wrap-input100">
            <span class="label-input100 m-b-20">Confirm Password</span>
            <input class="input100" type="password" name="password_confirmation" placeholder="Confirm your password" autocomplete="current-password">
            <span class="focus-input100" data-symbol="&#xf190;"></span>
        </div>
        
        <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button type="submit" class="login100-form-btn">Reset Password</button>
            </div>
        </div>
    {!! Form::close() !!}

@endsection