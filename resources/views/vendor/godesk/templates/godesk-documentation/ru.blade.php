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
                        <li><a href="#requirements">Системные требования</a></li>
                        <li><a href="#browser-support">Поддержка браузеров</a></li>
                        <li>
                            <a href="#installing">Установка</a>
                            <ul>
                                <li>
                                    <a href="#installing-laravel">Установка Laravel</a>
                                    <ul>
                                        <li><a href="#public-directory">Публичный каталог</a></li>
                                        <li><a href="#configuration-files">Файлы конфигурации</a></li>
                                        <li><a href="#database-config">Конфигурация базы данных</a></li>
                                        <li><a href="#directory-permissions">Разрешения каталога</a></li>
                                        <li><a href="#application-key">Ключ приложения</a></li>
                                        <li><a href="#additional-configuration">Дополнительная конфигурация</a></li>
                                        <li><a href="#directory-configuration">Конфигурация каталога</a></li>
                                        <li><a href="#pretty-urls-apache">Красивые URL-адреса в Apache</a></li>
                                        <li><a href="#pretty-urls-nginx">Красивые URL-адреса в Nginx</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#installing-godesk">Установка GoDesk</a>
                                    <ul>
                                        <li><a href="#godesk-database-config">Конфигурация базы данных</a></li>
                                        <li><a href="#godesk-database-env">Среды баз данных</a></li>
                                        <li><a href="#godesk-redis">Требуется Redis</a></li>
                                        <li><a href="#godesk-install">Процесс установки</a></li>
                                        <li><a href="#godesk-update">Поддержание активов в актуальном состоянии</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="content m-0">
                        <h2 class="h3" id="requirements"><a href="#requirements" aria-hidden="true" class="header-anchor">#</a> Системные требования</h2>
                        <p>CMS GoDesk имеет несколько требований, о которых следует знать перед установкой:</p>
                        <ul>
                            <li>PHP >= 7.2.5</li>
                            <li>Redis >= 3.0</li>
                            <li>Composer</li>
                            <li>Laravel Mix</li>
                            <li>Node.js &amp; NPM</li>
                            <li>Laravel Framework 7.*</li>
                            <li><em>exif</em>, <em>zip</em>, <em>bcmath</em>, <em>curl</em>, <em>phpiredis</em>, <em>ctype</em>, <em>fileinfo</em>, <em>json</em>, <em>mbstring</em>, <em>openssl</em>, <em>pdo</em>, <em>tokenizer</em>,
                                <em>xml</em>, PHP Расширения
                            </li>
                        </ul>
                    </div>
                    <div class="content">
                        <h2 class="h3" id="browser-support"><a href="#browser-support" aria-hidden="true" class="header-anchor">#</a> Поддержка браузеров</h2>
                        <p>GoDesk поддерживает достаточно свежие версии следующих браузеров:</p>
                        <ul>
                            <li>Google Chrome</li>
                            <li>Apple Safari</li>
                            <li>Microsoft Edge</li>
                            <li>Mozilla Firefox</li>
                        </ul>
                    </div>
                    <div class="content">
                        <h2 class="h3" id="installing"><a href="#installing" aria-hidden="true" class="header-anchor">#</a> Установка</h2>
                        <p>CMS GoDesk зависит от Laravel и использует <a href="https://getcomposer.org/" target="_blank" rel="nofollow">Composer</a> для управления своими зависимостями. Итак, перед использованием GoDesk
                            убедитесь, что у вас установлен Composer.</p>
                        <div class="content">

                            <h3 class="h5" id="installing-laravel"><a href="#installing-laravel" aria-hidden="true" class="header-anchor">#</a> Установка Laravel</h3>
                            <p>Вы можете посетить официальный веб-сайт <a href="https://laravel.com/docs/7.x/installation" target="_blank" rel="nofollow">Laravel</a> или следовать нашим инструкциям.</p>
                            <p>Сначала загрузите установщик Laravel с помощью Composer:</p>
                            <pre class="language-bash">
                                <code>composer global require laravel/installer</code>
                            </pre>
                            <p>Установите Laravel, введя команду Composer <code class="language-php">create-project</code> в своем терминале:</p>
                            <pre class="language-bash">
                                <code>composer create-project --prefer-dist laravel/laravel:^7.0 blog</code>
                            </pre>
                            <p>Вы можете указать любой путь вместо <code class="language-php">blog</code>, а затем переместить приложение в корневую папку.</p>

                            <h4 class="h6" id="public-directory"><a href="#public-directory" aria-hidden="true" class="header-anchor">#</a> Публичный каталог</h4>
                            <p>После установки Laravel вы должны сконфигурировать документ/корневой каталог веб-сервера на <code class="language-php">public</code> директорию. <code
                                        class="language-php">index.php</code> в этом каталоге служит фронт-контроллером для всех HTTP-запросов, поступающих в ваше приложение.</p>

                            <h4 class="h6" id="configuration-files"><a href="#configuration-files" aria-hidden="true" class="header-anchor">#</a> Файлы конфигурации</h4>
                            <p>Все файлы конфигурации для Laravel хранятся в каталоге <code class="language-php">config</code>. Каждый вариант задокументирован, поэтому не стесняйтесь просматривать
                                файлы и ознакомьтесь с доступными вариантами.</p>

                            <h4 class="h6" id="database-config"><a href="#database-config" aria-hidden="true" class="header-anchor">#</a> Конфигурация базы данных</h4>
                            <p>Если вы используете MySQL любой версии (MySQL, MariaDB, т.д.), убедитесь, что вы знаете свои кодировки. Измените кодировку <code class="language-php">charset</code> и <code
                                        class="language-php">collation</code> в <code class="language-php">config/database.php</code> на необходимую.</p>

                            <h4 class="h6" id="directory-permissions"><a href="#directory-permissions" aria-hidden="true" class="header-anchor">#</a> Разрешения каталога</h4>
                            <p>После установки Laravel вам может потребоваться настроить некоторые разрешения. Каталоги в <code class="language-php">storage</code> и в <code class="language-php">bootstrap/cache</code>
                                должны быть доступны для записи вашим веб-сервером, иначе Laravel не запустится. Если вы используете виртуальную машину Homestead, эти разрешения уже должны быть установлены.</p>

                            <h4 class="h6" id="application-key"><a href="#application-key" aria-hidden="true" class="header-anchor">#</a> Ключ приложения</h4>
                            <p>Следующее, что вам нужно сделать после установки Laravel - это ключ приложения. Если вы установили Laravel через Composer или установщик Laravel, этот ключ уже
                                был задан для вас с помощью команды <code class="language-php">php artisan key:generate</code>.</p>
                            <p>Обычно эта строка должна состоять из 32 символов. Ключ можно задать в файле среды <code class="language-php">.env</code>. Если вы не переименовали <code
                                        class="language-php">.env.example</code> файл на <code class="language-php">.env</code>, вы должны сделать это сейчас. <strong>Если ключ приложения не установлен, ваши
                                    пользовательские сеансы и другие зашифрованные данные не будут в безопасности!</strong></p>

                            <h4 class="h6" id="additional-configuration"><a href="#additional-configuration" aria-hidden="true" class="header-anchor">#</a> Дополнительная конфигурация</h4>
                            <p>Laravel почти не нуждается в другой конфигурации. Вы можете начать разработку! Однако вы можете просмотреть файл <code class="language-php">config/app.php</code> и его документацию. Он
                                содержит несколько параметров, таких как <code class="language-php">часовой пояс</code> и <code class="language-php">регион</code>, которые вы можете изменить в соответствии с вашим
                                приложением.</p>
                            <p>Вы также можете настроить несколько дополнительных компонентов Laravel, например:</p>
                            <ul>
                                <li><a href="https://laravel.com/docs/7.x/cache#configuration" target="_blank" rel="nofollow">Кеш</a></li>
                                <li><a href="https://laravel.com/docs/7.x/database#configuration" target="_blank" rel="nofollow">База данных</a></li>
                                <li><a href="https://laravel.com/docs/7.x/session#configuration" target="_blank" rel="nofollow">Сессия</a></li>
                            </ul>

                            <h4 class="h6" id="directory-configuration"><a href="#directory-configuration" aria-hidden="true" class="header-anchor">#</a> Конфигурация каталога</h4>
                            <p>Laravel всегда должен обслуживаться из корня "веб-каталога", настроенного для вашего веб-сервера. Вы не должны пытаться обслуживать приложение Laravel из подкаталога. Попытка сделать это
                                может открыть доступ к конфиденциальным файлам, присутствующим в вашем приложении.</p>

                            <h4 class="h6" id="pretty-urls-apache"><a href="#pretty-urls-apache" aria-hidden="true" class="header-anchor">#</a> Красивые URL-адреса в Apache</h4>
                            <p>Laravel включает файл <code class="language-php">public/.htaccess</code>, который используется для предоставления URL-адресов без фронт-контроллера <code
                                        class="language-php">index.php</code>.
                                Перед обслуживанием Laravel с Apache обязательно включите модуль <code class="language-php">mod_rewrite</code>, чтобы файл <code class="language-php">.htaccess</code> был обработан
                                сервером.</p>
                            <p>Если файл <code class="language-php">.htaccess</code> поставляемый с Laravel, не работает с вашей установкой Apache, попробуйте следующий вариант:</p>
                            <pre class="language-other">
                                <code>Options +FollowSymLinks -Indexes
