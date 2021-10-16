@include('godesk::index.inc.slot')
@extends('godesk::index.index')
@section('content')
    <div class="banner section" style="background: {!! $entity->variables->heading_color !!}">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-7">
                    <h1 class="{{ isset($entity->variables->text_color) ? 'text-' . $entity->variables->text_color : null  }}">{{ $entity->title }}</h1>
                    <p class="{{ isset($entity->variables->text_color) ? 'text-' . $entity->variables->text_color : null  }}">{!! $entity->excerpt !!}</p>
                </div>
                <div class="col-5 d-md-block d-none">
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
                        <h2>Новый уровень интерьера</h2>
                        <p>Мы гордимся тем, что являемся веб-разработчиками - мы разработали действительно потрясающее решение для студии дизайна интерьера.</p>
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
                    <img src="{{ GoDesk::image('portfolio/home-interior-design/banner1.png') }}" alt="">
                    <img src="{{ GoDesk::image('portfolio/home-interior-design/banner2.png') }}" alt="">
                    <img src="{{ GoDesk::image('portfolio/home-interior-design/banner3.png') }}" alt="">
                    <img src="{{ GoDesk::image('portfolio/home-interior-design/banner4.png') }}" alt="">
                    <img src="{{ GoDesk::image('portfolio/home-interior-design/banner5.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="blockquote section">
        <div class="container">
            <div class="row">
                <div class="offset-md-2 offset-0 col-md-8 col-12">
                    <blockquote class="blockquote">
                        <p class="mb-0">Спасибо за это чудо веб-дизайна :). Наши клиенты довольны нашим сайтом. Все страницы выполнены лаконично и с пониманием нашей сферы деятельности. Стиль в веб-дизайне, цвета и формы подобраны очень точно. Результатом очень довольны.</p>
                        <footer class="blockquote-footer">
                            <p class="h6">Британи Солт</p>
                            <small>Исполнительный директор в Home Interior Design</small>
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
                        <p>Мы подумали и решили, что такой дизайн веб-страницы будет как минимум увлекательным и максимально подходящим для студии дизайна интерьера.</p>
                    </div>
                </div>
                <div class="col-12">
                    <img src="{{ GoDesk::image('portfolio/home-interior-design/design.png') }}" alt="">
                    <img class="color" src="{{ GoDesk::image('portfolio/home-interior-design/colors.png') }}" alt="">
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
                        <p>У дизайн-студий, какова бы ни была специфика деятельности, есть одна обязательная задача - привлекательное визуальное решение.</p>
                    </div>
                </div>
                <div class="col-12">
                    <img class="no-shadow" src="{{ GoDesk::image('portfolio/home-interior-design/services.png') }}" alt="">
                    <img src="{{ GoDesk::image('portfolio/home-interior-design/portfolio.png') }}" alt="">
                    <img class="no-shadow" src="{{ GoDesk::image('portfolio/home-interior-design/count.png') }}" alt="">
                    <img class="no-shadow" src="{{ GoDesk::image('portfolio/home-interior-design/plan.png') }}" alt="">
                    <img class="no-shadow" src="{{ GoDesk::image('portfolio/home-interior-design/price.png') }}" alt="">
                    <img src="{{ GoDesk::image('portfolio/home-interior-design/team.png') }}" alt="">
                    <img class="no-shadow" src="{{ GoDesk::image('portfolio/home-interior-design/blog.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="full section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-12">
                    <div class="heading">
                        <h2>Некоторые решения, предоставленные клиенту</h2>
                        <p>В дизайне интерьера есть особая магия. Удачное интерьерное решение способно расширить пространство и создать неповторимую атмосферу. Итак, когда мы работали с этой концепцией, нас мотивировала удобство использования ресурса. В результате пользователь может легко найти то, что ищет, а также стильные визуальные решения.</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="gets">
                        <img class="get1" src="{{ GoDesk::image('portfolio/home-interior-design/1.png') }}" alt="">
                        <img class="get2" src="{{ GoDesk::image('portfolio/home-interior-design/2.png') }}" alt="">
                        <img class="get3" src="{{ GoDesk::image('portfolio/home-interior-design/3.png') }}" alt="">
                    </div>
                </div>
                <div class="col-12">
                    <div class="gets last">
                        <img class="get4" src="{{ GoDesk::image('portfolio/home-interior-design/4.png') }}" alt="">
                        <img class="get5" src="{{ GoDesk::image('portfolio/home-interior-design/5.png') }}" alt="">
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