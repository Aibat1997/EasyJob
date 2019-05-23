@extends('layouts.layout')

@section('container')
<div class="container mob_container" style="background-image: url(images/bg-reg.jpg);">
@endsection

@section('content')
<div class="inner-container saf_inner">
        <div class="sign-up-container">
          <div class="sign-up-title">Регистрация</div>
          <form method="POST" action="{{ route('register') }}">
            @csrf
              <input type="text" name="name" value="{{ old('name') }}" id="name" pattern="[a-zA-Z\u0400-\u04ff]{3,30}" required class="{{$errors->has('name') ? 'is-danger' : ''}}" placeholder="Имя" />
              <input type="text" name="tel_number" readonly value="{{ old('tel_number') }}" id="tel_number" class="{{$errors->has('tel_number') ? 'is-danger' : ''}}" placeholder="Телефон" onfocus="if (this.hasAttribute('readonly')) { this.removeAttribute('readonly');
              this.blur();this.focus();  }" />
              <input type="email" name="email" value="{{ old('email') }}" id="email" required class="{{$errors->has('email') ? 'is-danger' : ''}}" placeholder="Email" />
              <input type="password" name="password" required id="password" minlength="6" class="{{$errors->has('password') ? 'is-danger' : ''}}" id="password" placeholder="Введите пароль"/>
              <div class="submit-signup-btn">
                <input type="submit" value="Зарегистрироваться" />
              </div>

            @include('errors')

          </form>
        </div>
      </div>
    </div>
@endsection
