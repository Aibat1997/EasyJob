@extends('layouts.layout')

@section('container')
    <div class="container" style="background-image: url({{ asset('images/two2.jpg') }});">
@endsection

@section('content')
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
                            <input type="number" name="cost1" value="{{request()->cost1}}" placeholder="От..." />
                            &nbsp;&mdash;&nbsp;
                            <input type="number" name="cost2" value="{{request()->cost2}}" placeholder="До..." />
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
                            <input type="number" name="deadline1" id="deadline" value="{{request()->deadline1}}" placeholder="От..." min="1" />
                            &nbsp;&mdash;&nbsp;
                            <input type="number" name="deadline2" id="deadline" value="{{request()->deadline2}}" placeholder="До..." max="31" />
                            &nbsp; дня.
                        </div>
                    </div>
                    <div class="filtr-btn"><input type="submit" value="Найти" /></div>
                </form>
            </div>
            <div class="job-container" id="jobs">
                <div class="inner-job-container" id="app">
					<?php $count = 0; ?>
                    @if (count($jobs) == 0)
                        <div class="job-notify">По вашему запросу ничего не найдено</div>
                    @endif
                    @foreach ($jobs as $job)
                    @if ($job->status == 1)
					<?php $count++; ?>
                        <div class="job">
                            <div class="job-row">
                                <div class="job-title">
                                    <a href="/job_info/{{$job->id}}">{{$job->category}}: {{$job->title}}</a>
                                </div>
                                <div class="job-cost">{{number_format($job->cost, 0, '.', ' ')}} KZT</div>
                            </div>
                            <div class="job-row grey">
                                Необходимое количество людей:{{$job->num_persons}}
                            </div>
                            <div class="job-row grey">{{$job->region}}</div>
                            <div class="job-row job-date">с {{strftime("%d %b. %Y", strtotime($job->start_date))}} до {{strftime("%d %b. %Y", strtotime($job->final_date))}}</div>
                            <div class="job-row job-description">
                                <p>{{$job->description}}</p>
                            </div>
                            <div class="job-offer grey">
                                {{strftime("%d %b. %Y", strtotime($job->created_at))}}
                                
                                @if (Auth::check())
                                    @if (Auth::user()->id != $job->owner_id)

                                        <job-send-component :jobid="{{$job->id}}"></job-send-component>

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
					@if ($count == 0 && count($jobs) != 0)
                        <div class="job-notify">По вашему запросу ничего не найдено</div>
                    @endif
                    {{$jobs->links()}}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection