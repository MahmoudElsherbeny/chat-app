@extends('auth.layouts.app')
@section('title') Reset Password @endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success m-b-25" role="alert">
            {{ session('status') }}
        </div>
    @endif

    {!! Form::Open(['url' => route('password.email'), 'class' => 'login100-form validate-form']) !!}
        <span class="login100-form-title p-b-35">Reset Password</span>

        <div class="wrap-input100 @error('email') validate-input @enderror">
            <span class="label-input100">Email</span>
            <input class="input100" type="text" name="email" placeholder="Type your email" autocomplete="email" >
            <span class="focus-input100" data-symbol="&#xf206;"></span>
        </div>
        <div class="m-b-40">
            @error('email')
                <div class="invalid-msg" role="alert">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button type="submit" class="login100-form-btn">Send Reset Link</button>
            </div>
        </div>
    {!! Form::close() !!}

@endsection
