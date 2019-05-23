<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Работа, вакансии, подработка в Алматы. Все для работников и работодателей на easyjob.kz</title>
	<meta name="keywords" content="работа, вакансии, работа алматы, поиск вакансий, подработка для школьников, подработка для студентов, подработка алматы, ищу работу">
	<meta name="description" content="EasyJob предоставляет возможность для найма рабочего персонала на краткосрочной перспективе для выполнения определённых типов работ различной квалификации">
    <link rel="shortcut icon" href="{{ asset('images/tie.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pace-theme-center-circle.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
      crossorigin="anonymous" />
    <script src="{{ asset('js/pace.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    @yield('container')

    <header id="header" class="">
            <nav id="nav" class="">
                <div class="logo-container">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="logo" />
                    </a>
                </div>  
                <div class="link-container" id="hide-nav">
                    @guest
                        <div class="sign-container">
                            <a href="/" class="nav-links mob_icons" title="Главная">Главная</a>
                            <a href="{{ route('login') }}" class="nav-links center-it">Войти</a>
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-links center-it">Регистрация</a>
                            @endif
                        </div>
                    @else
                        <div class="nav-profile-container">
                            <a href="/" class="nav-links center-it" title="Главная">Главная</a>
                            <a href="/offers/{{ Auth::user()->id }}" class="nav-links center-it" title="Ваши предложенные работы">Предложения</a>
                            <a href="/responds/{{ Auth::user()->id }}" class="nav-links center-it" title="Ваши отклики">Отклики</a>
                            <a href="/profile/{{ Auth::user()->id }}" class="nav-user-name center-it" title="Ваш профайл">{{ Auth::user()->name }}<i class="fas fa-user-tie"></i></a>
                            <a href="/create_job" class="nav-links center-it mob_link">Предложить работу</a>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="nav-profile-exit center-it">Выйти</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    @endguest
                    <span class="mob_icons first-bas"><i class="fas fa-bars"></i></span>
                </div>                
                <span class="mob_icons"><i class="fas fa-bars"></i></span>
                
                @include('link_check')                

            @if (Auth::check())
                <?php            
                $fill_status = 40;
                if(auth()->user()->email != null){
                    $fill_status+=20;
                }
                if(auth()->user()->date_of_birth != null){
                    $fill_status+=20;
                }
                if(auth()->user()->skills != null){
                    $fill_status+=20;
                }
                ?>
            @endif
            
            </nav>
        </header>

        @yield('content')

        <footer>
            &copy; EasyJob.kz 2018
        </footer>
    <script src="{{ asset('js/script.js') }}"  defer></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"  defer></script>
</body>
</html>