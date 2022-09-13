@extends('auth.layouts.app')
@section('title') Verify Email @endsection

@section('content')
    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            A fresh verification link has been sent to your email address.'
        </div>
    @endif

        <span class="login100-form-title p-b-35">Verify Your Email</span>

        <div class="m-b-30">
            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
        </div>
        
        <div class="container-login100-form-btn">
            {!! Form::Open(['url' => route('verification.resend'), 'class' => 'login100-form validate-form']) !!}
                <div class="wrap-login100-form-btn">
                    <div class="login100-form-bgbtn"></div>
                    <button type="submit" class="login100-form-btn">Click Here to send another email</button>
                </div>
            {!! Form::close() !!}
        </div>

@endsection