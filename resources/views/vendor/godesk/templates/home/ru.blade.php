@include('godesk::index.inc.slot')
@extends('godesk::index.index')
@section('content')
    <div class="banner section-inverse">
        <div class="bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-6 col-md-12">
                    <h1 class="h6">Агентство веб-разработки</h1>
                    <h2 class="hero-heading text-light">Вы в поисках <br>разработчика?</h2>
                    <p>Здравствуйте, меня зовут Владлен, Я веб разработчик и основатель SpaceCode. У меня {{ date('Y') - 2014 }} летний опыт разработки веб-приложений, и я люблю работать с новейшими технологиями веб-разработки, такими как Laravel.</p>
                    @include('godesk-index::add.conversion.see-price')
                    <blockquote class="blockquote mb-0">
                        <footer class="blockquote-footer d-flex align-items-center">
{{--                            <img src="{{ GoDesk::image('website/founder.jpg') }}" alt="SpaceCode Основатель">--}}
                            <div>
                                <p class="h6">Владлен</p>
                                <small>Основатель SpaceCode</small>
                            </div>
                        </footer>
                    </blockquote>
                </div>
                <div class="col-lg-6 col-md-12" id="orderFormDiv">
                    <order-form order-data='{!! json_encode($entity->orderData) !!}'></order-form>
                </div>
            </div>
        </div>
    </div>
    <div class="skills">
        <div class="inner">
            <div class="container">
                <div class="row bg-white p-lg-5 p-4 d-flex align-items-center">
                    <div class="col-lg-8 col-md-9 col-sm-12 skills">
                        <p>Мы работаем с:</p>
                        <div class="d-flex align-items-center flex-wrap flex-sm-nowrap">
                            <img src="{{ GoDesk::image('website/prog/php.png') }}" alt="php">
                            <img src="{{ GoDesk::image('website/prog/css3.png') }}" alt="css3">
                            <img src="{{ GoDesk::image('website/prog/html5.png') }}" alt="html5">
                            <img src="{{ GoDesk::image('website/prog/mysql.png') }}" alt="mysql">
                            <img src="{{ GoDesk::image('website/prog/sass.png') }}" alt="sass">
                            <img src="{{ GoDesk::image('website/prog/jquery.png') }}" alt="jquery">
                            <img src="{{ GoDesk::image('website/prog/npm.png') }}" alt="npm">
                            <img src="{{ GoDesk::image('website/prog/nodejs.png') }}" alt="nodejs">
                            <img src="{{ GoDesk::image('website/prog/git.png') }}" alt="git">
                            <img src="{{ GoDesk::image('website/prog/laravel.png') }}" alt="laravel">
                            <img src="{{ GoDesk::image('website/prog/vuejs.png') }}" alt="vuejs">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-3 col-sm-12 numbers d-md-flex align-items-center justify-content-between d-none">
                        <div class="h2 companies">
                            100+<small>компаний</small>
                        </div>
                        <div class="h2 years">
                            {{ date('Y') - 2014 }}<small>лет</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="help section-primary">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6 col-sm-12">
                    <h2 class="text-light">SpaceCode - это <br>веб разработка с правильным кодом</h2>
                    <p>Некоторые владельцы сайтов, сталкиваются с проблемой работоспособности своих сайтов. Им постоянно приходиться что-то модифицировать и переделывать, чтобы их сайт работал нормально. Иногда случается, что сайт просто перестаёт работать и приходиться обращаться за помощью.</p>
                    <p>Как фрилансер-разработчик в прошлом, а сегодня основатель SpaceCode, я знаю, что программисту необходимо время, чтобы понять код и решить проблему, но иногда ошибка оказывается слишком простой. Заказчик тратит большую часть бюджета впустую только потому, что перед выполнением работы разработчику нужно изучить старый код.</p>
                </div>
                <div class="col-md-6 col-sm-12">
                    <p>Для решения этих проблем мы создали собственную <a class="link" href="{{ GoDesk::urlById('page', 5, $entity->locale)  }}"> CMS для разработки сайтов</a> на фреймворке Laravel.</p>
                    <p>На протяжении многих лет мы участвовали в сотнях проектов, выступая в качестве ведущих разработчиков, руководителей UX, консультантов по UX, что помогло нам оптимизировать качество и скорость нашей CMS. Мы всегда работаем с четкими временными рамками для достижения конкретных результатов, поэтому, даже не смотря на то, что написание кода это творческий процесс, он всегда должен соответствовать бизнес-целям.</p>
                    <p>Мы подходим ко всем нашим проектам, независимо от их размера и сложности, с особым внимание, чтобы понять желания, потребности и бизнес-цели нашего клиента.</p>
                    <p>Мы помогаем компаниям создавать и запускать свои продукты, улучшать их UX и производительность, а также занимаемся фундаментальной разработкой проектов.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading">
                        <h2 class="h3">Мы много чего разрабатываем</h2>
                    </div>
                    @if($entity->items->count() > 0)
                        <div class="carousel owl-carousel owl-theme" data-carousel="{items: 1, loop: true, nav: true, navClass: [&#x27;owl2-prev btn btn-primary rounded-circle&#x27;,&#x27;owl2-next btn btn-primary rounded-circle&#x27;], navText: [&#x27;<span class=icon-angle-left></span>&#x27;,&#x27;<span class=icon-angle-right></span>&#x27;], dots: false, center: true, margin: 70, autoWidth: true, autoplayTimeout: 6000, autoplay: true, smartSpeed: 500, autoplayHoverPause: true}">
                            @foreach($entity->items as $portfolio)
                                <div class="item d-flex flex-column">
                                    <a href="{!! $portfolio->url !!}" style="background: {!! $portfolio->variables->heading_color !!}">
                                        <img src="{!! $portfolio->thumbnail !!}">
                                        <div class="content">
                                            <h4 class="title">{{ $portfolio->title }}</h4>
                                            <p>{!! $portfolio->excerpt !!}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="godesk section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading">
                        <h3>Немного о Системе GoDesk</h3>
                        <p>Великолепно разработанная админ-панель для сайтов на Laravel. Мы тщательно продумали каждую мелочь и пользовались современными технологиями веб-разработки, чтобы сделать ваш сайт самыми продуктивными в галактике.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="nav justify-content-start flex-md-column flex-row nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-assignment-tab" data-toggle="pill" href="#v-pills-assignment" role="tab" aria-controls="v-pills-assignment" aria-selected="true">Доступ и безопасность</a>
                        <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Настройки</a>
                        <a class="nav-link" id="v-pills-seo-tab" data-toggle="pill" href="#v-pills-seo" role="tab" aria-controls="v-pills-seo" aria-selected="false">Поисковая оптимизация</a>
                        <a class="nav-link" id="v-pills-filemanager-tab" data-toggle="pill" href="#v-pills-filemanager" role="tab" aria-controls="v-pills-filemanager" aria-selected="false">Файловый менеджер</a>
                        <a class="nav-link" id="v-pills-pages-tab" data-toggle="pill" href="#v-pills-pages" role="tab" aria-controls="v-pills-pages" aria-selected="false">Страницы</a>
                        <a class="nav-link" id="v-pills-blog-tab" data-toggle="pill" href="#v-pills-blog" role="tab" aria-controls="v-pills-blog" aria-selected="false">Блог</a>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-assignment" role="tabpanel" aria-labelledby="v-pills-assignment-tab">
                            <div class="row">
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/access.png') }}" alt="Доступ">
                                        <div class="card-body">
                                            <h5 class="card-title">Доступ</h5>
                                            <p class="card-text">Процесс проверки логина и пароля пользователя (или аналогичных данных). Ограничение поступа в админ панель сайта.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/users.png') }}" alt="Пользователи">
                                        <div class="card-body">
                                            <h5 class="card-title">Пользователи</h5>
                                            <p class="card-text">Управление пользователями, возможность удалять, создавать и редактировать, назначать роли и разрешения.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/roles.png') }}" alt="Роли">
                                        <div class="card-body">
                                            <h5 class="card-title">Роли</h5>
                                            <p class="card-text">Управление ролями, возможность удалять, создавать и редактировать, назначать определенные разрешения. Может быть назначена пользователю.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/permissions.png') }}" alt="Разрешения">
                                        <div class="card-body">
                                            <h5 class="card-title">Разрешения</h5>
                                            <p class="card-text">Право на выполнение пользователями определенных операций. Можно назначить конкретному пользователю либо всем пользователям определенной роли.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                            <div class="row">
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/logo.png') }}" alt="Настройки логотипа и фавикона">
                                        <div class="card-body">
                                            <h5 class="card-title">Логотип и Фавикон</h5>
                                            <p class="card-text">Возможность загрузки логотипа и фавикона. Фавикон обрезается для нескольких размеров и размещается автоматически.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/prefixes.png') }}" alt="Настройки префиксов ресурсов">
                                        <div class="card-body">
                                            <h5 class="card-title">Префиксы ресурсов</h5>
                                            <p class="card-text">Для некоторых ресурсов (например блог) требуется префикс для отображения в URL-адресе веб-сайта. Вы можете менять их.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/tracking.png') }}" alt="Настройки отслеживания">
                                        <div class="card-body">
                                            <h5 class="card-title">Отслеживание</h5>
                                            <p class="card-text">Аналитика и статистика должна занимать далеко не последнее место в оптимизации сайта. GoDesk дает возможность вставить код Google Tag Manager и Facebook Pixel.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/multilanguage.png') }}" alt="Настройки мультиязычности">
                                        <div class="card-body">
                                            <h5 class="card-title">Мультиязычность</h5>
                                            <p class="card-text">Вы можете изменить язык панели администратора, настроить основной язык сайта и добавить дополнительные.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-seo" role="tabpanel" aria-labelledby="v-pills-seo-tab">
                            <div class="row">
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/meta.png') }}" alt="Seo мета поля">
                                        <div class="card-body">
                                            <h5 class="card-title">Мета поля</h5>
                                            <p class="card-text">Каждой странице требуются мета-поля: мета-заголовок, мета-описание, мета-ключевые слова. Мы позаботились об этом.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/crawls.png') }}" alt="Seo поисковые роботы">
                                        <div class="card-body">
                                            <h5 class="card-title">Поисковые роботы</h5>
                                            <p class="card-text">Робот-паук систематически просматривает всемирную паутину, обычно с целью веб-индексации. Мы даем вам возможность управлять ими.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/metadata.png') }}" alt="Seo дополнительные метаданные">
                                        <div class="card-body">
                                            <h5 class="card-title">Дополнительные метаданные</h5>
                                            <p class="card-text">Многие разработчики не используют все метаданные для страницы. Мы предлагаем вам возможность управлять rel=first, rel=last, rel=next, rel=prev, rel=canonical, rel=up, rel=author ссылками and мета name=document-state.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-filemanager" role="tabpanel" aria-labelledby="v-pills-filemanager-tab">
                            <div class="row">
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/upload.png') }}" alt="Файловый менеджер загрузка">
                                        <div class="card-body">
                                            <h5 class="card-title">Загрузка</h5>
                                            <p class="card-text">Вы можете загружать файлы как по одному, так и по несколько.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/display.png') }}" alt="Файловый менеджер информация">
                                        <div class="card-body">
                                            <h5 class="card-title">Информация</h5>
                                            <p class="card-text">Загрузив файл, вы можете просмотреть подробную информацию о нем.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/folder.png') }}" alt="Файловый менеджер папки">
                                        <div class="card-body">
                                            <h5 class="card-title">Папки</h5>
                                            <p class="card-text">В файловом менеджере есть возможность создавать, удалять и переименовывать папки.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/multiple.png') }}" alt="Файловый менеджер множественный выбор">
                                        <div class="card-body">
                                            <h5 class="card-title">Множественный выбор</h5>
                                            <p class="card-text">Вы можете загружать файлы все вместе, выбирая их путь или используя функцию перетаскивания.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-pages" role="tabpanel" aria-labelledby="v-pills-pages-tab">
                            <div class="row">
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/templates.png') }}" alt="Шаблоны страниц">
                                        <div class="card-body">
                                            <h5 class="card-title">Шаблоны</h5>
                                            <p class="card-text">Часто бывает, что обычного поля описания вам не хватает. Вы можете использовать функцию шаблона для выбора настраиваемой страницы.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/statuses.png') }}" alt="Статусы страниц">
                                        <div class="card-body">
                                            <h5 class="card-title">Статусы</h5>
                                            <p class="card-text">Есть два статуса отображения страниц: опубликованные и в обработке. Во втором случае страница будет недоступна.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/guards.png') }}" alt="Защитник страниц">
                                        <div class="card-body">
                                            <h5 class="card-title">Защитники</h5>
                                            <p class="card-text">Допустим, вам нужен API, который должен работать в одном приложении и работать с веб-токенами JSON. Защитник web используется по умолчанию.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/multilanguage.png') }}" alt="Мультиязычность для страниц">
                                        <div class="card-body">
                                            <h5 class="card-title">Мультиязычность</h5>
                                            <p class="card-text">Все мультиязычные страницы настраиваются отдельно от основной. Seo поля, названия, описания, ссылки уникальны.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-blog" role="tabpanel" aria-labelledby="v-pills-blog-tab">
                            <div class="row">
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/posts.png') }}" alt="Блог статьи">
                                        <div class="card-body">
                                            <h5 class="card-title">Статьи</h5>
                                            <p class="card-text">Для полной функциональности блога мы разработали специальный ресурс. Вы можете свободно управлять своими статьями.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/comments.png') }}" alt="Блог комментарии">
                                        <div class="card-body">
                                            <h5 class="card-title">Комментарии<span class="badge badge-warning">скоро</span></h5>
                                            <p class="card-text">Система управления комментариями. Фильтрация, редактирование, удаление и создание.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/post-categories.png') }}" alt="Блог категории и метки">
                                        <div class="card-body">
                                            <h5 class="card-title">Категории и метки</h5>
                                            <p class="card-text">Как представить себе блог без системы категорий и меток? Мы позаботились о создании этого ресурса.</p>
                                        </div>
                                    </div>
                                </div>
                                {{--                                <div class="item col-6">--}}
                                {{--                                    <div class="card">--}}
                                {{--                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/post-tags.png') }}" alt="Блог метки">--}}
                                {{--                                        <div class="card-body">--}}
                                {{--                                            <h5 class="card-title">Метки</h5>--}}
                                {{--                                            <p class="card-text">Стандартная система меток для статей. Ими легко управлять.</p>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/multilanguage.png') }}" alt="Мультиязычность для блога">
                                        <div class="card-body">
                                            <h5 class="card-title">Мультиязычность</h5>
                                            <p class="card-text">Все мультиязычные статьи настраиваются отдельно от основной. Seo поля, названия, описания, ссылки уникальны.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex buttons">
                    <a class="btn btn-primary" href="{!! GoDesk::urlById('page', 9, $entity->locale) !!}">Подробнее о GoDesk</a>
                </div>
            </div>
        </div>
    </div>
    <div class="how section">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <div class="heading">
                        <h3>Чем мы можем быть полезны?</h3>
                        <p>Расскажите нам, чего вы хотите достичь, сотрудничая со SpaceCode. Мы готовы обсудить любой существующий проект или стартап.</p>
                    </div>
                </div>
                <div class="item item-1 col-lg-4 col-md-12">
                    <div class="card">
                        <img class="card-img-top" src="{{ GoDesk::image('website/services/independent.png') }}" alt="Разработка Веб приложений на Laravel">
                        <div class="card-body">
                            <p class="badge badge-primary price">
                                <small class="from">Старший уровень:</small>
                                @if($settings->prices->currency === '$')
                                    <small class="number">$</small>{{ $settings->prices->hour }}<small class="number">/час</small>
                                @elseif($settings->prices->currency === 'грн')
                                    {{ $settings->prices->hour }}<small class="number"> грн</small><small class="number">/час</small>
                                @elseif($settings->prices->currency === 'руб')
                                    {{ $settings->prices->hour }}<small class="number"> руб</small><small class="number">/час</small>
                                @endif
                            </p>
                            <h5 class="card-title">Разработка веб<br> приложений на Laravel</h5>
                            <p class="card-text">Возможно, вам необходимо индивидуальное решение для веб-разработки, поэтому наши услуги по созданию веб-приложений помогут в достижении бизнес-целей. Наши разработчики Laravel специализируются на создании сложных приложений, специально адаптированных под бизнес-потребности.</p>
                            <a href="{{ GoDesk::urlById('page', 2, $entity->locale) }}" class="btn btn-link link">Подробнее</a>
                        </div>
                    </div>
                </div>
                <div class="item item-2 col-lg-4 col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="{{ GoDesk::image('website/services/godesk-dev.png') }}" alt="Разработка сайтов на CMS GoDesk">
                        <div class="card-body">
                            <p class="badge badge-primary price">
                                <small class="from">Средний уровень:</small>
                                @if($settings->prices->currency === '$')
                                    <small class="number">от $</small>{{ $settings->prices->personal->without }}
                                @elseif($settings->prices->currency === 'грн')
                                    <small class="number">от </small>{{ $settings->prices->personal->without }}<small class="number"> грн</small>
                                @elseif($settings->prices->currency === 'руб')
                                    <small class="number">от </small>{{ $settings->prices->personal->without }}<small class="number"> руб</small>
                                @endif
                            </p>
                            <h5 class="card-title">Разработка сайта <br>на CMS GoDesk</h5>
                            <p class="card-text">GoDesk предлагает чистую и функциональную панель управления, построенную на стандартизированных принципах и шаблонах Laravel. Используя GoDesk, мы можем эффективно разрабатывать веб-сайты и высоконагруженные веб-приложения на Laravel.</p>
                            <a href="{{ GoDesk::urlById('page', 5, $entity->locale) }}" class="btn btn-link link">Подробнее</a>
                        </div>
                    </div>
                </div>
                <div class="item item-3 col-lg-4 col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="{{ GoDesk::image('website/services/godesk-migration.png') }}" alt="Миграция сайтов на CMS GoDesk">
                        <div class="card-body">
                            <p class="badge badge-primary price">
                                <small class="from">Младший/Средний уровень:</small>
                                @if($settings->prices->currency === '$')
                                    <small class="number">от $</small>{{ $settings->prices->one->without }}
                                @elseif($settings->prices->currency === 'грн')
                                    <small class="number">от </small>{{ $settings->prices->one->without }}<small class="number"> грн</small>
                                @elseif($settings->prices->currency === 'руб')
                                    <small class="number">от </small>{{ $settings->prices->one->without }}<small class="number"> руб</small>
                                @endif
                            </p>
                            <h5 class="card-title">Миграция сайта <br>на CMS GoDesk</h5>
                            <p class="card-text">Как вы знаете, есть некоторые способы интеграции CMS с Laravel. В зависимости от ваших целей, мы можем помочь вам перенести существующий веб-сайт с базой данных и функциями на GoDesk. Визуально и функционально все останется как было.</p>
                            <a href="{{ GoDesk::urlById('page', 5, $entity->locale) }}" rel="nofollow" class="btn btn-link link">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="become section-inverse">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="banner">
                        <div class="card">
                            <div class="card-body">
                                <p class="pre h6">Стать клиентом</p>
                                <h5 class="h2 card-title text-light font-weight-600">Давайте сделаем ваше приложение лучше</h5>
                                <p class="card-text">Посмотрите ролики на нашем YouTube канале, чтобы убедиться, насколько легко этим управлять. Мы позаботимся о вашем сайте.</p>
                                {{--                                <a href="{!! get_setting('website_social')->youtube !!}" class="btn btn-primary" target="_blank" rel="nofollow">Смотреть на YouTube</a>--}}
                                <div class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" data-type="danger" title="Канал в разработке">Смотреть на YouTube</div>
                            </div>
                        </div>
                    </div>
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