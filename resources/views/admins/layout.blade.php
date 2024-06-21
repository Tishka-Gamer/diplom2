<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
    crossorigin="anonymous">
    <link rel="stylesheet" href="/css/admin.css">
    <title>@yield('title')</title>
</head>
<body>
    <div class="lau-cont">
        <div class="lau-div">
            <ul class="lau-ul">
                <li><a href="/product">Продукты</a></li>
                <li><a href="/category">Категории</a></li>
                <li><a href="/ingridients">Ингридиенты</a></li>
                <li><a href="/allingprod">Ингридиенты в продуктах</a></li>
                <li><a href="/admorders">Заказы</a></li>
                <li><a href="/reviewadm">Отзывы</a></li>
                <li><a href="/user">Пользователи</a></li>
                <li><a href="/status">Статус</a></li>
                <li><a href="/admins">Админы</a></li>
                <li><a href="/currents">Актуальное</a></li>
                <li><a href="/milks">Молоко</a></li>
                <li><a href="/aexit">Выход</a></li>
            </ul>
        </div>
        <div>
            <br><br>
            @yield('content')
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

      @yield('script')
    </body>
    </html>

