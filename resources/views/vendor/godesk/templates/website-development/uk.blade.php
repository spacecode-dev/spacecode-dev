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
                <div class="col-xl-6 col-lg-7 col-md-9">
                    <div class="heading">
                        <p class="pre h6">{{ $entity->title }}</p>
                        <h1 class="h2">Агентство <br>розробки сайтів <br>з власною CMS</h1>
                        <p>GoDesk - це платформа з управління сайтами, створена на основі Laravel PHP Framework. Вона проста, гнучка і сучасна. Наші клієнти задоволені, тому що ця CMS економить їх час і гроші.
                            Створення сайтів на замовлення стало дешевше і краще.</p>
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
                        <img src="{{ GoDesk::image('website/godesk-icons/manage.png') }}" alt="інструмент для управління сайтами">
                        <p class="pre h6 text-muted">Розробка веб-сайтів на CMS</p>
                        <h2 class="h3">CMS для людей, які цінують час</h2>
                        <p>Ваші співробітники найняті вами не для роботи зі складним програмним забезпеченням. GoDesk - це просте рішення, призначене для управління вашим сайтом. Тепер це найкраща CMS для розробки
                            сайтів, з якої ми коли-небудь працювали. Ми пропонуємо вам CMS, яка буде рости і давати вам нові можливості. Замовивши сайт, ви назавжди отримаєте всю функціональність.</p>
{{--                        <a href="{!! get_setting('website_social')->youtube !!}" class="btn btn-primary" target="_blank" rel="nofollow">Смотреть на YouTube</a>--}}
                        <div class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" data-type="danger" title="Канал в розробці">Дивитися на YouTube</div>
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
                        <img class="mini" src="{{ GoDesk::image('website/godesk-icons/custom.png') }}" alt="Стандартні потреби">
                        <h3 class="h4">Стандартні потреби</h3>
                        <p class="m-0">В системі вирішені такі завдання, як управління користувачами, ролями і їх дозволами, сторінками, статтями, категоріями і мітками. Для зв'язку з відвідувачами вашого сайту є
                            окремий розділ під назвою Запити. Послуги з розробки веб-сайтів на замовлення включають будь-які інші поліпшення для потреб вашого веб-сайту.</p>
                    </div>
                </div>
                <div class="col-12 col-md-5 col-lg-6">
                    <img class="big" src="{{ GoDesk::image('website/godesk-img/custom.jpg') }}" alt="Стандартні потреби зображення">
                </div>
            </div>
        </div>
    </div>
    <div class="functions-settings section">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-12 col-md-5 col-lg-6">
                    <img class="big" src="{{ GoDesk::image('website/godesk-img/settings.jpg') }}" alt="Налаштування зображення">
                </div>
                <div class="col-12 col-md-7 col-lg-6">
                    <div class="heading">
                        <img class="mini" src="{{ GoDesk::image('website/godesk-icons/settings.png') }}" alt="Налаштування">
                        <h3 class="h4">Налаштування</h3>
                        <p class="m-0">Ми надали можливість встановити назву і опис сайту, завантажити логотип і фавікон, встановити основну мову або зробити сайт багатомовним і багато іншого. ми маємо намір
                            реалізувати безліч налаштувань, щоб розробляти сайти стало швидше і краще.</p>
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
                        <p class="m-0">Ми думаємо про видимість веб-сайту в пошукових системах і даємо вам можливість змінювати мета-поля: мета-ім'я, мета-опис, мета-ключові слова, стан документа і індексація пошуковими
                            роботами. Seo в розробці сайтів є пріоритетом для нас і нашої CMS.</p>
                    </div>
                </div>
                <div class="col-12 col-md-5 col-lg-6">
                    <img class="big" src="{{ GoDesk::image('website/godesk-img/meta.jpg') }}" alt="Мета поля зображення">
                </div>
            </div>
        </div>
    </div>
    <div class="functions-filemanager section">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-12 col-md-5 col-lg-6">
                    <img class="big" src="{{ GoDesk::image('website/godesk-img/filemanager.jpg') }}" alt="Файловий менеджер зображення">
                </div>
                <div class="col-12 col-md-7 col-lg-6">
                    <div class="heading">
                        <img class="mini" src="{{ GoDesk::image('website/godesk-icons/filemanager.png') }}" alt="Файловий менеджер">
                        <h3 class="h4">Файловий менеджер</h3>
                        <p class="m-0">У файловому менеджері ви можете завантажувати і видаляти файли, створювати папки і перейменовувати їх, переглядати інформацію про завантажені файли і переглядати превью. Будь-який
                            розробник веб-сайтів розуміє, що без цієї функції не обійтися.</p>
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
                        <p class="pre text-muted h6">Легко використовувати</p>
                        <h2 class="h3">Підвищіть рівень веб-сайту з CMS GoDesk</h2>
                        <p>Розробка веб-додатків повинна займати менше часу і менше бюджету.</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="carousel owl-carousel owl-theme"
                         data-carousel="{items: 1, loop: true, nav: true, navClass: [&#x27;owl2-prev btn btn-primary rounded-circle&#x27;,&#x27;owl2-next btn btn-primary rounded-circle&#x27;], navText: [&#x27;<span class=icon-angle-left></span>&#x27;,&#x27;<span class=icon-angle-right></span>&#x27;], dots: false, center: true, margin: 70, autoWidth: true, autoplayTimeout: 6000, autoplay: true, smartSpeed: 500, autoplayHoverPause: true, progress: true}">
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/users.jpg') }}" alt="Користувачі">
                            <h4 class="title h5">Користувачі</h4>
                            <p>Управління користувачами, призначення їм ролей і дозволів - основа будь-якої CMS і важлива функція для розробки веб-додатків.</p>
                        </div>
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/roles.jpg') }}" alt="Ролі">
                            <h4 class="title h5">Ролі</h4>
                            <p>Набагато простіше створити роль і призначити її декільком користувачам, ніж призначати дозволу кожному з них.</p>
                        </div>
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/permissions.jpg') }}" alt="Дозволи">
                            <h4 class="title h5">Дозволи</h4>
                            <p>Дуже важливо мати можливість призначати дозволу для кожного користувача. Зрештою, вам може знадобитися тимчасово забрати дозвіл.</p>
                        </div>
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/pages.jpg') }}" alt="Сторінки">
                            <h4 class="title h5">Сторінки</h4>
                            <p>Сторінки - важлива частина будь-якої CMS для динамічної розробки веб-сайтів. Сторінки можуть бути у вигляді шаблону або з самостійної змінної контенту.</p>
                        </div>
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/posts.jpg') }}" alt="Статті">
                            <h4 class="title h5">Статті</h4>
                            <p>Блог - один з найважливіших розділів. Ви можете представити свій сайт без статей?</p>
                        </div>
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/settings.jpg') }}" alt="Налаштування">
                            <h4 class="title h5">Налаштування</h4>
                            <p>Будь-сайт складається з безлічі елементів і вкрай важливо управляти ними з адмінки.</p>
                        </div>
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/seo.jpg') }}" alt="Сео">
                            <h4 class="title h5">Сео</h4>
                            <p>Сео це дуже важливо. Якщо ваш сайт не індексується пошуковими ботами, про просування можна забути.</p>
                        </div>
                        <div class="item d-flex flex-column">
                            <img src="{{ GoDesk::image('website/cms-slider/filemanager.jpg') }}" alt="Файловий менеджер">
                            <h4 class="title h5">Файловий менеджер</h4>
                            <p>Функція файлового менеджера дуже важлива для розробки веб-сайтів на PHP. Без нього процес роботи з файлами ускладнюється.</p>
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
                        <h3>Основа для послуг <br>по розробці сайтів</h3>
                        <p>Кожен раз, працюючи над новим проектом, ми залишаємо за собою право додавати нові функції для загального користування. Таким чином, всі наші клієнти отримують можливість використовувати нові
                            можливості CMS GoDesk.</p>
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