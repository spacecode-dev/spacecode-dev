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
                        <h2>Веб-сайт смачної та здорової їжі</h2>
                        <p>Зустріньте наш новий веб-сайт ресторану, розроблений з любов'ю та набагато вибором їжі.</p>
                        <ul>
                            @foreach(['web-design', 'iconography', 'frontend', 'backend', 'web'] as $service)
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
                    <img src="{{ GoDesk::image('portfolio/menu24/banner1.png') }}" alt="">
                    <img src="{{ GoDesk::image('portfolio/menu24/banner2.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="blockquote section">
        <div class="container">
            <div class="row">
                <div class="offset-md-2 offset-0 col-md-8 col-12">
                    <blockquote class="blockquote">
                        <p class="mb-0">Ми попросили відійти від правил і кольорів веб-сайтів про харчування. Керівництво бажало чогось лаконічного та спокійного, відтінків, які сприймали б відвідувачі спокійніше. Результат дуже порадував, а якість розробки просто здивувало. Дякуємо за ваш рівень обслуговування.</p>
                        <footer class="blockquote-footer">
                            <p class="h6">Марі Адкінс</p>
                            <small>Креативний директор Menu24</small>
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
                        <p>В основі веб-дизайну лежить бажання смачно поїсти. Зелений колір був обраний не даремно, він говорить про те, що вся їжа здорова і дуже апетитна.</p>
                    </div>
                </div>
                <div class="col-12">
                    <img src="{{ GoDesk::image('portfolio/menu24/plates.png') }}" alt="">
                    <img class="color" src="{{ GoDesk::image('portfolio/menu24/colors.png') }}" alt="">
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
                        <p>Зверніть увагу на контраст кольорів. Це дуже незвичний підхід для такого типу веб-сайтів, оскільки нам довелося поєднати два дуже важливі для клієнта моменти: здоров'я та користь. Абсолютно все говорить одне - смачна їжа.</p>
                    </div>
                </div>
                <div class="col-12">
                    <img class="no-shadow" src="{{ GoDesk::image('portfolio/menu24/menu.png') }}" alt="">
                    <img class="no-shadow" src="{{ GoDesk::image('portfolio/menu24/chiefs.png') }}" alt="">
                    <img class="no-shadow" src="{{ GoDesk::image('portfolio/menu24/faq.png') }}" alt="">
                    <img class="no-shadow" src="{{ GoDesk::image('portfolio/menu24/action.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="full section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-12">
                    <div class="heading">
                        <h2>Подивіться на інші сторінки веб-сайту</h2>
                        <p>Користуючись негативним простором у поєднанні з прекрасним новим інтерфейсом, ми дозволяємо продукту говорити самому за себе. Показ простоти та інноваційності у всіх аспектах - від зручності використання до ціноутворення.</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="gets">
                        <img class="get1" src="{{ GoDesk::image('portfolio/menu24/1.png') }}" alt="">
                        <img class="get2" src="{{ GoDesk::image('portfolio/menu24/2.png') }}" alt="">
                    </div>
                </div>
                <div class="col-12">
                    <div class="gets last">
                        <img class="get4" src="{{ GoDesk::image('portfolio/menu24/3.png') }}" alt="">
                        <img class="get5" src="{{ GoDesk::image('portfolio/menu24/4.png') }}" alt="">
                        <img class="get6" src="{{ GoDesk::image('portfolio/menu24/5.png') }}" alt="">
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