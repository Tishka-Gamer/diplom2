<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/admin.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div>

        <div class="adm-cont">
            <form action="{{Route('admin')}}" method="POST" class="adm-flex">
                <h3 class="text-center">Вход в панель администратора</h3>
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label adm-p">Логин</label>
                    <input type="text" class="form-control"  name="name" id="name">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label adm-p">Пароль</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" name="btn" class="btn adm-p">Войти</button>
            </form>
        </div>
    </div>

</body>
</html>

