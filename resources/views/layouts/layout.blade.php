<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/auth.css">
    <link rel="icon" href="/image/logo.svg" type="image/x-icon">
    <title>@yield('title')</title>
</head>

<body>
    <header class="navigation">
            <div class="nav-container">
                <div class="brand">
                    <a href="/"><img src="/image/logo.svg" alt="" style="width: 50px; height: 50px;"></a>
                </div>
                <nav>
                    <div class="nav-mobile"><a id="nav-toggle" href="#!"><span></span></a></div>
                    <ul class="nav-list">
                        <li><a href="/menu">Меню</a></li>
                        <li><a href="/about">О нас</a></li>
                        <li><a href="/about#contacts">Контакты</a></li>
                        @if (session('id') !== null)
                        <li><a href="/basket">Корзина</a></li>
                        <li><a href="/profil">Профиль</a></li>
                        <li><a href="/log">Выйти</a></li>
                        @else
                        <li><a href="{{Route('auth')}}"><span class="glyphicon glyphicon-user"></span>Войти</a></li>
                        @endif
                    </ul>
                    <div id="side-menu" class="side-menu">
                        <a href="javascript:void(0)" class="close-btn" id="close-btn">&times;</a>
                        <a href="/menu">Меню</a>
                        <a href="/about">О нас</a>
                        <a href="/about#contacts">Контакты</a>
                        @if (session('id') !== null)
                        <a href="/basket">Корзина</a>
                        <a href="/profil">Профиль</a>
                        <a href="/log">Выйти</a>
                        @else
                        <a href="{{Route('auth')}}"><span class="glyphicon glyphicon-user"></span>Войти</a>
                        @endif
                    </div>
                </nav>
            </div>
    </header>
    <main class="">
        @yield('content')
    </main>
    <main>
        <br><br><br><br>
        <div class="container">
            <footer class="py-3 my-4 foot">
                <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                    <li class="nav-item"><a href="/" class="nav-link px-2 fott">Главная</a></li>
                    <li class="nav-item"><a href="/about" class="nav-link px-2 fott">О нас</a></li>
                    <li class="nav-item"><a href="/menu" class="nav-link px-2 fott">Меню</a></li>
                    @if (session('id') != null)
                    <li class="nav-item"><a href="/profil" class="nav-link px-2 fott">Профиль</a></li>
                    <li class="nav-item"><a href="/basket" class="nav-link px-2 fott">Корзина</a></li>
                    <li class="nav-item"><a href="/userorders" class="nav-link px-2 fott">Заказы</a></li>
                    @else
                    <li class="nav-item"><a href="{{Route('auth')}}" class="nav-link px-2 fott">Войти</a></li>
                    @endif
                </ul>
                <div class="flex">
                    <div>
                        <a class="text-center  text-muted lay-a" href="/konf">Политика конфиденциальности</a>
                        <a class="text-center  text-muted lay-a" href="/sorglas">Пользовательское соглашение</a>
                    </div>
                    <p class="text-center text-muted">&copy; 2024 CoffeBake, Inc</p>

                </div>

            </footer>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>

    @yield('script')
    <script>
       document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('nav-toggle').addEventListener('click', function () {
        document.getElementById('side-menu').style.width = '250px';
    });

    document.getElementById('close-btn').addEventListener('click', function () {
        document.getElementById('side-menu').style.width = '0';
    });

});
    </script>
</body>

</html>
