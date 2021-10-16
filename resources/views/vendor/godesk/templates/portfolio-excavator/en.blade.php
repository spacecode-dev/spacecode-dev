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
                        <h2>Great Website For Building Construction & Renovation</h2>
                        <p>Our capacities give us the freedom of executing project of various sizes. From small personal projects to mega websites like this.</p>
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
                        <p class="mb-0">Ordered the service of website developing. After submitting the application, we were quickly contacted and clarified all questions. The experts estimated the amount of work and the price, and then started working. They did everything as efficiently and quickly as possible. We are very happy to have this website!</p>
                        <footer class="blockquote-footer">
                            <p class="h6">Giorgio Thomson</p>
                            <small>CEO</small>
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
                        <h2 class="h1">Design System</h2>
                        <p>When developing websites about construction, attention colors are often used. It is also a common practice to use contrast. We decided to move away from the rules and combined strict forms with pastel colors.</p>
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
                        <h2>Elements</h2>
                        <p>Pay attention to the font choice. He emphasizes the complexity of the work that this company does. The geometric shapes used in the elements emphasize certain points.</p>
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
                        <h2>Full Project View</h2>
                        <p>We strive to develop a better websites and make a difference in the world – Best Regards SpaceCode Team!</p>
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