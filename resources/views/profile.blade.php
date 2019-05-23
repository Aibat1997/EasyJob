@extends('layouts.layout')

@section('container')
<div class="container tab_size" style="background-image: url({{ asset('images/profile.jpg') }});padding-bottom: 0;">
@endsection

@section('content')
<div class="inner-container tab_marg" id="app">
    <div class="inner-profile-container">
        
        <div class="user-info-container">
            <p>{{Auth::user()->name}}</p>
            <p>Email: {{ empty(Auth::user()->email) ? 'Заполните email' : Auth::user()->email}}</p>
            <p>Дата рождения: {{ empty(Auth::user()->date_of_birth) ? 'Заполните дату рождения' : strftime("%d %b. %Y", strtotime(Auth::user()->date_of_birth))}}</p>
            <p>Мобильный телефон: {{Auth::user()->tel_number}}</p>
            <p>Навыки: {{ empty(Auth::user()->skills) ? 'Заполните навыки' : Auth::user()->skills}}</p>
            @if ($star != null)
              <keep-alive>
                <rating-component :userid="{{Auth::user()->id}}"></rating-component>
              </keep-alive>
            @endif
          </div>
        <div class="profile-edit-container">
            <div class="profile-edit-title">Редактировать</div>
            <form action="/profile/{{Auth::user()->id}}" method="POST" class="reg-form">
              @method('PATCH')
              @csrf
              <div class="profile-edit-row">
                <label for="name">Имя:<span>*</span></label>
                <input type="text" name="name" value="{{Auth::user()->name}}" pattern="[a-zA-Z\u0400-\u04ff]{3,30}" class="{{$errors->has('name') ? 'is-danger' : ''}}" required id="name" placeholder="Введите Фамилию и Имя" />
              </div>
              <div class="profile-edit-row">
                <label for="email">Email:<span>*</span></label>
                <input type="email" name="email" value="{{Auth::user()->email}}" class="{{$errors->has('email') ? 'is-danger' : ''}}" required id="email" placeholder="пример@gmail.com" />
              </div>
              <div class="profile-edit-row">
                <label for="birthday">Дата рождения:<span>*</span></label>
                <input type="text" name="date_of_birth" class="{{$errors->has('date_of_birth') ? 'is-danger' : ''}}" required id="birthday" placeholder="00/00/0000" />
              </div>
              <div class="profile-edit-row">
                <label for="phone">Тел. номер:<span>*</span></label>
                <input type="tel" name="tel_number" value="{{Auth::user()->tel_number}}" class="{{$errors->has('tel_number') ? 'is-danger' : ''}}" required id="tel_number" placeholder="8(777)000-00-00" />
              </div>
              <div class="profile-edit-row">
                <label for="skills" class="description">Навыки:</label>
                <textarea name="skills" id="skills2" cols="35" rows="8">{{Auth::user()->skills}}</textarea>
              </div>
              <div class="submit-profile-edit-btn">
                <input type="submit" value="Готово" style="width:45%;" />
              </div>

              @include('errors')

            </form>
        </div>
    </div>
</div>
</div>
@endsection