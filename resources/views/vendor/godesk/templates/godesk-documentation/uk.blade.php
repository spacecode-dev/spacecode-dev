@include('godesk::index.inc.slot')
@extends('godesk::index.index')
@section('content')
    <div class="main section">
        <div class="container-fluid">
            <div class="row min-vh-100 flex-row">
                @include('godesk-index::add.sidebar', ['entity' => $entity])
                <main>
                    <h1 class="h2" id="installation"><a href="#installation" aria-hidden="true" class="header-anchor">#</a> Установка</h1>
                    <ul>
                        <li><a href="#requirements">Системні вимоги</a></li>
                        <li><a href="#browser-support">Підтримка браузерів</a></li>
                        <li>
                            <a href="#installing">Установка</a>
                            <ul>
                                <li>
                                    <a href="#installing-laravel">Установка Laravel</a>
                                    <ul>
                                        <li><a href="#public-directory">Публічний каталог</a></li>
                                        <li><a href="#configuration-files">Файли конфігурації</a></li>
                                        <li><a href="#database-config">Конфігурація бази даних</a></li>
                                        <li><a href="#directory-permissions">Дозволи каталогу</a></li>
                                        <li><a href="#application-key">Ключ додатку</a></li>
                                        <li><a href="#additional-configuration">Додаткова конфігурація</a></li>
                                        <li><a href="#directory-configuration">Конфігурація каталогу</a></li>
                                        <li><a href="#pretty-urls-apache">Красива URL-адреса в Apache</a></li>
                                        <li><a href="#pretty-urls-nginx">Красива URL-адреса в Nginx</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#installing-godesk">Установка GoDesk</a>
                                    <ul>
                                        <li><a href="#godesk-database-config">Конфігурація бази даних</a></li>
                                        <li><a href="#godesk-database-env">Середовища баз даних</a></li>
                                        <li><a href="#godesk-redis">Потрібен Redis</a></li>
                                        <li><a href="#godesk-install">Процес установки</a></li>
                                        <li><a href="#godesk-update">Підтримка активів в актуальному стані</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="content m-0">
                        <h2 class="h3" id="requirements"><a href="#requirements" aria-hidden="true" class="header-anchor">#</a> Системні вимоги</h2>
                        <p>CMS GoDesk має кілька вимог, про які слід знати перед установкою:</p>
                        <ul>
                            <li>PHP >= 7.2.5</li>
                            <li>Redis >= 3.0</li>
                            <li>Composer</li>
                            <li>Laravel Mix</li>
                            <li>Node.js &amp; NPM</li>
                            <li>Laravel Framework 7.*</li>
                            <li><em>exif</em>, <em>zip</em>, <em>bcmath</em>, <em>curl</em>, <em>phpiredis</em>, <em>ctype</em>, <em>fileinfo</em>, <em>json</em>, <em>mbstring</em>, <em>openssl</em>, <em>pdo</em>, <em>tokenizer</em>,
                                <em>xml</em>, PHP Розширення
                            </li>
                        </ul>
                    </div>
                    <div class="content">
                        <h2 class="h3" id="browser-support"><a href="#browser-support" aria-hidden="true" class="header-anchor">#</a> Підтримка браузерів</h2>
                        <p>GoDesk підтримує досить свіжі версії наступних браузерів:</p>
                        <ul>
                            <li>Google Chrome</li>
                            <li>Apple Safari</li>
                            <li>Microsoft Edge</li>
                            <li>Mozilla Firefox</li>
                        </ul>
                    </div>
                    <div class="content">
                        <h2 class="h3" id="installing"><a href="#installing" aria-hidden="true" class="header-anchor">#</a> Установка</h2>
                        <p>CMS GoDesk залежить від Laravel та використовує <a href="https://getcomposer.org/" target="_blank" rel="nofollow">Composer</a> для керування своїми залежностями. Отже, перед використанням GoDesk
                            переконайтеся, що у вас встановлений Composer.</p>
                        <div class="content">

                            <h3 class="h5" id="installing-laravel"><a href="#installing-laravel" aria-hidden="true" class="header-anchor">#</a> Установка Laravel</h3>
                            <p>Ви можете відвідати офіційний веб-сайт <a href="https://laravel.com/docs/7.x/installation" target="_blank" rel="nofollow">Laravel</a> або слідувати нашим інструкціям.</p>
                            <p>Спочатку завантажте установник Laravel за допомогою Composer:</p>
                            <pre class="language-bash">
                                <code>composer global require laravel/installer</code>
                            </pre>
                            <p>Встановіть Laravel, ввівши команду Composer <code class="language-php">create-project</code> в своєму терміналі:</p>
                            <pre class="language-bash">
                                <code>composer create-project --prefer-dist laravel/laravel:^7.0 blog</code>
                            </pre>
                            <p>Ви можете вказати будь-який шлях замість <code class="language-php">blog</code>, а потім перемістити додаток в кореневу папку.</p>

                            <h4 class="h6" id="public-directory"><a href="#public-directory" aria-hidden="true" class="header-anchor">#</a> Публічний каталог</h4>
                            <p>Після установки Laravel ви повинні настроїти документ/кореневий каталог веб-сервера на <code class="language-php">public</code> директорію.<code
                                        class="language-php">index.php</code> в цьому каталозі служить фронт-контролером для всіх HTTP-запитів, що надходять до вашої програми.</p>

                            <h4 class="h6" id="configuration-files"><a href="#configuration-files" aria-hidden="true" class="header-anchor">#</a> Файли конфігурації</h4>
                            <p>Все Файли конфігурації для Laravel зберігаються в каталозі <code class="language-php">config</code>. Кожен варіант задокументований, тому не соромтеся переглядати
                                файли і ознайомтеся з доступними варіантами.</p>

                            <h4 class="h6" id="database-config"><a href="#database-config" aria-hidden="true" class="header-anchor">#</a> Конфігурація бази даних</h4>
                            <p>Якщо ви використовуєте MySQL будь-якої версії (MySQL, MariaDB, тощо), переконайтеся, що ви знаєте свої кодування. Змініть кодування <code class="language-php">charset</code> і <code
                                        class="language-php">collation</code> у <code class="language-php">config/database.php</code> на необхідне.</p>

                            <h4 class="h6" id="directory-permissions"><a href="#directory-permissions" aria-hidden="true" class="header-anchor">#</a> Дозволи каталогу</h4>
                            <p>Після установки Laravel вам може знадобитися налаштувати деякі дозволу. Каталоги в <code class="language-php">storage</code> і в <code class="language-php">bootstrap/cache</code>
                                повинні бути доступні для запису вашим веб-сервером, інакше Laravel не запуститься. Якщо ви використовуєте віртуальну машину Homestead, ці дозволи вже повинні бути встановлені.</p>

                            <h4 class="h6" id="application-key"><a href="#application-key" aria-hidden="true" class="header-anchor">#</a> Ключ додатку</h4>
                            <p>Наступне, що вам потрібно зробити після установки Laravel - це Ключ додатку. Якщо ви встановили Laravel через Composer або установник Laravel, цей ключ вже
                                було поставлено для вас за допомогою команди <code class="language-php">php artisan key:generate</code>.</p>
                            <p>Зазвичай цей рядок має складатися з 32 символів. Ключ можна задати у файлі середовища <code class="language-php">.env</code>. Якщо ви не перейменували <code
                                        class="language-php">.env.example</code> файл на <code class="language-php">.env</code>, ви повинні зробити це зараз. <strong>Якщо Ключ додатка не встановлено, ваші
                                    призначені для користувача сеанси і інші зашифровані дані не будуть в безпеці!</strong></p>

                            <h4 class="h6" id="additional-configuration"><a href="#additional-configuration" aria-hidden="true" class="header-anchor">#</a> Додаткова конфігурація</h4>
                            <p>Laravel майже не потребує іншої конфігурації. Ви можете почати розробку! Однак ви можете переглянути файл <code class="language-php">config/app.php</code> і його документацію. він
                                містить кілька параметрів, таких як <code class="language-php">часовий пояс</code> і <code class="language-php">регіон</code>, які ви можете змінити відповідно до вашого
                                додатком.</p>
                            <p>Ви також можете налаштувати декілька додаткових компонентів Laravel, наприклад:</p>
                            <ul>
                                <li><a href="https://laravel.com/docs/7.x/cache#configuration" target="_blank" rel="nofollow">Кеш</a></li>
                                <li><a href="https://laravel.com/docs/7.x/database#configuration" target="_blank" rel="nofollow">База даних</a></li>
                                <li><a href="https://laravel.com/docs/7.x/session#configuration" target="_blank" rel="nofollow">Сесія</a></li>
                            </ul>

                            <h4 class="h6" id="directory-configuration"><a href="#directory-configuration" aria-hidden="true" class="header-anchor">#</a> Конфігурація каталогу</h4>
                            <p>Laravel завжди повинен обслуговуватися з кореня "веб-каталогу", налаштованого для вашого веб-сервера. Ви не повинні намагатися обслуговувати додаток Laravel з підкаталогу. Спроба зробити це
                                може відкрити доступ до конфіденційних файлів, присутніх у вашому додатку.</p>

                            <h4 class="h6" id="pretty-urls-apache"><a href="#pretty-urls-apache" aria-hidden="true" class="header-anchor">#</a> Красиві URL-адреса в Apache</h4>
                            <p>Laravel включає файл <code class="language-php">public/.htaccess</code>, який використовується для надання URL-адрес без фронт-контролера <code
                                        class="language-php">index.php</code>.
                                Перед обслуговуванням Laravel з Apache обов'язково вкажіть модуль <code class="language-php">mod_rewrite</code>, щоб файл <code class="language-php">.htaccess</code> був оброблений
                                сервером.</p>
                            <p>Якщо файл <code class="language-php">.htaccess</code>, який поставляється з Laravel, не працює з вашою установкою Apache, спробуйте наступний варіант:</p>
                            <pre class="language-other">
                                <code>Options +FollowSymLinks -Indexes
