@extends('layouts.layout')

@section('container')
<div class="container mob_container" style="background-image: url(images/bg-reg.jpg);">
@endsection
@section('content')
<div class="inner-container saf_inner">
        <div class="sign-up-container">
            <div class="sign-up-title">Вход</div>
            <form method="POST" action="{{ route('login') }}" class="sign-in-container">
                @csrf
                <input type="text" name="tel_number" readonly class="{{$errors->has('tel_number') ? 'is-danger' : ''}}" onfocus="if (this.hasAttribute('readonly')) { this.removeAttribute('readonly');
                this.blur();this.focus();  }" value="{{ old('tel_number') }}" required id="tel_number" placeholder="Телефон" />
                <input type="password" name="password" minlength="6" required id="password" placeholder="Введите пароль"/>
                <div class="submit-signup-btn">
                    <input type="submit" value="Войти" />
                </div>
                @if (Route::has('password.request'))
                <div class="submit-signup-btn">
                    <a class="forgot_pasw" href="{{ route('password.request') }}">
                        Забыли пароль?
                     </a>
                </div>
                @endif

                @include('errors')

            </form>
        </div>
    </div>
</div>
@endsection
