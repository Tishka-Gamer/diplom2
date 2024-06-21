@extends('layouts.layout')
@section('title')
Главная
@endsection
@section('content')
<div>
    <div>
        <div class="about-about">
            <div>
                <img src="/image/15.png" alt="" width="300px" height="300px">
            </div>
            <br>
            <div>
                <h1 class="index-h1">О нас</h1>
                <p class="about-pp index-p">Добро пожаловать в мир CoffeBake, где аромат свежеиспеченного хлеба сливается с бодрящим запахом свежесваренного кофе. Мы - не просто кофейня, а настоящая пекарня, где каждый день создаются уникальные сочетания вкуса и атмосферы. Наша цель - подарить вам моменты уюта, вдохновения и радости в каждой чашке и каждом кусочке выпечки.</p>
            </div>
            <br>

        </div>
    </div>
    <br>
    <h1 class="index-h1">Добро пожаловать в CoffeBake: Ваш уютный уголок наслаждения</h1>
    <div class="index-grid">
        <div>
            <img class="about-img" src="/image/image3.jpg" alt="">
        </div>
        <div>
            <p class="index-p grid-p">Мы – команда людей, увлеченных искусством кофе и выпечки. Наша страсть к созданию уникальных и неповторимых вкусовых композиций вдохновляет нас каждый день. Мы верим, что настоящее удовольствие начинается с качественных ингредиентов, именно поэтому мы тщательно отбираем каждый компонент наших блюд и напитков.</p>
        </div>
    </div>
    <div>
        <h1 class="index-h1">Что говорят наши постоянные клиенты?</h1>
        <br>
        <div class="about-cards">
            <div class="about-card">
                <img src="/image/17.jfif"  width="400px" height="500px"alt="">
                <p>Когда мои внуки привели меня в CoffeBake, я была приятно удивлена теплой атмосферой и прекрасным обслуживанием. Мы заказали различные круассаны и пирожные, и я должна признаться, что это одни из лучших, что я когда-либо пробовала! Все блюда были свежими и невероятно вкусными. Теперь CoffeBake - мое любимое место для встреч со внуками.</p>
            </div>
            <div class="about-card">
                <img src="/image/16.jfif" width="400px" height="500px" alt="">
                <p>Я долгое время искал место, где можно насладиться хорошим кофе и вкусной выпечкой. Когда я впервые попал в CoffeBake, я сразу почувствовал уют и теплоту этого места. Их кофе просто потрясающий, а аромат свежеиспеченного хлеба привлекает с первого взгляда. Я стал постоянным клиентом, и каждое утро начинаю с чашечки кофе из CoffeBake. Очень рекомендую</p>
            </div>
            <div class="about-card">
                <img src="/image/18.jfif" width="400px" style="margin-top: -35px" height="500px" alt="">
                <p>Я просто обожаю атмосферу в CoffeBake! Это место, где я могу выпить свой любимый кофе и насладиться вкусной выпечкой в компании друзей. Их кофе превосходен, особенно мне нравится капучино с корицей. А выбор выпечки просто поражает - всегда есть что-то новенькое и интересное. Однозначно мое любимое место для встреч и отдыха!</p>
            </div>
        </div>
    </div>
    <br>
    <div id="contacts" class="about-contact" >
        <img src="/image/Frame 8.png"  alt="Frame 8.png">
    </div>
    {{-- <div>
        <div id="carousel" class="carousel">
            <button class="arrow prev">⇦</button>
            <div class="gallery">
              <ul>
                <li><img src="/image/20.jpg" alt="Image 4"></li>
                <li><img src="/image/1.jpg" alt="Image 1"></li>
                <li><img src="/image/2.jpg" alt="Image 2"></li>
                <li><img src="/image/3.jpg" alt="Image 3"></li>
                <li><img src="/image/11.jfif" alt="Image 4"></li>
              </ul>
            </div>
            <button class="arrow next">⇨</button>
          </div>
        {{-- <div class="carousel">
            <div class="carousel-frame">
                <div class="carousel-inner">





                    <!-- добавьте дополнительные изображения по необходимости -->
                </div>
            </div>
            <button class="prev abutton">Назад</button>
            <button class="next abutton">Вперед</button>
        </div>
    </div> --}}
</div>
@endsection
@section('script')
<script src="/js/carusel.js"></script>

@endsection
