@extends('layouts.moderator-layout')

@section('content')
@if (session()->has('moderator'))

<header style="background-color:#1d242e;">
    <nav style="display:flex;justify-content:flex-end;">
        <a href="/moderator_side/page_for_login_moderator" class="moder_exit">Выход</a>
    </nav>
</header>
<div class="container" id="app" style="background-color: rgba(45,62,92, 0.6);min-height: 100vh;">
    <div class="inner-container" style="padding-top:5%;">
        @foreach ($jobs as $job)
         <moderator-component :jobid="{{$job->id}}"></moderator-component>
        @endforeach        
    </div>
</div>

@endif
@endsection