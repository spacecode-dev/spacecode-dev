@include('godesk::index.inc.slot')
@extends('godesk::index.index')
@section('content')
    <div class="banner section-inverse">
        <div class="bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-6 col-md-12">
                    <h1 class="h6">Агентство веб-розробки</h1>
                    <h2 class="hero-heading text-light">Ви в пошуках <br>розробника?</h2>
                    <p>Вітаю, меня звуть Владлен, Я веб розробник і засновник SpaceCode. У мене {{date ('Y') - 2014 }} річний досвід розробки веб-додатків, і я люблю працювати з новітніми технологіями веб-розробки, такими як Laravel.</p>
                    @include('godesk-index::add.conversion.see-price')
                    <blockquote class="blockquote mb-0">
                        <footer class="blockquote-footer d-flex align-items-center">
{{--                            <img src="{{ GoDesk::image('website/founder.jpg') }}" alt="SpaceCode Засновник">--}}
                            <div>
                                <p class="h6">Владлен</p>
                                <small>Засновник SpaceCode</small>
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
                        <p>Ми працюємо з:</p>
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
                            100+<small>компаній</small>
                        </div>
                        <div class="h2 years">
                            {{ date('Y') - 2014 }}<small>років</small>
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
                    <h2 class="text-light">SpaceCode - це <br>веб розробка з правильним кодом</h2>
                    <p>Деякі власники сайтів, стикаються з проблемою працездатності своїх сайтів. Їм постійно доводиться щось змінювати і переробляти, щоб їх сайт працював нормально. Іноді трапляється, що сайт просто
                        перестає працювати і доводиться звертатися за допомогою.</p>
                    <p>Як фрілансер-розробник в минулому, а сьогодні засновник SpaceCode, я знаю, що програмісту необхідно час, щоб зрозуміти код і вирішити проблему, але іноді помилка виявляється занадто простою.
                        Замовник витрачає більшу частину бюджету даремно тільки тому, що перед виконанням роботи розробнику потрібно вивчити старий код.</p>
                </div>
                <div class="col-md-6 col-sm-12">
                    <p>Для вирішення цих проблем ми створили власну <a class="link" href="{{ GoDesk::urlById('page', 5, $entity->locale)  }}"> CMS для розробки сайтів</a> на фреймворку Laravel.</p>
                    <p>Протягом багатьох років ми брали участь в сотнях проектів, виступаючи в ролі ведучих розробників, керівників UX, консультантів по UX, що допомогло нам оптимізувати якість і швидкість нашої CMS. Ми
                        завжди працюємо з чіткими часовими рамками для досягнення конкретних результатів, тому, навіть не дивлячись на те, що написання коду це творчий процес, він завжди повинен відповідати
                        бізнес-цілям.</p>
                    <p>Ми підходимо до всіх наших проектів, незалежно від їх розміру і складності, з особливою увагою, щоб зрозуміти бажання, потреби і бізнес-цілі нашого клієнта.</p>
                    <p>Ми допомагаємо компаніям створювати і запускати свої продукти, покращувати їх UX і продуктивність, а також займаємося фундаментальною розробкою проектів.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading">
                        <h2 class="h3">Ми багато чого розробляємо</h2>
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
                        <h3>Трохи про Систему GoDesk</h3>
                        <p>Чудово розроблена адмін-панель для сайтів на Laravel. Ми ретельно продумали кожну дрібницю і користувалися сучасними технологіями веб-розробки, щоб зробити ваш сайт найбільш продуктивними в
                            галактиці.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="nav justify-content-start flex-md-column flex-row nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-assignment-tab" data-toggle="pill" href="#v-pills-assignment" role="tab" aria-controls="v-pills-assignment" aria-selected="true">Доступ і безпека</a>
                        <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Налаштування</a>
                        <a class="nav-link" id="v-pills-seo-tab" data-toggle="pill" href="#v-pills-seo" role="tab" aria-controls="v-pills-seo" aria-selected="false">Пошукова оптимізація</a>
                        <a class="nav-link" id="v-pills-filemanager-tab" data-toggle="pill" href="#v-pills-filemanager" role="tab" aria-controls="v-pills-filemanager" aria-selected="false">Файловий менеджер</a>
                        <a class="nav-link" id="v-pills-pages-tab" data-toggle="pill" href="#v-pills-pages" role="tab" aria-controls="v-pills-pages" aria-selected="false">Сторінки</a>
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
                                            <p class="card-text">Процес перевірки логіна і пароля користувача (або аналогічних даних). Обмеження поступу в адмін панель сайту.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/users.png') }}" alt="Користувачи">
                                        <div class="card-body">
                                            <h5 class="card-title">Користувачи</h5>
                                            <p class="card-text">Управління користувачами, можливість видаляти, створювати і редагувати, призначати ролі і дозволи.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/roles.png') }}" alt="Ролі">
                                        <div class="card-body">
                                            <h5 class="card-title">Ролі</h5>
                                            <p class="card-text">Управління ролями, можливість видаляти, створювати і редагувати, призначати певні дозволи. Може бути призначена користувачеві.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/permissions.png') }}" alt="Дозволи">
                                        <div class="card-body">
                                            <h5 class="card-title">Дозволи</h5>
                                            <p class="card-text">Право на виконання користувачами певних операцій. Можна призначити конкретного користувача або всім користувачам певної ролі.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                            <div class="row">
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/logo.png') }}" alt="Налаштування логотипу та фавікона">
                                        <div class="card-body">
                                            <h5 class="card-title">Логотип та Фавікон</h5>
                                            <p class="card-text">Можливість завантаження логотипу і фавікона. Фавікон обрізається для декількох розмірів і розміщується автоматично.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/prefixes.png') }}" alt="Налаштування префіксів ресурсів">
                                        <div class="card-body">
                                            <h5 class="card-title">Префикси ресурсів</h5>
                                            <p class="card-text">Для деяких ресурсів (наприклад блог) потрібно префікс для відображення в URL-адресу веб-сайту. Ви можете змінювати їх.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/tracking.png') }}" alt="Налаштування відстеження">
                                        <div class="card-body">
                                            <h5 class="card-title">Відстеження</h5>
                                            <p class="card-text">Аналітика та статистика повинна займати далеко не останнє місце в оптимізації сайту. GoDesk дає можливість вставити код Google Tag Manager і Facebook
                                                Pixel.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/multilanguage.png') }}" alt="Налаштування мультимовності">
                                        <div class="card-body">
                                            <h5 class="card-title">Мультимовністі</h5>
                                            <p class="card-text">Ви можете змінити мову панелі адміністратора, налаштувати основна мова сайту і додати додаткові.</p>
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
                                            <p class="card-text">Кожній сторінці потрібні мета-поля: мета-заголовок, мета-опис, мета-ключові слова. Ми подбали про це.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/crawls.png') }}" alt="Seo пошукові роботи">
                                        <div class="card-body">
                                            <h5 class="card-title">Пошукові роботи</h5>
                                            <p class="card-text">Робот-павук систематично переглядає всесвітню павутину, зазвичай з метою веб-індексації. Ми даємо вам можливість управляти ними.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/metadata.png') }}" alt="Seo додаткові метадані">
                                        <div class="card-body">
                                            <h5 class="card-title">Додаткові метадані</h5>
                                            <p class="card-text">Багато розробники не використовують всі метадані для сторінки. Ми пропонуємо вам можливість управляти rel=first, rel=last, rel=next, rel=prev,
                                                rel=canonical, rel=up, rel=author ссылками and мета name=document-state.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-filemanager" role="tabpanel" aria-labelledby="v-pills-filemanager-tab">
                            <div class="row">
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/upload.png') }}" alt="Файловий менеджер завантаження">
                                        <div class="card-body">
                                            <h5 class="card-title">Завантаження</h5>
                                            <p class="card-text">Ви можете завантажувати файли як по одному, так і по декілька.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/display.png') }}" alt="Файловий менеджер інформація">
                                        <div class="card-body">
                                            <h5 class="card-title">Інформація</h5>
                                            <p class="card-text">Завантаживши файл, ви можете переглянути детальну інформацію про нього.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/folder.png') }}" alt="Файловый менеджер папки">
                                        <div class="card-body">
                                            <h5 class="card-title">Папки</h5>
                                            <p class="card-text">У файловому менеджері є можливість створювати, видаляти і перейменовувати папки.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/multiple.png') }}" alt="Файловий менеджер множинний вибір">
                                        <div class="card-body">
                                            <h5 class="card-title">Множинний вибір</h5>
                                            <p class="card-text">Ви можете завантажувати файли всі разом, вибираючи їх шлях або використовуючи функцію перетягування.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-pages" role="tabpanel" aria-labelledby="v-pills-pages-tab">
                            <div class="row">
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/templates.png') }}" alt="Шаблони сторінок">
                                        <div class="card-body">
                                            <h5 class="card-title">Шаблони</h5>
                                            <p class="card-text">Часто буває, що звичайного поля опису вам не вистачає. Ви можете використовувати функцію шаблону для вибору настроюється сторінки.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/statuses.png') }}" alt="Статуси сторінок">
                                        <div class="card-body">
                                            <h5 class="card-title">Статуси</h5>
                                            <p class="card-text">Є два статусу відображення сторінок: опубліковані та в обробці. У другому випадку сторінка буде недоступна.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/guards.png') }}" alt="Захисники сторінок">
                                        <div class="card-body">
                                            <h5 class="card-title">Захисники</h5>
                                            <p class="card-text">Припустимо, вам потрібен API, який повинен працювати в одному додатку і працювати з веб-токенами JSON. Захисник web використовується за умовчанням.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/multilanguage.png') }}" alt="Мультимовність для сторінок">
                                        <div class="card-body">
                                            <h5 class="card-title">Мультимовність</h5>
                                            <p class="card-text">Все мультимовні сторінки налаштовуються окремо від основної. Seo поля, назви, опису, посилання унікальні.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-blog" role="tabpanel" aria-labelledby="v-pills-blog-tab">
                            <div class="row">
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/posts.png') }}" alt="Блог статті">
                                        <div class="card-body">
                                            <h5 class="card-title">Статті</h5>
                                            <p class="card-text">Для повної функціональності блогу ми розробили спеціальний ресурс. Ви можете вільно управляти своїми статтями.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/comments.png') }}" alt="Блог коментарі">
                                        <div class="card-body">
                                            <h5 class="card-title">Коментарі<span class="badge badge-warning">скоро</span></h5>
                                            <p class="card-text">Система управління коментарями. Фільтрація, редагування, видалення і створення.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/post-categories.png') }}" alt="Блог категорії та мітки">
                                        <div class="card-body">
                                            <h5 class="card-title">Категорії та мітки</h5>
                                            <p class="card-text">Як уявити собі блог без системи категорій і міток? Ми подбали про створення цього ресурсу.</p>
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
                                        <img class="card-img-top" src="{{ GoDesk::image('website/godesk-icons/multilanguage.png') }}" alt="Мультимовність для блога">
                                        <div class="card-body">
                                            <h5 class="card-title">Мультимовність</h5>
                                            <p class="card-text">Все мультимовні статті налаштовуються окремо від основної. Seo поля, назви, опису, посилання унікальні.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex buttons">
                    <a class="btn btn-primary" href="{!! GoDesk::urlById('page', 9, $entity->locale) !!}">Детальніше про GoDesk</a>
                </div>
            </div>
        </div>
    </div>
    <div class="how section">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <div class="heading">
                        <h3>Чим ми можемо бути корисні?</h3>
                        <p>Розкажіть нам, чого ви хочете досягти, співпрацюючи зі SpaceCode. Ми готові обговорити будь-який існуючий проект або стартап.</p>
                    </div>
                </div>
                <div class="item item-1 col-lg-4 col-md-12">
                    <div class="card">
                        <img class="card-img-top" src="{{ GoDesk::image('website/services/independent.png') }}" alt="Розробка Веб додатків на Laravel">
                        <div class="card-body">
                            <p class="badge badge-primary price">
                                <small class="from">Старший рівень:</small>
                                @if($settings->prices->currency === '$')
                                    <small class="number">$</small>{{ $settings->prices->hour }}<small class="number">/година</small>
                                @elseif($settings->prices->currency === 'грн')
                                    {{ $settings->prices->hour }}<small class="number"> грн</small><small class="number">/година</small>
                                @elseif($settings->prices->currency === 'руб')
                                    {{ $settings->prices->hour }}<small class="number"> руб</small><small class="number">/година</small>
                                @endif
                            </p>
                            <h5 class="card-title">Розробка веб<br> додатків на Laravel</h5>
                            <p class="card-text">Можливо, вам необхідно індивідуальне рішення для веб-розробки, тому наші послуги по створенню веб-додатків допоможуть в досягненні бізнес-цілей. Наші розробники Laravel
                                спеціалізуються на створенні складних додатків, спеціально адаптованих під бізнес-потреби.</p>
                            <a href="{{ GoDesk::urlById('page', 2, $entity->locale) }}" class="btn btn-link link">Детальніше</a>
                        </div>
                    </div>
                </div>
                <div class="item item-2 col-lg-4 col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="{{ GoDesk::image('website/services/godesk-dev.png') }}" alt="Розробка сайтів на CMS GoDesk">
                        <div class="card-body">
                            <p class="badge badge-primary price">
                                <small class="from">Середній рівень:</small>
                                @if($settings->prices->currency === '$')
                                    <small class="number">від $</small>{{ $settings->prices->personal->without }}
                                @elseif($settings->prices->currency === 'грн')
                                    <small class="number">від </small>{{ $settings->prices->personal->without }}<small class="number"> грн</small>
                                @elseif($settings->prices->currency === 'руб')
                                    <small class="number">від </small>{{ $settings->prices->personal->without }}<small class="number"> руб</small>
                                @endif
                            </p>
                            <h5 class="card-title">Розробка сайту <br>на CMS GoDesk</h5>
                            <p class="card-text">GoDesk пропонує чисту і функціональну панель управління, побудовану на стандартизованих принципах і шаблонах Laravel. Використовуючи GoDesk, ми можемо ефективно розробляти
                                веб-сайти і високонавантажених веб-додатки на Laravel.</p>
                            <a href="{{ GoDesk::urlById('page', 5, $entity->locale) }}" class="btn btn-link link">Детальніше</a>
                        </div>
                    </div>
                </div>
                <div class="item item-3 col-lg-4 col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="{{ GoDesk::image('website/services/godesk-migration.png') }}" alt="Міграція сайтів на CMS GoDesk">
                        <div class="card-body">
                            <p class="badge badge-primary price">
                                <small class="from">Молодший/Середній рівень:</small>
                                @if($settings->prices->currency === '$')
                                    <small class="number">від $</small>{{ $settings->prices->one->without }}
                                @elseif($settings->prices->currency === 'грн')
                                    <small class="number">від </small>{{ $settings->prices->one->without }}<small class="number"> грн</small>
                                @elseif($settings->prices->currency === 'руб')
                                    <small class="number">від </small>{{ $settings->prices->one->without }}<small class="number"> руб</small>
                                @endif
                            </p>
                            <h5 class="card-title">Міграція сайту <br>на CMS GoDesk</h5>
                            <p class="card-text">Як ви знаєте, є деякі способи інтеграції CMS з Laravel. Залежно від ваших цілей, ми можемо допомогти вам перенести існуючий веб-сайт з базою даних і функціями на GoDesk.
                                Візуально і функціонально все залишиться як було.</p>
                            <a href="{{ GoDesk::urlById('page', 5, $entity->locale) }}" rel="nofollow" class="btn btn-link link">Детальніше</a>
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
                                <p class="pre h6">Стати клієнтом</p>
                                <h5 class="h2 card-title text-light font-weight-600">Давайте зробимо ваш веб додаток краще</h5>
                                <p class="card-text">Подивіться ролики на нашому YouTube каналі, щоб переконатися, наскільки легко цим керувати. Ми подбаємо про ваш сайт.</p>
                                {{--                                <a href="{!! get_setting('website_social')->youtube !!}" class="btn btn-primary" target="_blank" rel="nofollow">Смотреть на YouTube</a>--}}
                                <div class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" data-type="danger" title="Канал в розробці">Дивитися на YouTube</div>
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