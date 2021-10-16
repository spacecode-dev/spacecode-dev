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
                        <h2>High-quality Tailoring At Your Fingertips</h2>
                        <p>Today's manufacturing companies are becoming more and more innovative and rely on modern technologies. The process of building a professional website proves that a company also goes beyond the production plant with innovation.</p>
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
                        <p class="mb-0">We needed the website of the production plant thant reflect the nature of the particular tailoring production. Due to the in-depth research we managed to reflect the nature of work, which is visible at every step. And we wanted to find web developer that made website for us properly. The SpaceCode team thorough understanding of the processes helped us create a modern and professional website presenting the information indispensable for a potential B2B partner. These guys really deserve respect. They are great fellows and did everything right!</p>
                        <footer class="blockquote-footer">
                            <p class="h6">Nicholas Weaver</p>
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
                        <p>Having a photo report of the production facilities, we managed to convey the atmosphere of the garment industry.</p>
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
                        <h2>Elements</h2>
                        <p>We tried to focus on the details in web design. As a result, the website turned out not just corporate, but also the most attractive for B2B partners.</p>
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
                        <h2>Full page overview</h2>
                        <p>We have connected the web interface with sewing technologies. The most correctly chosen palette of colors emphasizes the level of production of this company.</p>
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