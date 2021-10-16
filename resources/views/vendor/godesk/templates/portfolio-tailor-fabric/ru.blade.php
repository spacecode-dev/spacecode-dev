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
                        <h2>Качественный пошив под рукой</h2>
                        <p>Сегодняшние производственные компании становятся все более инновационными и полагаются на современные технологии. Процесс создания профессионального веб-сайта доказывает, что компания внедряет инновации не только на производственном предприятии.</p>
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
                        <p class="mb-0">Нам нужен был сайт завода-изготовителя, который бы отражал специфику конкретного пошивочного производства. Благодаря глубокому исследованию нам удалось отразить характер работы, который виден на каждом этапе. И мы хотели найти веб-разработчика, который бы правильно сделал для нас сайт. Тщательное понимание процессов командой SpaceCode помогло нам создать современный и профессиональный веб-сайт, на котором представлена информация, необходимая для потенциального партнера B2B. Эти парни действительно заслуживают уважения. Они молодцы и все сделали правильно!</p>
                        <footer class="blockquote-footer">
                            <p class="h6">Николас Уивер</p>
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
                        <p>Имея фотоотчет производственных помещений, нам удалось передать атмосферу швейной индустрии.</p>
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
                        <h2>Элементы</h2>
                        <p>Мы постарались сосредоточиться на деталях в веб-дизайне. В результате сайт получился не только корпоративным, но и наиболее привлекательным для B2B-партнеров.</p>
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
                        <h2>Полный обзор страниц</h2>
                        <p>Мы связали веб-интерфейс со швейными технологиями. Правильно подобранная палитра цветов подчеркивает уровень производства этой компании.</p>
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