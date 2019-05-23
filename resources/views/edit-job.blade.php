@extends('layouts.layout')

@section('container')
<div class="container" style="background-image: url({{ asset('images/bg-reg.jpg') }});">
@endsection

@section('content')
<div class="inner-container">
        <div class="create-job-container">
                <div class="create-job-title">Редактирование работы</div>
                <form action="/job_info/{{$job->id}}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="create-form-left-block">
                      <div class="create-form-row">
                        <label for="title">Название:</label>
                        <input type="text" name="title" value="{{$job->title}}" id="title" placeholder="Укладка кафеля" required/>
                      </div>
                      <div class="create-form-row">
                        <label for="description" class="description">Описание:</label>
                        <textarea name="description" id="description" cols="35" rows="8" placeholder="Положить кафель площадью 50квм" required>{{$job->description}}</textarea>
                      </div>
                      <div class="create-form-row">
                        <label for="category">Категория:</label>
                        @include('category')
                      </div>
          
                      <div class="create-form-row">
                        <label for="num_person">Кол-во работников:</label>
                        <input type="number" name="num_persons" value="{{$job->num_persons}}" id="num_person" placeholder="3 чел." required />
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
                        <input type="text" name="address" value="{{$job->address}}" id="address" placeholder="Аль-Фараби 134А" required />
                      </div>
          
                      <div class="create-form-row">
                        <label for="start-date">Начало:</label>
                        <input type="text" name="start_date" value="{{date("d/m/Y", strtotime($job->start_date))}}" id="start-date" required />
                      </div>
          
                      <div class="create-form-row">
                        <label for="final_date">Окончание:</label>
                        <input type="text" name="final_date" value="{{date("d/m/Y", strtotime($job->final_date))}}" id="final_date" required />
                      </div>
                      <div class="create-form-row">
                        <label for="cost">Стоимость:</label>
                        <input type="text" name="cost" value="{{$job->cost}}" id="cost" placeholder="25000" required />
                        <span>тг</span>
                      </div>
                    </div>
                  <div class="submit-create-btn">
                    <input type="submit" value="Готово" />
                  </div>
                </form>
        </div>
    </div>
</div>
@endsection