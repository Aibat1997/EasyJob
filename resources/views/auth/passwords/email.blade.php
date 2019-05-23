@extends('layouts.layout')

@section('container')
<div class="container" style="background-image: url({{ asset('images/index2.jpg') }});">
@endsection

@section('content')
<div class="inner-container" style="min-height: 283px;">
    <div class="sign-up-container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}" class="res-email">
            @csrf
            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Email">
            <div class="submit-signup-btn">
                <input type="submit" value="Отправить ссылку на сброс пароля" />
            </div>
        </form>
        @include('errors')  
    </div>
</div>
@endsection
