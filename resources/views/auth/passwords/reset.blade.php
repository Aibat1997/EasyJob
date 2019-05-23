@extends('layouts.layout')

@section('container')
<div class="container" style="background-image: url({{ asset('images/index2.jpg') }});">
@endsection

@section('content')
<div class="inner-container" style="min-height: 283px;">
    <div class="sign-up-container">
        <form method="POST" action="{{ route('password.update') }}">
        @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="Email" required autofocus>
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Новый пороль" required>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  placeholder="Повторите пороль" required>
            <div class="submit-signup-btn">
                <input type="submit" value="Зарегистрироваться" />
            </div>
        </form>
        @include('errors')
    </div>
</div>
@endsection
