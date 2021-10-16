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
                <div class="col-xl-6 col-lg-7 col-md-9">
                    <div class="heading">
                        <p class="pre h6">{{ $entity->title }}</p>
                        <h1 class="h2">Агентство <br>по разработке сайтов <br>с собственной CMS</h1>
                        <p>GoDesk - это платформа по управлению сайтами, созданная на основе Laravel PHP Framework. Она простая, гибкая и современная. Наши клиенты довольны, потому что эта CMS экономит их время и деньги.
                            Создание сайтов на заказ стало дешевле и лучше.</p>
                        @include('godesk-index::add.conversion.see-price')
                    </div>
                </div>
                <div class="col-xl-6 col-lg-5 col-md-3">
                    <img src="{{ GoDesk::image('website/ready.jpg') }}" alt="{{ $entity->title }}">
                </div>
            </div>
        </div>
    </div>
    <div class="for section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading text-center">
                        <img src="{{ GoDesk::image('website/godesk-icons/manage.png') }}" alt="инструмент для управления сайтами">
                        <p class="pre h6 text-muted">Разработка веб-сайтов на CMS</p>
                        <h2 class="h3">CMS для людей, которые ценят время</h2>
                        <p>Ваши сотрудники наняты вами не для работы со сложным программным обеспечением. GoDesk - это простое решение, предназначенное для управления вашим сайтом. Теперь это лучшая CMS для разработки
                            сайтов, с которой мы когда-либо работали. Мы предлагаем вам CMS, которая будет расти и давать вам новые возможности. Заказав сайт, вы навсегда получите всю функциональность.</p>
{{--                        <a href="{!! get_setting('website_social')->youtube !!}" class="btn btn-primary" target="_blank" rel="nofollow">Смотреть на YouTube</a>--}}
                        <div class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" data-type="danger" title="Канал в разработке">Смотреть на YouTube</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="functions-standard section">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-12 col-md-7 col-lg-6">
                    <div class="heading">
                        <img class="mini" src="{{ GoDesk::image('website/godesk-icons/custom.png') }}" alt="Стандартные потребности">
                        <h3 class="h4">Стандартные потребности</h3>
                        <p class="m-0">В системе решены такие задачи, как управление пользователями, ролями и их разрешениями, страницами, статьями, категориями и метками. Для связи с посетителями вашего сайта есть
                            отдельный раздел под названием Запросы. Услуги по разработке веб-сайтов на заказ включают любые другие улучшения для нужд вашего веб-сайта.</p>
                    </div>
                </div>
                <div class="col-12 col-md-5 col-lg-6">
                    <img class="big" src="{{ GoDesk::image('website/godesk-img/custom.jpg') }}" alt="Стандартные потребности изображение">
                </div>
            </div>
        </div>
    </div>
    <div class="functions-settings section">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-12 col-md-5 col-lg-6">
                    <img class="big" src="{{ GoDesk::image('website/godesk-img/settings.jpg') }}" alt="Настройки изображение">
                </div>
                <div class="col-12 col-md-7 col-lg-6">
                    <div class="heading">
                        <img class="mini" src="{{ GoDesk::image('website/godesk-icons/settings.png') }}" alt="Настройки">
                        <h3 class="h4">Настройки</h3>
                        <p class="m-0">Мы предоставили возможность установить название и описание сайта, загрузить логотип и фавикон, установить основной язык или сделать сайт мультиязычным и многое другое. Мы намерены
                            реализовать множество настроек, чтобы разрабатывать сайты стало быстрее и лучше.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="functions-meta section">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-12 col-md-7 col-lg-6">
                    <div class="heading">
                        <img class="mini" src="{{ GoDesk::image('website/godesk-icons/meta.png') }}" alt="Мета поля">
                        <h3 class="h4">Мета поля</h3>
                        <p class="m-0">Мы думаем о видимости веб-сайта в поисковиках и даем вам возможность изменять мета-поля: мета-имя, мета-описание, мета-ключевые слова, состояние документа и индексация поисковыми
                            роботами. Seo в разработке сайтов является приоритетом для нас и нашей CMS.</p>
                    </div>
                </div>
                <div class="col-12 col-md-5 col-lg-6">
                    <img class="big" src="{{ GoDesk::image('website/godesk-img/meta.jpg') }}" alt="Мета поля изображение">
                </div>
            </div>
        </div>
    </div>
    <div class="functions-filemanager section">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-12 col-md-5 col-lg-6">
                    <img class="big" src="{{ GoDesk::image('website/godesk-img/filemanager.jpg') }}" alt="Файловый менеджер изображение">
                </div>
                <div class="col-12 col-md-7 col-lg-6">
                    <div class="heading">
                        <img class="mini" src="{{ GoDesk::image('website/godesk-icons/filemanager.png') }}" alt="Файловый менеджер">
                        <h3 class="h4">Файловый менеджер</h3>
                        <p class="m-0">В файловом менеджере вы можете загружать и удалять файлы, создавать папки и переименовывать их, просматривать информацию о загруженных файлах и просматривать превью. Любой
                            разработчик веб-сайтов понимает, что без этой функции не обойтись.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="slider section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading text-center">
                        <p class="pre text-muted h6">Легко использовать</p>
                        <h2 class="h3">Повысьте уровень веб-сайта с CMS GoDesk</h2>
                        <p>Разработка веб-приложений должна занимать меньше времени и меньше бюджета.</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="carousel owl-carousel owl-theme"
                         data-carousel="{items: 1, loop: true, nav: true, navClass: [&#x27;owl2-prev btn btn-primary rounded-circle&#x27;,&#x27;owl2-next btn btn-primary rounded-circle&#x27;], navText: [&#x27;<span class=icon-angle-left></span>&#x27;,&#x27;<span class=icon-angle-right></span>&#x27;], dots: false, center: true, margin: 70, autoWidth: true, autoplayTimeout: 6000, autoplay: true, smartSpeed: 500, autoplayHoverPause: true, progress: true}">
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/users.jpg') }}" alt="Пользователи">
                            <h4 class="title h5">Пользователи</h4>
                            <p>Управление пользователями, назначение им ролей и разрешений - основа любой CMS и важная функция для разработки веб-приложений.</p>
                        </div>
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/roles.jpg') }}" alt="Роли">
                            <h4 class="title h5">Роли</h4>
                            <p>Гораздо проще создать роль и назначить ее нескольким пользователям, чем назначать разрешения каждому из них.</p>
                        </div>
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/permissions.jpg') }}" alt="Разрешения">
                            <h4 class="title h5">Разрешения</h4>
                            <p>Очень важно иметь возможность назначать разрешения для каждого пользователя. В конце концов, вам может потребоваться временно забрать разрешение.</p>
                        </div>
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/pages.jpg') }}" alt="Страницы">
                            <h4 class="title h5">Страницы</h4>
                            <p>Страницы - важная часть любой CMS для динамической разработки веб-сайтов. Страницы могут быть в виде шаблона либо с самостоятельной переменной контента.</p>
                        </div>
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/posts.jpg') }}" alt="Статьи">
                            <h4 class="title h5">Статьи</h4>
                            <p>Блог - один из самых важных разделов. Вы можете представить свой сайт без статей?</p>
                        </div>
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/settings.jpg') }}" alt="Настройки">
                            <h4 class="title h5">Настройки</h4>
                            <p>Любой сайт состоит из множества элементов и крайне важно управлять ими из админки.</p>
                        </div>
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/seo.jpg') }}" alt="Сео">
                            <h4 class="title h5">Сео</h4>
                            <p>Сео это очень важно. Если ваш сайт не индексируется поисковыми ботами, о продвижении можно забыть.</p>
                        </div>
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/filemanager.jpg') }}" alt="Файловый менеджер">
                            <h4 class="title h5">Файловый менеджер</h4>
                            <p>Функция файлового менеджера очень важна для разработки веб-сайтов на PHP. Без него процесс работы с файлами усложняется.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="functions-main section">
        <div class="container">
            <div class="row main">
                <div class="col-12">
                    <div class="heading text-center">
                        <h3>Основа для услуг <br>по разработке сайтов</h3>
                        <p>Каждый раз, работая над новым проектом, мы оставляем за собой право добавлять новые функции для общего пользования. Таким образом, все наши клиенты получают возможность использовать новые
                            возможности CMS GoDesk.</p>
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