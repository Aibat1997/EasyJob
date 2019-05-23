@extends('layouts.moderator-layout')

@section('content')
  <div class="inner-container">
    <div class="sign-up-container" style="background-color: #1d242e;">
      <div class="sign-up-title" style="color:#fff;">Регистрация</div>
      <form method="POST" action="/moderator_side/page_for_register_moderator">
        @csrf
        <input type="text" name="tel_number" readonly value="{{ old('tel_number') }}" id="tel_number" class="{{$errors->has('tel_number') ? 'is-danger' : ''}}" placeholder="Телефон" onfocus="if (this.hasAttribute('readonly')) { this.removeAttribute('readonly');
        this.blur();this.focus();  }" />
        <input type="password" name="password" required id="password" minlength="6" class="{{$errors->has('password') ? 'is-danger' : ''}}" id="password" placeholder="Введите пароль"/>
          <div class="submit-signup-btn">
            <input type="submit" value="Зарегистрироваться" style="background-color: #1d242e;border:2px solid #fff;" />
          </div>

        @include('errors')
        
        <div>
        @if (isset($error_check))
            <p style="color:#fff;">{{$error_check}}</p>
        @endif  
        </div>
      </form>
    </div>
  </div>
  @endsection