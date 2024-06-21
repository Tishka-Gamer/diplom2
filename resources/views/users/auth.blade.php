@extends('layouts.layout')
@section('title')
Авторизация/Регистрация
@endsection
@section('content')
<div class="body">
    <div class="auth-container" id="auth-container">
        <div class="form-container sign-up-container">
            <form action="{{Route('signup')}}" method="post">
                @csrf
                <h1 class="h1">Создать аккаунт</h1>
                <span>{{isset($error) ? $error : ''}}</span>
                <input type="text" name="name" value="{{isset($name) ? $name : ''}}" minlength="15" placeholder="введите имя" required/>
                <input type="text" name="number" value="{{isset($number) ? $number : ''}}" required placeholder="8xxxxxxxxxx" pattern="^8\d{10}$"/>
                <input type="email" name="email" value="{{isset($email) ? $email : ''}}" placeholder="введите почту" required/>
                <input type="password" name="password" minlength="6" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$" placeholder="введите пароль" required/>
                <span>от 6 символов, буквы из верхнего и нижнего регистра, одну цифру</span>
                <div class="form-check" style="width: 120%; ">
                    <input class="form-check-input" type="checkbox" value="" style="margin-left: -26rem; margin-top: 30px" id="flexCheckDefault">
                    <br>
                    <label class="form-check-label" for="flexCheckDefault">Даю согласие на обработку персональных данных. Ознакомиться с <a href="/konf">политикой конфиденциальности</a>, <a href="/sorglas">пользовательским соглашением</a>
                    </label>
                  </div>
                <button class="button mybtn" id="mybtn" type="submit">Зарегистрироваться</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="{{Route('signin')}}" method="post">
                @csrf
                <span class="error">{{isset($error) ? $error : ''}}</span>
                <h1 class="h1">Авторизация</h1>
                <input type="tel" name="number" value="{{isset($number) ? $number : ''}}" placeholder="8xxxxxxxxxx" required/>
                <input type="password" name="password" placeholder="введите пароль" required/>
                <button class="button">Войти</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="h1">С возвращением!</h1>
                    <p class="p">Чтобы оставаться на связи с нами, пожалуйста, войдите, используя свои личные данные.</p>
                    <button class="ghost button" id="signIn">Войти</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1 class="h1">Привет, друг!</h1>
                    <p class="p">Введите свои личные данные и начните путешествие вместе с нами</p>
                    <button class="ghost button" id="signUp">Зарегистрироваться</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="/js/auth.js"></script>

@endsection
