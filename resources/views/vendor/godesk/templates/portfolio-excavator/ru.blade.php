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
                        <h2>Отличный сайт для строительства и ремонта зданий</h2>
                        <p>Наши возможности дают нам свободу реализации проектов различного масштаба. От небольших личных проектов до таких мегасайтов.</p>
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
                        <p class="mb-0">Заказал услугу разработки сайта. После подачи заявки с нами оперативно связались и уточнили все вопросы. Эксперты оценили объем работы и цену, после чего приступили к работе. Все сделали максимально качественно и быстро. Мы очень рады, что у нас есть этот сайт!</p>
                        <footer class="blockquote-footer">
                            <p class="h6">Джорджио Томсон</p>
                            <small>Исполнительный директор</small>
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
                        <p>При разработке веб-сайтов о строительстве часто используются цвета внимания. Также распространенной практикой является использование контраста. Мы решили отойти от правил и совместили строгие формы с пастельными тонами.</p>
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
                        <h2>Элементы</h2>
                        <p>Обратите внимание на выбор шрифта. Он подчеркивает сложность работы, которую выполняет эта компания. Геометрические формы, используемые в элементах, подчеркивают определенные моменты.</p>
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
                        <h2>Полный просмотр проекта</h2>
                        <p>Мы стремимся разрабатывать лучшие веб-сайты и менять мир к лучшему - С уважением, команда SpaceCode!</p>
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