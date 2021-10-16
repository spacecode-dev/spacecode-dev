@include('godesk::index.inc.slot')
@extends('godesk::index.index')
@section('content')
    <div class="title section">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ GoDesk::urlById('page', 1, $entity->locale) }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $entity->title }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-xl-6 col-lg-7 col-md-8">
                    <div class="heading">
                        <p class="pre h6">{{ $entity->title }}</p>
                        <h1 class="h2">Why choose Laravel development for website?</h1>
                        <p>The important factors of a website like cost effective, increasing credibility, real-time information, better customer service are best managed by the laravel app development process.</p>
                        @include('godesk-index::add.conversion.see-price')
                    </div>
                </div>
                <div class="col-xl-6 col-lg-5 col-md-4">
                    <img src="{{ GoDesk::image('website/office.jpg') }}" alt="{{ $entity->title }}">
                </div>
            </div>
        </div>
    </div>
    <div class="benefits section-inverse">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading">
                        <h2 class="text-light h3">What Laravel experts says about benefits?</h2>
                        <p>Laravel is one of the best PHP frameworks for developing commercial web applications. This is evidenced by an analysis of the growing interest of PHP developers in Laravel in comparison with
                            such frameworks as Symfony, Codeigniter, Yii, Zend, etc.<br> Indisputable reasons are presented below:</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/blade.png') }}" alt="Blade syntax">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Blade syntax</h5>
                                    <p class="card-text">The syntax is lighter and more elegant than others PHP framework. Unlike other popular PHP templating engines, Blade does not restrict you from using plain PHP
                                        code in your views.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/solve.png') }}" alt="Solves problems">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Solves problems</h5>
                                    <p class="card-text">Taylor Otwell took the best of the existing PHP frameworks, as well as Ruby on Rails, ASP.NET MVC, Sinatra and created a framework that solves the programmer's
                                        routine tasks as simply as possible.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/fullstack.png') }}" alt="Full stack solution">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Full stack solution</h5>
                                    <p class="card-text">Laravel is a full stack solution for both back-end and front-end developers. For the frontend, there is a laravel Mix build system out of the box, which is built
                                        on Webpack, as well as the js framework - Vue.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/packages.png') }}" alt="Packages">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Packages</h5>
                                    <p class="card-text">Extensions, which gave us the opportunity to create packages for our needs. Now we have a <a class="link" href="{{ GoDesk::urlById('page', 5, $entity->locale) }}">cms website
                                            development</a> package named CMS GoDesk, which will surprise you with its ease of use, functionality and portability in creating complex projects.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/documentation.png') }}" alt="Documentation">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Documentation</h5>
                                    <p class="card-text">Excellent documentation, as well as Laracasts a great site for training, will be useful for both beginners and advanced PHP Laravel developer.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/security.png') }}" alt="Great security">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Great security</h5>
                                    <p class="card-text">The ability to gain unauthorized access to the database is extremely difficult. A high level of security guarantees reliable protection against SQL injection,
                                        attacks such as XSS, CSRF.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/best.png') }}" alt="The best since 2013">
                                <div class="card-body">
                                    <h5 class="text-light card-title">The best since 2013</h5>
                                    <p class="card-text">Always in trend. Uses the latest PHP features (closure functions, namespaces, etc.), which guarantees better performance. In version 5.5, PHP7 is already the
                                        default.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/orm.png') }}" alt="Eloquent ORM">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Eloquent ORM</h5>
                                    <p class="card-text">Eloquent ORM. Very simple and functional ORM based on the ActiveRecord pattern.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/community.png') }}" alt="Great community">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Great community</h5>
                                    <p class="card-text">The solution to any problem can be easily found in Google search or forums. Our laravel web development company communicate a lot and keep in touch.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ecosystem section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading text-center">
                        <h2 class="h3">We use <span class="text-primary">Laravel Ecosystem</span><br> to unlock your website in Laravel growth potential</h2>
                    </div>
                    <div class="carousel owl-carousel owl-theme" data-carousel="{items: 5, loop: true, dots: false, autoWidth: true, autoplay: true, smartSpeed: 5000}">
                        @foreach([
                            (object)['name' => 'vapor', 'text' => 'Serverless Platform'],
                            (object)['name' => 'forge', 'text' => 'Server Management'],
                            (object)['name' => 'envoyer', 'text' => 'Zero Downtime Deployment'],
                            (object)['name' => 'horizon', 'text' => 'Queue Monitoring'],
                            (object)['name' => 'nova', 'text' => 'Administration Panel'],
                            (object)['name' => 'echo', 'text' => 'Realtime Events'],
                            (object)['name' => 'lumen', 'text' => 'Micro-Framework'],
                            (object)['name' => 'homestead', 'text' => 'Pre-Packaged Vagrant Box'],
                            (object)['name' => 'spark', 'text' => 'SaaS App Scaffolding'],
                            (object)['name' => 'valet', 'text' => 'Dev Environment for Macs'],
                            (object)['name' => 'mix', 'text' => 'Webpack Asset Compilation'],
                            (object)['name' => 'cashier', 'text' => 'Subscription Billings'],
                            (object)['name' => 'dusk', 'text' => 'Browser Testing and Automation'],
                            (object)['name' => 'passport', 'text' => 'Painless OAuth2 Implementation'],
                            (object)['name' => 'scout', 'text' => 'Full-Text Search'],
                            (object)['name' => 'socialite', 'text' => 'OAuth Authentication'],
                            (object)['name' => 'telescope', 'text' => 'Debug Assistant'],
                            (object)['name' => 'tinker', 'text' => 'Interactive REPL'],
                        ] as $svg)
                            <div class="item d-flex align-items-center">
                                @include('godesk::add.svg', ['name' => $svg->name])
                                <div class="text">
                                    <p class="name">{{ \Illuminate\Support\Str::ucfirst($svg->name) }}</p>
                                    <p class="description">{{ $svg->text }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="row chart">
                        <div class="col-6">
                            <div class="card save">
                                <div class="card-body d-flex align-items-center flex-column">
                                    <h5 class="h1 text-light card-title">200%</h5>
                                    <p class="card-text">SpaceCode will save precious time by 200%.</p>
                                    <img class="mt-auto" src="{{ GoDesk::image('website/lara-icons/time.png') }}" alt="save precious time">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card increase">
                                <div class="card-body d-flex align-items-center flex-column">
                                    <h5 class="h1 text-light card-title">10X</h5>
                                    <p class="card-text">Work with SpaceCode to increase the result by 10X and reduced the budget by 3X.</p>
                                    <img class="mt-auto" src="{{ GoDesk::image('website/lara-icons/budget.png') }}" alt="reduced the budget">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card main second">
                                <div class="card-body d-flex">
                                    <blockquote class="blockquote align-self-center">
                                        <p class="m-0">Thanks to our CMS based on Laravel Framework, we can develop many add-ons and expand the functionality. Very soon, we will do e-commerce projects much faster and
                                            better.</p>
                                        <footer class="blockquote-footer">Sam, <span class="text-muted">SpaceCode Full Stack Laravel Developer</span></footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="card main">
                        <img class="card-img-top" src="{{ GoDesk::image('website/group-of-person-sitting.jpg') }}" alt="save precious time">
                        <div class="card-body">
                            <p class="card-text">And the most important thing. We are just a good team of Laravel Web Developers who love their work.</p>
                            <blockquote class="blockquote">
                                <p class="m-0">A lot has happened to us. We opened and closed, many new employees appeared, and many of them left. Now we have dedicated the Laravel developers and focused on the GoDesk CMS
                                    distribution and will work as independent, narrow-profile developers.</p>
                                <footer class="blockquote-footer">Vladlen, <span class="text-muted">SpaceCode CEO</span></footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('godesk-index::add.form', ['entity' => $entity])
@stop

@section('css')
    {{----}}
@stop

@section('js')
    {{----}}
@stop