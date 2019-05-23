@extends('layouts.layout')

@section('container')
<div class="container" style="background-image: url({{ asset('images/index2.jpg') }});">
@endsection

@section('content')
<div class="inner-container mob-display">
        <p class="header-text">
          Нанимайте лучших специалистов для<br />
          решения любых бытовых задач
        </p>
        <div class="to-offer">
            @if (Auth::check())
              <a href="/create_job"><i class="fas fa-briefcase"></i>Предложить работу</a>
            @else
              <a href="{{ route('register') }}"><i class="fas fa-briefcase"></i>Предложить работу</a>
            @endif
          <a href="#job-container" id="scroll-to-jobs"><i class="fas fa-search"></i>Найти работу</a>
        </div>
      </div>
</div>
<div class="container">
    <div class="block-container inner-container">
        <div class="block">
          <div class="block-image"><img src="images/time.png" /></div>
          <div class="block-title">Быстро</div>
          <div class="block-description">
            Просто укажите детали работы и получите отклики заинтересованных
            специалистов
          </div>
        </div>
        <div class="block">
          <div class="block-image"><img src="images/defence.png" /></div>
          <div class="block-title">Надежно</div>
          <div class="block-description">
            Все специалисты проходят специальную проверку, поэтому с вами не
            свяжется сомнительная личность
          </div>
        </div>
        <div class="block">
          <div class="block-image"><img src="images/money.png" /></div>
          <div class="block-title">Выгодно</div>
          <div class="block-description">
            Предлагайте свой бюджет специалистам или выберите из предложенных
            вариантов в откликах и наслождайтесь своей жизнью
          </div>
        </div>
      </div>
</div>
<div class="container" id="job-container">
  <div class="media-filtr-btn" id="flip">Фильтр</div>
  <div class="inner-container inline-job">
  <div class="filtr-container" id="panel">
    <form action="/filter">
      <div class="filtr-row">
        <label for="category">Категория:</label>
        @include('category')
      </div>
      <div class="filtr-row">
        <label for="cost">Цена:</label>
        <div class="num-input-container">
            <input type="number" name="cost1" placeholder="От..." />
            &nbsp;&mdash;&nbsp;
            <input type="number" name="cost2" placeholder="До..." />
            &nbsp; тг.
        </div>            
      </div>
      <div class="filtr-row">
        <label for="region">Район:</label>
        @include('region')
      </div>
      <div class="filtr-row">
        <label for="deadline">Срок:</label>
        <div class="num-input-container">
        <input type="number" name="deadline1" id="deadline" placeholder="От..." min="1" />
        &nbsp;&mdash;&nbsp;
        <input type="number" name="deadline2" id="deadline" placeholder="До..." max="31" />
        &nbsp; дня.
      </div>
      </div>
      <div class="filtr-btn"><input type="submit" value="Найти" /></div>
    </form>
  </div>
  <div class="job-container" id="jobs">
      <div class="inner-job-container" id="app">

        @foreach ($jobs as $job)
        @if ($job->status == 1)
          <div class="job">
            <div class="job-row">
              <div class="job-title">
                <a href="/job_info/{{$job->id}}">{{$job->category}}: {{$job->title}}</a>
              </div>
              <div class="job-cost">{{number_format($job->cost, 0, '.', ' ')}} KZT</div>
            </div>
            <div class="job-row grey">
              Необходимое количество людей: {{$job->num_persons}}
            </div>
            <div class="job-row grey">{{$job->region}} район</div>
            <div class="job-row job-date">с {{strftime("%d %b. %Y", strtotime($job->start_date))}} до {{strftime("%d %b. %Y", strtotime($job->final_date))}}</div>
            <div class="job-row job-description">
              <p>{{$job->description}}</p>
            </div>
            <div class="job-offer grey">
                {{strftime("%d %b. %Y", strtotime($job->created_at))}} 

              @if (Auth::check())
                @if (Auth::user()->id != $job->owner_id)
                <keep-alive>
                  <job-send-component :jobid="{{$job->id}}"></job-send-component>
                </keep-alive>
                @endif
              @else 
                <div style="width: 18%;">
                  <button class="send_offer" onClick="window.location.href='{{ route('register') }}'">Откликнуться</button>
                </div>
              @endif
            </div>
          </div> 
        @endif
        @endforeach
        {{$jobs->links()}}
      </div>
    </div>
</div>
</div>
@endsection