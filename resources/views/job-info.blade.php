@extends('layouts.layout')

@section('container')
<div class="container">
@endsection

@section('content')
<div class="job-info-container">
    <span id="notification">Адрес скопирован</span>
        <div class="job-info-text" id="app">
          <p>{{$job->title}}</p>
          <p class="info-simple-text">{{number_format($job->cost, 0, '.', ' ')}} KZT</p>
          <p class="info-simple-text"><span>Категория:</span> {{$job->category}}</p>
          <p class="info-simple-text">
            <span>Необходимое количество людей:</span> {{$job->num_persons}}
          </p>
          <p class="info-simple-text">
            <span>Срок:</span>с {{strftime("%d %b. %Y", strtotime($job->start_date))}} до {{strftime("%d %b. %Y", strtotime($job->final_date))}} 
            ({{$job->deadline}} дн.)
          </p>
          <p class="job-info-description">
              {{$job->description}}
          </p>
          <p class="info-simple-text" style="display:flex;">
            <i class="far fa-dot-circle"></i>
            <span>Адрес:</span> {{$job->region}}, {{$job->address}} 
            <span id="message" style="display:none;">Казахстан, Алматы, {{$job->address}}</span>
            <button class="copy_btn" title="Скопировать адрес" onclick="copyToClipboard('message')">
              <i class="fas fa-copy"></i>
            </button>
          </p>
          <p class="info-simple-text"><span>Заказчик:</span>{{$owner->name}}</p>

          @if (Auth::check())
            @if (Auth::user()->id != $job->owner_id)

            <job-send-component :jobid="{{$job->id}}"></job-send-component>

            @endif
          @else 
            <div style="width: 18%;">
              <button class="send_offer" onClick="window.location.href='{{ route('register') }}'">Откликнуться</button>
            </div>
          @endif
          <p class="info-publick-date">Опубликована {{strftime("%d %b. %Y", strtotime($job->created_at))}}</p>
        </div>
        
        <div class="map_yan">
          <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A60b893c005acaf1fdcde8d2f97f78c73df3f6ca184568425126b985a2c8aa555&amp;width=100%&amp;height=437&amp;lang=ru_RU&amp;scroll=true"></script>
        </div>
	
		<div class="map_yan_and">
			<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A60b893c005acaf1fdcde8d2f97f78c73df3f6ca184568425126b985a2c8aa555&amp;source=constructor" width="320" height="450" frameborder="0"></iframe> 
        </div>

      </div>
    </div>
@endsection