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
                        <h2>Якісне пошиття одягу під рукою</h2>
                        <p>Сучасні виробничі компанії стають дедалі більше інноваційними і покладаються на сучасні технології. Процес створення професійного веб-сайту доводить, що компанія також виходить за межі виробничого заводу за допомогою інновацій.</p>
                        <ul>
                            @foreach(['frontend', 'backend', 'web'] as $service)
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
                    <img src="{{ GoDesk::image('portfolio/tailor/banner1.png') }}" alt="">
                    <img src="{{ GoDesk::image('portfolio/tailor/banner2.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="blockquote section">
        <div class="container">
            <div class="row">
                <div class="offset-md-2 offset-0 col-md-8 col-12">
                    <blockquote class="blockquote">
                        <p class="mb-0">Нам знадобився веб-сайт виробничого заводу, який відображає характер конкретного пошивного виробництва. Завдяки глибоким дослідженням нам вдалося відобразити характер роботи, який видно на кожному кроці. І ми хотіли знайти веб-розробника, який правильно зробив для нас веб-сайт. Колектив SpaceCode глибоко розуміючи процеси, допоміг нам створити сучасний та професійний веб-сайт, що представляє інформацію, необхідну для потенційного партнера B2B. Ці хлопці справді заслуговують на повагу. Вони чудові хлопці і все зробили правильно!</p>
                        <footer class="blockquote-footer">
                            <p class="h6">Ніколас Вівер</p>
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
                        <p>Маючи фотозвіт виробничих приміщень, нам вдалося передати атмосферу швейної промисловості.</p>
                    </div>
                </div>
                <div class="col-12">
                    <img src="{{ GoDesk::image('portfolio/tailor/fabric.jpg') }}" alt="">
                    <img class="color" src="{{ GoDesk::image('portfolio/tailor/colors.png') }}" alt="">
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
                        <p>Ми спробували зосередитись на деталях у веб-дизайні. Як результат, веб-сайт вийшов не просто корпоративним, а й найбільш привабливим для B2B-партнерів.</p>
                    </div>
                </div>
                <div class="col-12">
                    <img src="{{ GoDesk::image('portfolio/tailor/quality.png') }}" alt="">
                    <img src="{{ GoDesk::image('portfolio/tailor/quality2.png') }}" alt="">
                    <img src="{{ GoDesk::image('portfolio/tailor/testimonial.png') }}" alt="">
                    <img class="no-shadow" src="{{ GoDesk::image('portfolio/tailor/blog.png') }}" alt="">
                    <img class="no-shadow" src="{{ GoDesk::image('portfolio/tailor/icons.png') }}" alt="">
                    <img src="{{ GoDesk::image('portfolio/tailor/from.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="full section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-12">
                    <div class="heading">
                        <h2>Повний огляд сторінок</h2>
                        <p>Ми підключили веб-інтерфейс до технологій шиття. Найбільш правильно підібрана палітра кольорів підкреслює рівень виробництва цієї компанії.</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="gets">
                        <img class="get1" src="{{ GoDesk::image('portfolio/tailor/1.png') }}" alt="">
                        <img class="get2" src="{{ GoDesk::image('portfolio/tailor/2.png') }}" alt="">
                    </div>
                </div>
                <div class="col-12">
                    <div class="gets last">
                        <img class="get4" src="{{ GoDesk::image('portfolio/tailor/3.png') }}" alt="">
                        <img class="get4" src="{{ GoDesk::image('portfolio/tailor/4.png') }}" alt="">
                        <img class="get4" src="{{ GoDesk::image('portfolio/tailor/5.png') }}" alt="">
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