RewriteEngine On

RewriteCond %{HTTP:Authorization} .
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]</code>
                            </pre>

                            <h4 class="h6" id="pretty-urls-nginx"><a href="#pretty-urls-nginx" aria-hidden="true" class="header-anchor">#</a> Красивые URL-адреса в Nginx</h4>
                            <p>Если вы используете Nginx, следующая директива в конфигурации вашего сайта будет направлять все запросы на фронт-контроллер <code class="language-php">index.php</code>:</p>
                            <pre class="language-other">
                                <code>location / {
    try_files $uri $uri/ /index.php?$query_string;
}</code>
                            </pre>
                        </div>
                        <div class="content">

                            <h3 class="h5" id="installing-godesk"><a href="#installing-godesk" aria-hidden="true" class="header-anchor">#</a> Установка CMS GoDesk</h3>
                            <div class="alert alert-danger">
                                <h6 class="p-0 mt-0">Запрещено</h6>
                                <p class="m-0">Ничего другого, кроме указанного, менять не нужно, это может повлиять на систему.</p>
                            </div>
                            <div class="alert alert-primary">
                                <h6 class="p-0 mt-0">Необходимо</h6>
                                <p class="m-0">Изначально вам необходимо зарегистрироваться на <a href="https://spacecode.dev">spacecode.dev</a> и иметь лицензию на загрузку файлов с CMS GoDesk.</p>
                            </div>
                            <h4 class="h6" id="godesk-database-config"><a href="#godesk-database-config" aria-hidden="true" class="header-anchor">#</a> Конфигурация базы данных</h4>
                            <p>Убедитесь, что ваши <a href="#database-config">конфигурации базы данных</a> в <code class="language-php">config/database.php</code> правильные.</p>

                            <h4 class="h6" id="godesk-database-env"><a href="#godesk-database-env" aria-hidden="true" class="header-anchor">#</a> Среды баз данных</h4>
                            <p>Проверьте среду своей базы данных в <code class="language-php">.env</code>: <code class="language-php">DB_CONNECTION</code> <code class="language-php">DB_HOST</code> <code
                                        class="language-php">DB_PORT</code> <code class="language-php">DB_DATABASE</code> <code class="language-php">DB_USERNAME</code> <code class="language-php">DB_PASSWORD</code></p>

                            <h4 class="h6" id="godesk-redis"><a href="#godesk-redis" aria-hidden="true" class="header-anchor">#</a> Требуется Redis</h4>
                            <p>Проверьте свое окружение в <code class="language-php">.env</code>: <code class="language-php">CACHE_DRIVER</code> <code class="language-php">QUEUE_CONNECTION</code> <code
                                        class="language-php">SESSION_DRIVER</code>. Они должны иметь значение <code class="language-php">redis</code></p>

                            <h4 class="h6" id="godesk-install"><a href="#godesk-install" aria-hidden="true" class="header-anchor">#</a> Процесс установки</h4>
                            <p>Загрузите один из <code class="language-php">GoDesk Релизов</code> и распакуйте его в корневой путь в папке <code class="language-php">godesk</code>.</p>
                            <p>Добавьте <code class="language-php">laravel/nova</code> и <code class="language-php">spacecode/godesk</code> в require секции вашего <code class="language-php">composer.json</code>
                                файла:</p>
                            <pre class="language-json">
                                <code>"require": {
    ...
    "laravel/nova": "*",
    "spacecode/godesk": "*"
},</code>
                            </pre>
                            <p>Добавьте <code class="language-php">repositories</code> как отдельный раздел в <code class="language-php">composer.json</code> файла:</p>
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
                            <p>После того, как <code class="language-php">composer.json</code> файл был отредактирован, запустите команду <code class="language-php">composer update</code> в вашем консольном терминале:
                            </p>
                            <p>Наконец, запустите <code class="language-php">godesk:install</code> Artisan команду. <code class="language-php">godesk:install</code> команда установит поставщика услуг GoDesk и
                                общедоступные активы приложения:</p>
                            <pre class="language-bash">
                                <code>php artisan godesk:install</code>
                            </pre>
                            <h4 class="h6" id="godesk-update"><a href="#godesk-update" aria-hidden="true" class="header-anchor">#</a> Обновление активов GoDesk</h4>
                            <p>Чтобы ресурсы GoDesk обновлялись при загрузке новой версии, вы можете добавить hook в файле <code class="language-php">composer.json</code>, который будет публиковать GoDesk обновления:</p>
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