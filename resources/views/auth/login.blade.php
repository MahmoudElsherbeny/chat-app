@extends('auth.layouts.app')
@section('title') Login @endsection

@section('content')

    {!! Form::Open(['class' => 'login100-form validate-form']) !!}
        <span class="login100-form-title p-b-35">Login</span>

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
        
        <div class="p-t-10 p-b-31">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                    <label for="login_remember" style="font-weight: 400; margin: 0;">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}} id="login_remember" style="margin: 0 2px 0 0"><span></span> Remember me
                    </label>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                    <a href="{{ route('password.request') }}"> Forgot password?</a>
                </div>
            </div>
        </div>
        
        <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button type="submit" class="login100-form-btn">Login</button>
            </div>
        </div>

        <div class="flex-col-c p-t-50">
            <span class="txt1 p-b-17">Or Sign Up Using</span>
            <a href="{{ route('register') }}" class="txt2">Sign Up</a>
        </div>
    {!! Form::close() !!}

@endsection