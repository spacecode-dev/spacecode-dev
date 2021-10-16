@include('godesk::index.inc.slot')
@extends('godesk::index.index')
@section('content')
    <div class="banner section" style="background: {!! $entity->variables->heading_color !!}">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h1 class="{{ isset($entity->variables->text_color) ? 'text-' . $entity->variables->text_color : null  }}">{{ $entity->title }}</h1>
                    <p class="{{ isset($entity->variables->text_color) ? 'text-' . $entity->variables->text_color : null  }}">{!! $entity->excerpt !!}</p>
                </div>
                <div class="col-6 d-md-block d-none">
                    <img src="{{ $entity->thumbnail }}" class="card-img-top" alt="{{ $entity->title }}">
                </div>
            </div>
        </div>
    </div>
    <div class="about section">
        <div class="container">
            <div class="row">
                <div class="offset-lg-6 offset-0 col-lg-6 col-12">
                    <div class="heading">
                        <h2>Чудовий веб-сайт для будівництва та реконструкції будівель</h2>
                        <p>Наші можливості дають нам свободу виконання проекту різного розміру. Від невеликих особистих проектів до таких мега-сайтів, як цей.</p>
                        <ul>
                            @foreach(['web-design', 'frontend', 'backend', 'web'] as $service)
                                <li>
                                    <img src="{{ GoDesk::image('website/' . $service . '.png') }}" alt="{{$service}}">
                                    <p>{{ __(\Illuminate\Support\Str::title(\Illuminate\Support\Str::of($service)->replace('-', ' '))) }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="image section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <img src="{{ GoDesk::image('portfolio/excavator/banner1.png') }}" alt="">
                    <img src="{{ GoDesk::image('portfolio/excavator/banner2.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="blockquote section">
        <div class="container">
            <div class="row">
                <div class="offset-md-2 offset-0 col-md-8 col-12">
                    <blockquote class="blockquote">
                        <p class="mb-0">Замовив послугу розробки веб-сайтів. Після подання заявки до нас швидко зв'язались і роз’яснили всі питання. Експерти оцінили обсяг роботи та ціну, а потім приступили до роботи. Вони зробили все максимально ефективно і швидко. Ми дуже раді цьому веб-сайту!</p>
                        <footer class="blockquote-footer">
                            <p class="h6">Джорджио Томсон</p>
                            <small>Виконавчий директор</small>
                        </footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
    <div class="design section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-12">
                    <div class="heading">
                        <h2 class="h1">Дизайн система</h2>
                        <p>При розробці веб-сайтів про будівництво часто використовують кольори уваги. Також звичайною практикою є використання контрасту. Ми вирішили відійти від правил і поєднали строгі форми з пастельними тонами.</p>
                    </div>
                </div>
                <div class="col-12">
                    <img src="{{ GoDesk::image('portfolio/excavator/service.png') }}" alt="">
                    <img class="color" src="{{ GoDesk::image('portfolio/excavator/colors.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="elements section-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-12">
                    <div class="heading">
                        <h2>Елементи</h2>
                        <p>Зверніть увагу на вибір шрифту. Він наголошує на складності роботи, яку виконує ця компанія. Геометричні фігури, використані в елементах, підкреслюють певні моменти.</p>
                    </div>
                </div>
                <div class="col-12">
                    <img class="no-shadow" src="{{ GoDesk::image('portfolio/excavator/who.png') }}" alt="">
                    <img class="no-shadow" src="{{ GoDesk::image('portfolio/excavator/clients.png') }}" alt="">
                    <img class="no-shadow" src="{{ GoDesk::image('portfolio/excavator/qoute.png') }}" alt="">
                    <img class="no-shadow" src="{{ GoDesk::image('portfolio/excavator/news.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="full section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-12">
                    <div class="heading">
                        <h2>Повний перегляд проекту</h2>
                        <p>Ми прагнемо розробляти кращі веб-сайти та робити щось у світі - найкраща команда SpaceCode!</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="gets">
                        <img class="get1" src="{{ GoDesk::image('portfolio/excavator/1.png') }}" alt="">
                        <img class="get2" src="{{ GoDesk::image('portfolio/excavator/2.png') }}" alt="">
                    </div>
                </div>
                <div class="col-12">
                    <div class="gets last">
                        <img class="get4" src="{{ GoDesk::image('portfolio/excavator/3.png') }}" alt="">
                        <img class="get4" src="{{ GoDesk::image('portfolio/excavator/4.png') }}" alt="">
                        <img class="get5" src="{{ GoDesk::image('portfolio/excavator/5.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('godesk-index::add.portfolio.relative')
@stop

@section('css')
    {{----}}
@stop

@section('js')
    {{----}}
@stop