RewriteEngine On

RewriteCond %{HTTP:Authorization} .
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]</code>
                            </pre>

                            <h4 class="h6" id="pretty-urls-nginx"><a href="#pretty-urls-nginx" aria-hidden="true" class="header-anchor">#</a> Красиві URL-адреса в Nginx</h4>
                            <p>Якщо ви використовуєте Nginx, наступна директива в конфігурації вашого сайту буде направляти всі запити на фронт-контролер <code class="language-php">index.php</code>:</p>
                            <pre class="language-other">
                                <code>location / {
    try_files $uri $uri/ /index.php?$query_string;
}</code>
                            </pre>
                        </div>
                        <div class="content">

                            <h3 class="h5" id="installing-godesk"><a href="#installing-godesk" aria-hidden="true" class="header-anchor">#</a> Установка CMS GoDesk</h3>
                            <div class="alert alert-danger">
                                <h6 class="p-0 mt-0">Заборонено</h6>
                                <p class="m-0">Нічого іншого, крім зазначеного, міняти не потрібно, це може вплинути на систему.</p>
                            </div>
                            <div class="alert alert-primary">
                                <h6 class="p-0 mt-0">Необхідно</h6>
                                <p class="m-0">Спочатку вам необхідно зареєструватися на <a href="https://spacecode.dev">spacecode.dev</a> і мати ліцензію на завантаження файлів з CMS GoDesk.</p>
                            </div>
                            <h4 class="h6" id="godesk-database-config"><a href="#godesk-database-config" aria-hidden="true" class="header-anchor">#</a> Конфігурація бази даних</h4>
                            <p>Переконайтеся, що ваші <a href="#database-config">конфігурації бази даних</a> в <code class="language-php">config/database.php</code> правильні.</p>

                            <h4 class="h6" id="godesk-database-env"><a href="#godesk-database-env" aria-hidden="true" class="header-anchor">#</a> Середовища баз даних</h4>
                            <p>Перевірте середовище своєї бази даних в <code class="language-php">.env</code>: <code class="language-php">DB_CONNECTION</code> <code class="language-php">DB_HOST</code> <code
                                        class="language-php">DB_PORT</code> <code class="language-php">DB_DATABASE</code> <code class="language-php">DB_USERNAME</code> <code class="language-php">DB_PASSWORD</code></p>

                            <h4 class="h6" id="godesk-redis"><a href="#godesk-redis" aria-hidden="true" class="header-anchor">#</a> Потрібен Redis</h4>
                            <p>Перевірте своє середовище в <code class="language-php">.env</code>: <code class="language-php">CACHE_DRIVER</code> <code class="language-php">QUEUE_CONNECTION</code> <code
                                        class="language-php">SESSION_DRIVER</code>. Вони повинні мати значення <code class="language-php">redis</code></p>

                            <h4 class="h6" id="godesk-install"><a href="#godesk-install" aria-hidden="true" class="header-anchor">#</a> Процес установки</h4>
                            <p>Завантажте один з <code class="language-php">GoDesk Релізів</code> і розпакуйте його в кореневий шлях в папці <code class="language-php">godesk</code>.</p>
                            <p>Додайте <code class="language-php">laravel/nova</code> і <code class="language-php">spacecode/godesk</code> до require секції вашого <code class="language-php">composer.json</code>
                                файлу:</p>
                            <pre class="language-json">
                                <code>"require": {
    ...
    "laravel/nova": "*",
    "spacecode/godesk": "*"
},</code>
                            </pre>
                            <p>Додайте <code class="language-php">repositories</code> як окремий розділ в <code class="language-php">composer.json</code> файлу:</p>
                            <pre class="language-json">
                                <code>"repositories": [
    {
        "type": "artifact",
        "url": "./godesk/resources/dependencies/"
    },
    {
        "type": "path",
        "url": "./godesk"
    }
]</code>
                            </pre>
                            <p>Після того як <code class="language-php">composer.json</code> файл був відредагований, запустіть команду <code class="language-php">composer update</code> в вашому консольному терміналі:
                            </p>
                            <p>Нарешті, запустіть <code class="language-php">godesk:install</code> Artisan команду. <code class="language-php">godesk:install</code> команда встановить постачальника послуг GoDesk і
                                загальнодоступні активи програми:</p>
                            <pre class="language-bash">
                                <code>php artisan godesk:install</code>
                            </pre>
                            <h4 class="h6" id="godesk-update"><a href="#godesk-update" aria-hidden="true" class="header-anchor">#</a> Оновлення активів GoDesk</h4>
                            <p>Щоб ресурси GoDesk оновлювалися при завантаженні нової версії, ви можете додати hook в файлі <code class="language-php">composer.json</code>, який буде публікувати GoDesk поновлення:</p>
                            <pre class="language-json">
                                <code>"scripts": {
    "post-update-cmd": [
        {!! '"@php artisan godesk:publish"' !!}
    ]
}</code>
                            </pre>
                        </div>
                    </div>
                </main>
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