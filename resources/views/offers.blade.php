@extends('layouts.layout')

@section('container')
<div class="container" style="background-image: url({{ asset('images/index2.jpg') }});min-height: 92vh;">
@endsection

@section('content')
<div class="inner-container tablet offers-inner-container" id="app">
    <div class="job-notify">
        Ваша работа автоматически будет удалена спустя день после ее начала!
    </div>
    @if($jobs->count())
        @foreach ($jobs as $job)
            <div class="offer-container">
                    <div class="table table-header offer-header">
                            <div class="inner-table-elements">
                                <a href="/job_info/{{$job->id}}">{{$job->title}}</a>
                            </div>
                            <div class="action-container">
                              <div class="inner-table-elements">
                                    <a href="/offers/{{Auth::user()->id}}/{{$job->id}}/edit" class="b-res-vis">Редактировать</a>
                                    <a href="/offers/{{Auth::user()->id}}/{{$job->id}}/edit" class="s-res-vis mob-res"><i class="fas fa-pen-square" title="Редактировать"></i></a>
                              </div>
                              <div class="inner-table-elements">
                                    <form action="/offers/{{Auth::user()->id}}/{{$job->id}}/delete" method="POST" class="b-res-vis">
                                        @method('DELETE')
                                        @csrf
                                        <input type="submit" value="Удалить">
                                    </form>
                                    <form action="/offers/{{Auth::user()->id}}/{{$job->id}}/delete" method="POST" class="s-res-vis mob-res">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="delete-job" title="Удалить"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                              </div>
                            </div>
                          </div>

                          <?php $cnt=0; ?>
                          
                        @foreach ($responds as $respond)
                        @if ($respond->job_id == $job->id)
                        <div class="table user-info">
                                <div class="inner-table-elements">
                                  <p>{{$respond->name}}</p>
                                  <keep-alive>
                                    <rating-component :userid="{{$respond->user_id}}"></rating-component>
                                  </keep-alive>
                                  <p class="resp_user_phone">{{$respond->tel_number}}</p>
                                </div>
                                <div class="inner-table-elements">
                                  <p>{{$respond->tel_number}}</p>
                                </div>
                                <div class="inner-table-elements">
                                  <p>
                                        <?php 
                                        if (!empty($respond->date_of_birth)) {
                                            $tmp = explode('-', $respond->date_of_birth);
                                            $old = date('Y')-$tmp[0];
                                            if($old<21 || $old%10>4 || $old%10==0){
                                                echo  $old.' лет';
                                            }
                                            elseif ($old%10==1) {
                                                echo  $old.' год'; 
                                            }
                                            else{
                                                echo  $old.' года';   
                                            }
                                        }
                                    ?> 
                                  </p>
                                </div>
                                <div class="inner-table-elements">
                                  <p>
                                    @if (!empty($respond->skills))
                                      {{$respond->skills}}
                                    @endif
                                  </p>
                                </div>
                                <div class="inner-table-elements offer-vue-comp">
                                  <keep-alive>
                                    <offer-component :respid="{{$respond->id}}" :jobid="{{$job->id}}" :userid="{{$respond->user_id}}"></offer-component>
                                  </keep-alive>
                                </div>
                              </div>
                         <?php $cnt=$cnt+1; ?>     
                        @endif
                    @endforeach
                    @if($cnt==0 && $job->status == 1)
                      <div class="table user-info">
                        <p>Пока на вашу работу никто не откликался</p>
                      </div>
                    @elseif(is_null($job->status))
                      <div class="table user-info">
                        <p>Проверяется модератором</p>
                      </div>
                    @elseif($job->status == 0)
                      <div class="table user-info">
                        <p>Данная работа не прошла модерацию, пожалуйста проверьте корректность данных</p>
                      </div>
                    @endif
            </div>
        @endforeach

        <div class="add-more-job" title="Предложить работу">
            <a href="/create_job"><i class="fas fa-plus"></i></a>
        </div>
    @else
        <div class="not-job">
            Вы пока не предлагали работу
            <a href="/create_job">Предложить Работу</a>
        </div>
    @endif
    
    </div>
    </div>
@endsection