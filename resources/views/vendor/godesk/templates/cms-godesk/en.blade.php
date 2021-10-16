@include('godesk::index.inc.slot')
@extends('godesk::index.index')
@section('content')
    <div class="title section-inverse">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb" class="text-center">
                        <ol class="breadcrumb inverse">
                            <li class="breadcrumb-item"><a href="{{ GoDesk::urlById('page', 1, $entity->locale) }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $entity->title }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-12">
                    <div class="heading text-center">
                        <h1 class="text-light">{!! str_replace('CMS', '<span class="text-primary">CMS</span>', $entity->title) !!}</h1>
                        <p>Designed for People and Developers. <br>Based on Laravel Framework.</p>
                        <div class="buttons">
{{--                            <a href="{!! get_setting('website_social')->youtube !!}" class="btn btn-primary">Video</a>--}}
                            <div class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" data-type="danger" title="The channel is under construction">Video</div>
                            <a href="{{ GoDesk::urlById('page', 8, $entity->locale) }}" class="btn btn-outline-light">Documentation</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-sm-block d-none">
                    <img src="{{ GoDesk::image('website/godesk/godesk.jpg') }}" alt="{{ $entity->title }}">
                </div>
            </div>
        </div>
    </div>
    <div class="for section">
        <div class="container">
            <div class="row">
                <div class="item col-lg-3 col-sm-6">
                    <div class="card">
                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk/for/easy.png') }}" alt="Everything you need">
                        <div class="card-body">
                            <h3 class="card-title h5">Everything you need</h3>
                            <p class="card-text">We sweat little things to build what you really need. The admin panel of your application should not be late.</p>
                        </div>
                    </div>
                </div>
                <div class="item col-lg-3 col-sm-6">
                    <div class="card">
                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk/for/project.png') }}" alt="Any tasks">
                        <div class="card-body">
                            <h3 class="card-title h5">Any tasks</h3>
                            <p class="card-text">GoDesk gives you a complete interface for your Eloquent models. Each type of Eloquent relationship is fully supported.</p>
                        </div>
                    </div>
                </div>
                <div class="item col-lg-3 col-sm-6">
                    <div class="card">
                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk/for/clean.png') }}" alt="Clean code">
                        <div class="card-body">
                            <h3 class="card-title h5">Clean code</h3>
                            <p class="card-text">GoDesk is a great app based on Laravel Framework. Custom component development is easy now.</p>
                        </div>
                    </div>
                </div>
                <div class="item col-lg-3 col-sm-6">
                    <div class="card">
                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk/for/cheers.png') }}" alt="Cheers everyone!">
                        <div class="card-body">
                            <h3 class="card-title h5">Cheers everyone!</h3>
                            <p class="card-text">You will appreciate all the advantages of the system. Nothing more, just a quality Content Management System.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="built-for section">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-7">
                    <img class="main" src="{{ GoDesk::image('website/godesk/built-for/storm.jpg') }}" alt="Open source tools">
                </div>
                <div class="col-lg-5">
                    <div class="heading">
                        <h2 class="h3">Develop with well-known open source tools</h2>
                        <p>GoDesk using well known Open Source libraries like Vue.js to life easier for everyone.</p>
                    </div>
                    <a href="{{ GoDesk::urlById('page', 8, $entity->locale) }}" class="btn btn-primary">Documentation</a>
                    <div class="images">
                        <img src="{{ GoDesk::image('website/godesk/built-for/php.png') }}" alt="Php">
                        <img src="{{ GoDesk::image('website/godesk/built-for/webpack.png') }}" alt="Webpack">
                        <img src="{{ GoDesk::image('website/godesk/built-for/vue.png') }}" alt="Vue.js">
                        <img src="{{ GoDesk::image('website/godesk/built-for/saas.png') }}" alt="Saas">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="open-source section">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-6 order-lg-0 order-1">
                    <div class="heading">
                        <svg viewBox="0 0 205.74 251.2" width="50" xmlns="http://www.w3.org/2000/svg">
                            <g transform="translate(-87.424 -72.374)" fill="#007bff">
                                <path d="m114.48 244.87c-1.8125-0.98669-8.684-10.089-12.597-16.686-8.193-13.814-12.533-27.333-14.12-43.99-0.32919-3.4546-0.45095-11.193-0.23191-14.738 1.0139-16.409 4.7347-29.739 12.006-43.013 5.7213-10.445 14.036-20.738 23.213-28.738 4.6151-4.023 11.7-9.1993 16.301-11.91 0.53219-0.31352 1.2356-0.75078 1.5631-0.97168s0.83857-0.48068 1.1357-0.57726c0.29713-0.0966 0.65707-0.30472 0.79987-0.46252 0.1428-0.15779 0.60928-0.38853 1.0366-0.51276 0.42733-0.12422 0.94588-0.35874 1.1524-0.52115 0.20647-0.16242 0.70271-0.406 1.1027-0.5413 0.40003-0.1353 0.9059-0.37261 1.1242-0.52734 0.96966-0.68742 1.8374-0.48645 2.458 0.56926l0.42022 0.71492-0.0271 51.731c-0.0262 49.817-0.16414 70.288-0.49714 73.763-0.23418 2.4438-0.81488 5.1391-1.331 6.1779-0.14237 0.28657-0.36595 0.95646-0.49681 1.4886-0.29676 1.2068-1.6814 4.3077-3.0024 6.7241-3.0378 5.5565-6.1473 8.8007-12.658 13.207-3.977 2.6913-10.756 6.6789-13.937 8.1986-1.8557 0.88643-2.6517 1.0297-3.4144 0.61443z"></path> <path d="m165.62 75.949c1.7608-1.0763 13.079-2.4762 20.749-2.5663 16.059-0.18858 29.938 2.8131 45.156 9.7667 3.1564 1.4422 9.9186 5.2058 12.879 7.168 13.703 9.0824 23.387 18.97 31.247 31.904 6.1846 10.177 10.942 22.525 13.281 34.472 1.1765 6.0083 2.1169 14.732 2.1638 20.072 6e-3 0.61764 0.0322 1.4454 0.0602 1.8395 0.0276 0.39411-3e-3 0.96656-0.0679 1.2722-0.065 0.30561-0.0646 0.7214 6.3e-4 0.92396 0.0652 0.20256 0.0322 0.72191-0.0743 1.1541-0.10606 0.43218-0.16226 0.99853-0.12485 1.2586 0.0378 0.25995 2.7e-4 0.81156-0.0826 1.2256-0.0832 0.41405-0.13024 0.97083-0.10538 1.2372 0.11047 1.1835-0.49742 1.8344-1.722 1.844l-0.82925 6e-3 -44.786-25.889c-43.13-24.931-60.789-35.286-63.632-37.312-1.9993-1.4247-4.0432-3.2753-4.6847-4.2416-0.17696-0.26658-0.64534-0.79514-1.0408-1.1746-0.89675-0.86039-2.8899-3.61-4.322-5.9622-3.2932-5.4091-4.548-9.724-5.1082-17.566-0.34221-4.7899-0.40628-12.654-0.13166-16.169 0.16015-2.0503 0.43406-2.8113 1.1751-3.2642z"></path> <path transform="matrix(1.0142 0 0 1.0142 -2.8255 -3.5594)" d="m126.35 266.16c0 9.7478 0 29.244 0.16552 39.442 0.16551 10.198 0.51242 11.14 1.0577 11.988s1.2956 1.6227 2.3736 2.2889c1.078 0.66616 2.4827 1.2232 3.7301 1.4895 1.2474 0.26629 2.3376 0.24205 3.5964-0.097 1.2588-0.33904 2.6891-0.99358 5.0128-2.2644s5.5476-3.1615 22.765-13.117c17.217-9.9552 48.454-27.99 65.48-38.113s19.854-12.343 22.92-15.009c3.066-2.6657 6.3974-5.8026 9.4244-9.0597 3.0269-3.257 5.7646-6.6488 8.1014-9.8211s4.275-6.128 6.0668-9.3122c1.7918-3.1842 3.4394-6.6005 4.747-9.579 1.3076-2.9785 2.2767-5.5225 2.8194-7.1091 0.54262-1.5866 0.66811-2.2642 0.5713-2.8688-0.0968-0.60459-0.4122-1.1626-1.6223-2.046-1.2101-0.8834-3.3184-2.0951-5.7164-3.4757-2.3979-1.3806-5.0859-2.9304-7.4594-4.1536-2.3735-1.2231-4.4319-2.1191-6.515-2.8337-2.083-0.71455-4.1896-1.2473-6.4423-1.5501-2.2527-0.30282-4.6496-0.37546-6.9751-0.33915-2.3255 0.0363-4.577 0.18157-6.7935 0.61752-2.2165 0.43596-4.3952 1.1622-8.1507 3.0278-3.7555 1.8656-9.0808 4.8671-27.54 15.417-18.459 10.55-50.034 28.637-65.825 37.684-15.792 9.0463-15.792 9.0463-15.792 18.794z"/>
                            </g>
                        </svg>
{{--                        <img src="{{ GoDesk::image('website/godesk/github_logo.png') }}" alt="spacecode-dev/godesk">--}}
                        <h2 class="h3">Open Source</h2>
                        <p>At the moment, CMS GoDesk is 100% open and free code, we are pleased to share it with developers around the world.</p>
                    </div>
                    <a href="{!! Auth::check() ? route('profile') : route('profile', ['lang' => $entity->locale]) !!}" class="btn btn-primary" target="_blank" rel="nofollow">Get It Now</a>
                </div>
                <div class="col-lg-6 order-lg-1 order-0">
                    <img class="main" src="{{ GoDesk::image('website/godesk/profile.png') }}" alt="CMS for Laravel 7.*">
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{----}}
@stop

@section('js')
    {{----}}
@stop