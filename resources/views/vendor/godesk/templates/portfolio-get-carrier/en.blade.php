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
                        <h2>Landing pages that bring leads</h2>
                        <p>A lead capture page is a type of post-click landing page differentiated by an optimized lead capture form. This form allows you to collect leads for your respective offers and nurture them down your marketing funnel.</p>
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
                        <p class="mb-0">We are GetCarrier - Auto Transport Marketplace. We help shippers get instant quotes and auction bids from customer-rated carriers and brokers. We needed a high-level developers, since the tasks were quite difficult. As a result, SpaceCode Agency coped with the tasks very well, all the details were followed, everything was done at the highest level. Special thanks to Vladlen for his initiative. I recommend this team, they are professionals in their field.</p>
                        <footer class="blockquote-footer">
                            <p class="h6">Max Antonov</p>
                            <small>GetCarrier Co-Founder</small>
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
                        <p>Iconography can help you to make your website stand out from your competitors as well as personalize it and help users to surf it properly.</p>
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
                        <h2>Elements</h2>
                        <p>There are many call to action elements present. Various libraries were used to animate text and other web elements. The task was to make heavy multi-stage forms for filling the leads.</p>
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
                        <h2>A more landing pages</h2>
                        <p>We have designed and developed many landing pages for cool guys from Ukraine. They are involved in the US road transport market. Each landing page is a separate type of service.</p>
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