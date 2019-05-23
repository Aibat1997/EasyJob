@extends('layouts.moderator-layout')

@section('content')
    <div class="inner-container">
        <div class="sign-up-container" style="background-color: #1d242e;">
            <div class="sign-up-title" style="color:#fff;">Войти</div>
            <form method="POST" action="/moderator_side/page_for_login_moderator" class="sign-in-container">
                @csrf
                <input type="text" name="tel_number" readonly class="{{$errors->has('tel_number') ? 'is-danger' : ''}}" onfocus="if (this.hasAttribute('readonly')) { this.removeAttribute('readonly');
                this.blur();this.focus();  }" value="{{ old('tel_number') }}" required id="tel_number" placeholder="Телефон" />
                <input type="password" name="password" minlength="6" required id="password" placeholder="Введите пороль"/>
                <div class="submit-signup-btn">
                    <input type="submit" value="Войти" style="background-color: #1d242e;border:2px solid #fff;" />
                </div>

                @include('errors')

            </form>
        </div>
    </div>
@endsection