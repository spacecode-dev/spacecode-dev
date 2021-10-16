@include('godesk::index.inc.slot')
@extends('godesk::index.index')
@section('content')
    <div class="title section">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ GoDesk::urlById('page', 1, $entity->locale) }}">Головна</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $entity->title }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-xl-6 col-lg-7 col-md-8">
                    <div class="heading">
                        <p class="pre h6">{{ $entity->title }}</p>
                        <h1 class="h2">Чому Laravel краще рішення для вашого сайту?</h1>
                        <p>Важливими чинниками веб-сайту, такими як рентабельність, підвищення довіри, інформація в реальному часі, обслуговування клієнтів, найкраще керувати за допомогою процесу додатків Laravel.
                            Безпека, швидкість і надійність!</p>
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
                        <h2 class="text-light h3">Що кажуть експерти про переваги Laravel?</h2>
                        <p>Laravel - один з кращих PHP-фреймворків для розробки комерційних веб-додатків. Про це свідчить аналіз зростаючого інтересу розробників PHP до Laravel в порівнянні з
                            такими фреймворками, як Symfony, Codeigniter, Yii, Zend та ін. <br> Незаперечні причини представлені нижче:</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/blade.png') }}" alt="Синтаксис Blade">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Синтаксис Blade</h5>
                                    <p class="card-text">Синтаксис легше і елегантніше, ніж у інших PHP-фреймворків. На відміну від інших популярних движків на PHP, Blade не обмежує вас у використанні простого коду
                                        PHP в ваших виставах.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/solve.png') }}" alt="Вирішує проблеми">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Вирішує проблеми</h5>
                                    <p class="card-text">Тейлор Отвелл взяв найкраще з існуючих PHP-фреймворків, а також Ruby on Rails, ASP.NET MVC, Sinatra і створив фреймворк, який вирішує рутинні завдання
                                        програміста настільки просто, наскільки це можливо.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/fullstack.png') }}" alt="Унікальне рішення">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Унікальне рішення</h5>
                                    <p class="card-text">Laravel - це повнофункціональне рішення як для серверних, так і для інтерфейсних розробників. Для зовнішнього інтерфейсу є готова система збирання Laravel Mix,
                                        яка побудована на Webpack, а також JS framework - Vue.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/packages.png') }}" alt="Додатки">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Додатки</h5>
                                    <p class="card-text">Розширення, які дали нам можливість створювати пакети для ваших потреб. Тепер у нас є <a class="link" href="{{ GoDesk::urlById('page', 5, $entity->locale) }}">cms
                                            для розробки сайтів</a> GoDesk, яка здивує вас простотою використання, функціональністю і мобільністю в створенні складних проектів.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/documentation.png') }}" alt="Документація">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Документація</h5>
                                    <p class="card-text">Відмінна документація, а також відмінний сайт для навчання Laracasts будуть корисні як новачкам, так і просунутим розробникам PHP Laravel.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/security.png') }}" alt="Високий рівень безпеки">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Високий рівень безпеки</h5>
                                    <p class="card-text">Можливість отримати несанкціонований доступ до бази даних неможливий. Високий рівень безпеки гарантує надійний захист від SQL-ін'єкцій, атак типу XSS,
                                        CSRF.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/best.png') }}" alt="Кращий з 2013">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Кращий з 2013</h5>
                                    <p class="card-text">Завжди в тренді. Використовує новітні функції PHP (функції закриття, простору імен і т.д.), що гарантує кращу продуктивність. У версії 5.5 PHP7 вже
                                        використовується за умовчанням.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/orm.png') }}" alt="Eloquent ORM">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Eloquent ORM</h5>
                                    <p class="card-text">Eloquent ORM. Дуже проста і функціональна ORM на основі патерну ActiveRecord.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/community.png') }}" alt="Відмінне співтовариство">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Відмінне співтовариство</h5>
                                    <p class="card-text">Рішення будь-якої проблеми можна легко знайти в пошуку Google або на форумах. Наша компанія, що займається веб-розробкою на Laravel, активно бере участь в обговореннях і
                                        підтримує зв'язок з багатьма фрілансерами.</p>
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
                        <h2 class="h3">Ми використовуємо <span class="text-primary">Екосистему Laravel</span><br> для отримання всього потенціалу</h2>
                    </div>
                    <div class="carousel owl-carousel owl-theme" data-carousel="{items: 5, loop: true, dots: false, autoWidth: true, autoplay: true, smartSpeed: 5000}">
                        @foreach([
                            (object)['name' => 'vapor', 'text' => 'Бессерверной платформа'],
                            (object)['name' => 'forge', 'text' => 'Управління сервером'],
                            (object)['name' => 'envoyer', 'text' => 'Розгортання'],
                            (object)['name' => 'horizon', 'text' => 'Моніторінг черги'],
                            (object)['name' => 'nova', 'text' => 'Панель управління'],
                            (object)['name' => 'echo', 'text' => 'Події в реальному часі'],
                            (object)['name' => 'lumen', 'text' => 'Мікро-фреймворк'],
                            (object)['name' => 'homestead', 'text' => 'Коробкове рішення Vagrant'],
                            (object)['name' => 'spark', 'text' => 'Каркас додатків SaaS'],
                            (object)['name' => 'valet', 'text' => 'Середовище розробки для Mac'],
                            (object)['name' => 'mix', 'text' => 'Компіляція активів Webpack'],
                            (object)['name' => 'cashier', 'text' => 'Платіжні системи'],
                            (object)['name' => 'dusk', 'text' => 'Тестування і автоматизація'],
                            (object)['name' => 'passport', 'text' => 'OAuth2'],
                            (object)['name' => 'scout', 'text' => 'Повнотекстовий пошук'],
                            (object)['name' => 'socialite', 'text' => 'OAuth'],
                            (object)['name' => 'telescope', 'text' => 'Налагодження'],
                            (object)['name' => 'tinker', 'text' => 'Інтерактивний REPL'],
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
                                    <p class="card-text">SpaceCode заощаджує дорогоцінний час на 200%.</p>
                                    <img class="mt-auto" src="{{ GoDesk::image('website/lara-icons/time.png') }}" alt="заощаджуємо час">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card increase">
                                <div class="card-body d-flex align-items-center flex-column">
                                    <h5 class="h1 text-light card-title">10X</h5>
                                    <p class="card-text">Працюйте з SpaceCode, щоб збільшити результат в 10X і скоротити бюджет в 3X.</p>
                                    <img class="mt-auto" src="{{ GoDesk::image('website/lara-icons/budget.png') }}" alt="скорочуємо бюджет">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card main second">
                                <div class="card-body d-flex">
                                    <blockquote class="blockquote align-self-center">
                                        <p class="m-0">Завдяки нашій CMS на базі фреймворка Laravel ми можемо розробляти безліч надбудов і розширювати функціональність. Зовсім скоро ми будемо робити проекти
                                            електронної комерції набагато швидше і краще.</p>
                                        <footer class="blockquote-footer">Семен, <span class="text-muted">SpaceCode Розробник</span></footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="card main">
                        <img class="card-img-top" src="{{ GoDesk::image('website/group-of-person-sitting.jpg') }}" alt="команда веб-разработчиков Laravel">
                        <div class="card-body">
                            <p class="card-text">І найголовніше. Ми просто хороша команда веб-розробників Laravel, ми любимо свою роботу.</p>
                            <blockquote class="blockquote">
                                <p class="m-0">Було багато. Ми відкривалися і закривалися, з'явилося багато нових співробітників, багато з них пішли. Тепер ми присвятили себе розробки на Laravel і зосередилися на
                                    поширенні CMS GoDesk і будемо працювати як незалежна вузькопрофільна студія.</p>
                                <footer class="blockquote-footer">Владлен, <span class="text-muted">Засновник SpaceCode</span></footer>
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