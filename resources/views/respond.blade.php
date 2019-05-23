@extends('layouts.layout')

@section('container')
<div class="container cont_and" style="background-image: url({{ asset('images/index2.jpg') }});">
@endsection

@section('content')
<div class="inner-container tablet">
        <div class="respond-container">
                <div class="table table-header respond-header resp-table">
                        <div class="inner-table-elements">
                          <p>Название</p>
                        </div>
                        <div class="inner-table-elements">
                          <p>Заработная плата</p>
                        </div>
                        <div class="inner-table-elements">
                          <p>Тел.Работодателя</p>
                        </div>
                        <div class="inner-table-elements">
                          <p>Статус</p>
                        </div>
                </div>
                @if ($responds->count())
                @foreach ($responds as $respond)
                <div class="table resp-table">
                        <div class="inner-table-elements">
                            <a href="/job_info/{{$respond->job_id}}">{{$respond->title}}</a>
                        </div>
                        <div class="inner-table-elements">
                          <p>{{number_format($respond->cost, 0, '.', ' ')}} KZT</p>
                        </div>
                        @if ($respond->status==1)
                        <div class="inner-table-elements">
                          <p>{{$respond->tel_number}}</p>
                        </div>
                        <div class="inner-table-elements">
                          <p>Вы наняты</p>
                        </div>
                        @else 
                        <div class="inner-table-elements">
                          <p></p>
                        </div>
                        <div class="inner-table-elements">
                            <p>Ждите ответа</p>
                        </div>
                        @endif
                </div>
                @endforeach  
                @else
                <div class="table">
                        <p>Вы еще не откликались ни на одну заявку</p>        
                </div> 
                @endif
        </div>
    </div>
    </div>
@endsection