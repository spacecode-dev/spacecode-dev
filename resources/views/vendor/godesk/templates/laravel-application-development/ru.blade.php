@include('godesk::index.inc.slot')
@extends('godesk::index.index')
@section('content')
    <div class="title section">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ GoDesk::urlById('page', 1, $entity->locale) }}">Главная</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $entity->title }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-xl-6 col-lg-7 col-md-8">
                    <div class="heading">
                        <p class="pre h6">{{ $entity->title }}</p>
                        <h1 class="h2">Почему Laravel лучшее решение для вашего сайта?</h1>
                        <p>Важными факторами веб-сайта, такими как рентабельность, повышение доверия, информация в реальном времени, обслуживание клиентов, лучше всего управлять с помощью процесса приложений Laravel. Безопасность, скорость и надёжность!</p>
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
                        <h2 class="text-light h3">Что говорят эксперты о преимуществах Laravel?</h2>
                        <p>Laravel - одна из лучших PHP-фреймворков для разработки коммерческих веб-приложений. Об этом свидетельствует анализ растущего интереса разработчиков PHP к Laravel по сравнению с
                            такие фреймворки, как Symfony, Codeigniter, Yii, Zend и др.<br> Неоспоримые причины представлены ниже:</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/blade.png') }}" alt="Синтаксис Blade">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Синтаксис Blade</h5>
                                    <p class="card-text">Синтаксис легче и элегантнее, чем у других PHP-фреймворков. В отличие от других популярных движков на PHP, Blade не ограничивает вас в использовании простого кода
                                        PHP в ваших представлениях.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/solve.png') }}" alt="Решает проблемы">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Решает проблемы</h5>
                                    <p class="card-text">Тейлор Отвелл взял лучшее из существующих PHP-фреймворков, а также Ruby on Rails, ASP.NET MVC, Sinatra и создал фреймворк, который решает рутинные задачи
                                        программиста настолько просто, насколько это возможно.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/fullstack.png') }}" alt="Уникализированные решения">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Уникализированные решения</h5>
                                    <p class="card-text">Laravel - это полнофункциональное решение как для серверных, так и для интерфейсных разработчиков. Для внешнего интерфейса есть готовая система сборки Laravel Mix,
                                        которая построена на Webpack, а также JS framework - Vue.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/packages.png') }}" alt="Дополнения">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Дополнения</h5>
                                    <p class="card-text">Расширения, которые дали нам возможность создавать пакеты для ваших нужд. Теперь у нас есть <a class="link" href="{{ GoDesk::urlById('page', 5, $entity->locale) }}">cms для
                                            разработки сайтов</a> GoDesk, которая удивит вас простотой использования, функциональностью и мобильностью в создании сложных проектов.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/documentation.png') }}" alt="Документация">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Документация</h5>
                                    <p class="card-text">Отличная документация, а также отличный сайт для обучения Laracasts будут полезны как новичкам, так и продвинутым разработчикам PHP Laravel.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/security.png') }}" alt="Высокая безопасность">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Высокая безопасность</h5>
                                    <p class="card-text">Возможность получить несанкционированный доступ к базе данных невозможен. Высокий уровень безопасности гарантирует надежную защиту от SQL-инъекций, атак типа XSS,
                                        CSRF.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/best.png') }}" alt="Лучший с 2013">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Лучший с 2013</h5>
                                    <p class="card-text">Всегда в тренде. Использует новейшие функции PHP (функции закрытия, пространства имен и т.д.), что гарантирует лучшую производительность. В версии 5.5 PHP7 уже
                                        используется по умолчанию.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/orm.png') }}" alt="Eloquent ORM">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Eloquent ORM</h5>
                                    <p class="card-text">Eloquent ORM. Очень простая и функциональная ORM на основе паттерна ActiveRecord.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6 item">
                            <div class="card">
                                <img class="card-img-top" src="{{ GoDesk::image('website/lara-icons/community.png') }}" alt="Отличное сообщество">
                                <div class="card-body">
                                    <h5 class="text-light card-title">Отличное сообщество</h5>
                                    <p class="card-text">Решение любой проблемы можно легко найти в поиске Google или на форумах. Наша компания, занимающаяся веб-разработкой на Laravel, активно учавствует в обсуждениях и
                                        поддерживает связь с многими фрилансерами.</p>
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
                        <h2 class="h3">Мы используем <span class="text-primary">Экосистему Laravel</span><br> для получения всего потенциала</h2>
                    </div>
                    <div class="carousel owl-carousel owl-theme" data-carousel="{items: 5, loop: true, dots: false, autoWidth: true, autoplay: true, smartSpeed: 5000}">
                        @foreach([
                            (object)['name' => 'vapor', 'text' => 'Бессерверная платформа'],
                            (object)['name' => 'forge', 'text' => 'Управление сервером'],
                            (object)['name' => 'envoyer', 'text' => 'Развертывание'],
                            (object)['name' => 'horizon', 'text' => 'Мониторинг очереди'],
                            (object)['name' => 'nova', 'text' => 'Панель управления'],
                            (object)['name' => 'echo', 'text' => 'События в реальном времени'],
                            (object)['name' => 'lumen', 'text' => 'Микро-фреймворк'],
                            (object)['name' => 'homestead', 'text' => 'Коробочное решение Vagrant'],
                            (object)['name' => 'spark', 'text' => 'Каркас приложений SaaS'],
                            (object)['name' => 'valet', 'text' => 'Среда разработки для Mac'],
                            (object)['name' => 'mix', 'text' => 'Компиляция активов Webpack'],
                            (object)['name' => 'cashier', 'text' => 'Платёжные системы'],
                            (object)['name' => 'dusk', 'text' => 'Тестирование и автоматизация'],
                            (object)['name' => 'passport', 'text' => 'OAuth2'],
                            (object)['name' => 'scout', 'text' => 'Полнотекстовый поиск'],
                            (object)['name' => 'socialite', 'text' => 'OAuth'],
                            (object)['name' => 'telescope', 'text' => 'Отладка'],
                            (object)['name' => 'tinker', 'text' => 'Интерактивный REPL'],
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
                                    <p class="card-text">SpaceCode экономит драгоценное время на 200%.</p>
                                    <img class="mt-auto" src="{{ GoDesk::image('website/lara-icons/time.png') }}" alt="экономим время">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card increase">
                                <div class="card-body d-flex align-items-center flex-column">
                                    <h5 class="h1 text-light card-title">10X</h5>
                                    <p class="card-text">Работайте со SpaceCode, чтобы увеличить результат в 10X и сократить бюджет в 3X.</p>
                                    <img class="mt-auto" src="{{ GoDesk::image('website/lara-icons/budget.png') }}" alt="сокращаем бюджет">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card main second">
                                <div class="card-body d-flex">
                                    <blockquote class="blockquote align-self-center">
                                        <p class="m-0">Благодаря нашей CMS на базе фреймворка Laravel мы можем разрабатывать множество надстроек и расширять функциональность. Совсем скоро мы будем делать проекты электронной
                                            коммерции намного быстрее и лучше.</p>
                                        <footer class="blockquote-footer">Семён, <span class="text-muted">SpaceCode Разработчик</span></footer>
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
                            <p class="card-text">И самое главное. Мы просто хорошая команда веб-разработчиков Laravel, мы любим свою работу.</p>
                            <blockquote class="blockquote">
                                <p class="m-0">Было многое. Мы открывались и закрывались, появилось много новых сотрудников, многие из них ушли. Теперь мы посвятили себя разработки на Laravel и сосредоточились на распространении CMS GoDesk и будем работать как независимая узкопрофильная студия.</p>
                                <footer class="blockquote-footer">Владлен, <span class="text-muted">Основатель SpaceCode</span></footer>
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