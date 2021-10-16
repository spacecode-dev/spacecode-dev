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
                        <h2>Website for delicious and healthy food</h2>
                        <p>Meet our brand new restaurant website, crafted with love and a lot more Food.</p>
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
                        <p class="mb-0">We asked to move away from the rules and colors of food websites. The management wanted something laconic and calm, shades that would be perceived more calmly by visitors. The result was very pleasing, and the quality of the development just surprised. Thank you for your level of service.</p>
                        <footer class="blockquote-footer">
                            <p class="h6">Marie Adkins</p>
                            <small>Menu24 Creative Manager</small>
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
                        <p>The web design is based on the desire to eat deliciously. Green color was chosen for a reason, it seems to say that all food is healthy and very appetizing.</p>
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
                        <h2>Elements</h2>
                        <p>Pay attention to the contrast of colors. This is a very unusual approach for such website type, because we had to combine two very important points for the client: health and benefits. Absolutely everything says one thing - delicious food.</p>
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
                        <h2>Look at other website pages</h2>
                        <p>Taking advantage of negative space paired with the beautiful new interface, we're allowing the product to speak for itself. Showing simplicity and innovation in all aspects from usability to pricing.</p>
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