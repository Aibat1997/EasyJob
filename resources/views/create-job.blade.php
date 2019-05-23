@extends('layouts.layout')

@section('container')
<div class="container" style="background-image: url({{ asset('images/bg-reg.jpg') }});">
@endsection

@section('content')
<div class="inner-container">
        <div class="create-job-container">
          <div class="create-job-title">Регистрация работы</div>
          <form action="/" method="POST">
            @csrf
            <div class="create-form-left-block">
              <div class="create-form-row">
                <label for="title">Название:</label>
                <input type="text" name="title" id="title" class="{{$errors->has('title') ? 'is-danger' : ''}}" placeholder="Название работы" value="{{ old('title') }}" required />
              </div>
              <div class="create-form-row">
                <label for="description" class="description">Описание:</label>
                <textarea name="description" required class="{{$errors->has('description') ? 'is-danger' : ''}}" id="description" cols="35" rows="8"
                  placeholder="Опишите работу">{{ old('description') }}</textarea>
              </div>
              <div class="create-form-row">
                <label for="category">Категория:</label>
                @include('category')
              </div>

              <div class="create-form-row">
                <label for="num_person">Кол-во работников:</label>
                <input type="number" name="num_persons" value="{{ old('num_persons') }}" class="{{$errors->has('num_persons') ? 'is-danger' : ''}}" required id="num_person" placeholder="Кол-во работников" />
                <span>чел</span>
              </div>
            </div>
            <div class="create-form-right-block">
              <div class="create-form-row">
                <label for="region">Район:</label>
                @include('region')
              </div>

              <div class="create-form-row">
                <label for="address">Адрес:</label>
                <input type="text" name="address" value="{{ old('address') }}" class="{{$errors->has('address') ? 'is-danger' : ''}}" required id="address" placeholder="Адрес" />
              </div>

              <div class="create-form-row">
                <label for="start-date">Начало:</label>
                <input type="text" name="start_date" value="{{ old('start_date') }}" class="{{$errors->has('start_date') ? 'is-danger' : ''}}" required id="start-date" placeholder="00/00/0000" />
              </div>

              <div class="create-form-row">
                <label for="final_date">Окончание:</label>
                <input type="text" name="final_date" value="{{ old('final_date') }}" class="{{$errors->has('final_date') ? 'is-danger' : ''}}" required id="final_date" placeholder="00/00/0000" />
              </div>
              <div class="create-form-row">
                <label for="cost">Стоимость:</label>
                <input type="text" name="cost" value="{{ old('cost') }}" required class="{{$errors->has('cost') ? 'is-danger' : ''}}" id="cost" placeholder="Стоимость" />
                <span>тг</span>
              </div>
            </div>
            <div class="submit-create-btn">
              <input type="submit" value="Опубликовать" />
            </div>

            @include('errors')

          </form>
        </div>
      </div>
    </div>
@endsection