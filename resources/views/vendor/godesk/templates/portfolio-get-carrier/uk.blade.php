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
                        <h2>Цільові сторінки, які приносять потенційних клієнтів</h2>
                        <p>Сторінка захоплення потенційного клієнта - це тип цільової сторінки після натискання, що відрізняється оптимізованою формою захоплення потенційних клієнтів. Ця форма дозволяє збирати потенційних клієнтів для відповідних пропозицій та розвивати їх у маркетинговій послідовності.</p>
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
                    <img src="{{ GoDesk::image('portfolio/get-carrier/lead1.png') }}" alt="">
                    <img src="{{ GoDesk::image('portfolio/get-carrier/lead2.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="blockquote section">
        <div class="container">
            <div class="row">
                <div class="offset-md-2 offset-0 col-md-8 col-12">
                    <blockquote class="blockquote">
                        <p class="mb-0">Ми GetCarrier - маркетплейс перевезення автомобільного транспорту. Ми допомагаємо вантажовідправникам отримувати миттєві котирування і ставки на аукціонах від перевізників і брокерів, які користуються рейтингом клієнтів. Нам були потрібні розробники високого рівня, так як завдання були досить складними. В результаті агентство SpaceCode відмінно впорався з поставленими завданнями, всі деталі були дотримані, все виконано на вищому рівні. Окреме спасибі Владлену за ініціативу. Рекомендую цю команду, вони професіонали своєї справи.</p>
                        <footer class="blockquote-footer">
                            <p class="h6">Макс Антонов</p>
                            <small>Співзасновник GetCarrier</small>
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
                        <p>Іконографія може допомогти вам виділити ваш веб-сайт серед конкурентів, а також персоналізувати його та допомогти користувачам правильно переглядати його.</p>
                    </div>
                </div>
                <div class="col-12">
                    <img src="{{ GoDesk::image('portfolio/get-carrier/icons.png') }}" alt="">
                    <img class="color" src="{{ GoDesk::image('portfolio/get-carrier/colors.png') }}" alt="">
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
                        <p>Присутні багато елементів заклику до дії. Різні бібліотеки використовувались для анімації тексту та інших веб-елементів. Завданням було зробити важкі багатоступеневі форми для заповнення лідів.</p>
                    </div>
                </div>
                <div class="col-12">
                    <img src="{{ GoDesk::image('portfolio/get-carrier/header.png') }}" alt="">
                    <img class="no-shadow" src="{{ GoDesk::image('portfolio/get-carrier/faq.png') }}" alt="">
                    <img class="no-shadow" src="{{ GoDesk::image('portfolio/get-carrier/call-to-action.png') }}" alt="">
                    <img src="{{ GoDesk::image('portfolio/get-carrier/footer.png') }}" alt="">
                    <img class="no-shadow" src="{{ GoDesk::image('portfolio/get-carrier/slider.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="full section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-12">
                    <div class="heading">
                        <h2>Більше цільових сторінок</h2>
                        <p>Ми розробили багато цільових сторінок для крутих хлопців з України. Вони задіяні на ринку автомобільних перевезень США. Кожна цільова сторінка є окремим видом послуги.</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="gets">
                        <img class="get1" src="{{ GoDesk::image('portfolio/get-carrier/1.png') }}" alt="">
                        <img class="get2" src="{{ GoDesk::image('portfolio/get-carrier/2.png') }}" alt="">
                        <img class="get3" src="{{ GoDesk::image('portfolio/get-carrier/3.png') }}" alt="">
                    </div>
                </div>
                <div class="col-12">
                    <div class="gets last">
                        <img class="get4" src="{{ GoDesk::image('portfolio/get-carrier/4.png') }}" alt="">
                        <img class="get5" src="{{ GoDesk::image('portfolio/get-carrier/5.png') }}" alt="">
                        <img class="get6" src="{{ GoDesk::image('portfolio/get-carrier/6.png') }}" alt="">
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