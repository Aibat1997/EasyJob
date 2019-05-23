@if ($_SERVER['REQUEST_URI'] == '/' || stripos($_SERVER['REQUEST_URI'], '/filter') !== false)
    <span class="mob_icons"><i class="fas fa-sliders-h flip"></i></span>
@endif
@if ($_SERVER['REQUEST_URI'] == '/create_job')
    <span class="mob_icons mob_link_text">Предложить работу</span>
@endif
@if ($_SERVER['REQUEST_URI'] == '/login')
    <span class="mob_icons mob_link_text">Вход</span>
@endif
@if ($_SERVER['REQUEST_URI'] == '/register')
    <span class="mob_icons mob_link_text">Регистрация</span>
@endif
@if (stripos($_SERVER['REQUEST_URI'], '/profile') !== false)
    <span class="mob_icons mob_link_text">Профиль</span>
@endif
@if (stripos($_SERVER['REQUEST_URI'], '/edit') !== false)
    <span class="mob_icons mob_link_text">Редактировать</span>
@elseif (stripos($_SERVER['REQUEST_URI'], '/offers') !== false)
    <span class="mob_icons mob_link_text">Предложения</span>
@endif
@if (stripos($_SERVER['REQUEST_URI'], '/responds') !== false)
    <span class="mob_icons mob_link_text">Отклики</span>
@endif