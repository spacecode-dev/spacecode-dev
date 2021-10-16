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
                        <h2>Новий рівень інтер'єру</h2>
                        <p>Ми пишаємось тим, що є веб-розробниками - ми розробили справді приголомшливе рішення для дизайн-студії інтер'єру.</p>
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
                        <p class="mb-0">Дякуємо за це чудо веб-дизайну :). Наші клієнти в захваті від нашого веб-сайту. Усі сторінки виконані стисло та з розумінням нашої сфери діяльності. Стиль веб-дизайну, кольори та форми дуже точно підібрані. Ми дуже задоволені результатом.</p>
                        <footer class="blockquote-footer">
                            <p class="h6">Британі Солт</p>
                            <small>Виконавчий директор в Home Interior Design</small>
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
                        <p>Ми подумали і вирішили, що такий дизайн веб-сторінки буде як мінімум цікавим і максимально відповідним для студії дизайну інтер'єру.</p>
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
                        <h2>Елементи</h2>
                        <p>Дизайнерські студії, незалежно від особливостей діяльності, мають одне обов’язкове завдання - привабливе візуальне рішення.</p>
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
                        <h2>Деякі рішення, що надані клієнту</h2>
                        <p>Дизайн інтер'єру, схоже, має особливу магію. Вдале рішення щодо інтер'єру може розширити простір і створити неповторну атмосферу. Отже, коли ми працювали з цією концепцією, нас мотивувала зручність використання ресурсу. Результат такий: користувач може легко знайти те, що шукає, а також стильні візуальні рішення.</p>
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