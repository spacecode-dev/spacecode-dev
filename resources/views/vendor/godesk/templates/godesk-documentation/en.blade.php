@include('godesk::index.inc.slot')
@extends('godesk::index.index')
@section('content')
    <div class="main section">
        <div class="container-fluid">
            <div class="row min-vh-100 flex-row">
                @include('godesk-index::add.sidebar', ['entity' => $entity])
                <main>
                    <h1 class="h2" id="installation"><a href="#installation" aria-hidden="true" class="header-anchor">#</a> Installation</h1>
                    <ul>
                        <li><a href="#requirements">Requirements</a></li>
                        <li><a href="#browser-support">Browser Support</a></li>
                        <li>
                            <a href="#installing">Installing</a>
                            <ul>
                                <li>
                                    <a href="#installing-laravel">Installing Laravel</a>
                                    <ul>
                                        <li><a href="#public-directory">Public Directory</a></li>
                                        <li><a href="#configuration-files">Configuration Files</a></li>
                                        <li><a href="#database-config">Database Config</a></li>
                                        <li><a href="#directory-permissions">Directory Permissions</a></li>
                                        <li><a href="#application-key">Application Key</a></li>
                                        <li><a href="#additional-configuration">Additional Configuration</a></li>
                                        <li><a href="#directory-configuration">Directory Configuration</a></li>
                                        <li><a href="#pretty-urls-apache">Pretty URLs in Apache</a></li>
                                        <li><a href="#pretty-urls-nginx">Pretty URLs in Nginx</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#installing-godesk">Installing GoDesk</a>
                                    <ul>
                                        <li><a href="#godesk-database-config">Database Config</a></li>
                                        <li><a href="#godesk-database-env">Database Environments</a></li>
                                        <li><a href="#godesk-redis">Redis Required</a></li>
                                        <li><a href="#godesk-install">Installing Process</a></li>
                                        <li><a href="#godesk-update">Keeping Assets Up-to-date</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="content m-0">
                        <h2 class="h3" id="requirements"><a href="#requirements" aria-hidden="true" class="header-anchor">#</a> Requirements</h2>
                        <p>CMS GoDesk has a few requirements you should be aware of before installing:</p>
                        <ul>
                            <li>PHP >= 7.2.5</li>
                            <li>Redis >= 3.0</li>
                            <li>Composer</li>
                            <li>Laravel Mix</li>
                            <li>Node.js &amp; NPM</li>
                            <li>Laravel Framework 7.*</li>
                            <li><em>exif</em>, <em>zip</em>, <em>bcmath</em>, <em>curl</em>, <em>phpiredis</em>, <em>ctype</em>, <em>fileinfo</em>, <em>json</em>, <em>mbstring</em>, <em>openssl</em>, <em>pdo</em>, <em>tokenizer</em>,
                                <em>xml</em>, PHP Extensions
                            </li>
                        </ul>
                    </div>
                    <div class="content">
                        <h2 class="h3" id="browser-support"><a href="#browser-support" aria-hidden="true" class="header-anchor">#</a> Browser Support</h2>
                        <p>GoDesk supports reasonably recent versions of the following browsers:</p>
                        <ul>
                            <li>Google Chrome</li>
                            <li>Apple Safari</li>
                            <li>Microsoft Edge</li>
                            <li>Mozilla Firefox</li>
                        </ul>
                    </div>
                    <div class="content">
                        <h2 class="h3" id="installing"><a href="#installing" aria-hidden="true" class="header-anchor">#</a> Installing</h2>
                        <p>CMS GoDesk depends on Laravel and utilizes <a href="https://getcomposer.org/" target="_blank" rel="nofollow">Composer</a> to manage its dependencies. So, before using GoDesk, make sure you have
                            Composer installed on your machine.</p>
                        <div class="content">

                            <h3 class="h5" id="installing-laravel"><a href="#installing-laravel" aria-hidden="true" class="header-anchor">#</a> Installing Laravel</h3>
                            <p>You can visit the official <a href="https://laravel.com/docs/7.x/installation" target="_blank" rel="nofollow">Laravel</a> website or follow our instructions.</p>
                            <p>First, download Laravel installer using Composer:</p>
                            <pre class="language-bash">
                                <code>composer global require laravel/installer</code>
                            </pre>
                            <p>Install Laravel by issuing the Composer <code class="language-php">create-project</code> command in your terminal:</p>
                            <pre class="language-bash">
                                <code>composer create-project --prefer-dist laravel/laravel:^7.0 blog</code>
                            </pre>
                            <p>You can specify any path instead of a <code class="language-php">blog</code>, and then move your application to the root folder.</p>

                            <h4 class="h6" id="public-directory"><a href="#public-directory" aria-hidden="true" class="header-anchor">#</a> Public Directory</h4>
                            <p>After installing Laravel, you should configure your web server's document / web root to be the <code class="language-php">public</code> directory. The <code
                                        class="language-php">index.php</code> in this directory serves as the front controller for all HTTP requests entering your application.</p>

                            <h4 class="h6" id="configuration-files"><a href="#configuration-files" aria-hidden="true" class="header-anchor">#</a> Configuration Files</h4>
                            <p>All of the configuration files for the Laravel framework are stored in the <code class="language-php">config</code> directory. Each option is documented, so feel free to look through the
                                files and get familiar with the options available to you.</p>

                            <h4 class="h6" id="database-config"><a href="#database-config" aria-hidden="true" class="header-anchor">#</a> Database Config</h4>
                            <p>If you use MySQL in any version (MySQL, MariaDB, etc.), make sure you know your encodings. Change your <code class="language-php">charset</code> and <code
                                        class="language-php">collation</code> in <code class="language-php">config/database.php</code> to correct.</p>

                            <h4 class="h6" id="directory-permissions"><a href="#directory-permissions" aria-hidden="true" class="header-anchor">#</a> Directory Permissions</h4>
                            <p>After installing Laravel, you may need to configure some permissions. Directories within the <code class="language-php">storage</code> and the <code
                                        class="language-php">bootstrap/cache</code> directories should be writable by your web server or Laravel will not run. If you are using the Homestead virtual machine, these
                                permissions should already be set.</p>

                            <h4 class="h6" id="application-key"><a href="#application-key" aria-hidden="true" class="header-anchor">#</a> Application Key</h4>
                            <p>The next thing you should do after installing Laravel is set your application key to a random string. If you installed Laravel via Composer or the Laravel installer, this key has already
                                been set for you by the <code class="language-php">php artisan key:generate</code> command.</p>
                            <p>Typically, this string should be 32 characters long. The key can be set in the <code class="language-php">.env</code> environment file. If you have not renamed the <code
                                        class="language-php">.env.example</code> file to <code class="language-php">.env</code>, you should do that now. <strong>If the application key is not set, your user sessions and
                                    other encrypted data will not be secure!</strong></p>

                            <h4 class="h6" id="additional-configuration"><a href="#additional-configuration" aria-hidden="true" class="header-anchor">#</a> Additional Configuration</h4>
                            <p>Laravel needs almost no other configuration out of the box. You are free to get started developing! However, you may wish to review the <code class="language-php">config/app.php</code> file
                                and its documentation. It
                                contains several options such as <code class="language-php">timezone</code> and <code class="language-php">locale</code> that you may wish to change according to your application.</p>
                            <p>You may also want to configure a few additional components of Laravel, such as:</p>
                            <ul>
                                <li><a href="https://laravel.com/docs/7.x/cache#configuration" target="_blank" rel="nofollow">Cache</a></li>
                                <li><a href="https://laravel.com/docs/7.x/database#configuration" target="_blank" rel="nofollow">Database</a></li>
                                <li><a href="https://laravel.com/docs/7.x/session#configuration" target="_blank" rel="nofollow">Session</a></li>
                            </ul>

                            <h4 class="h6" id="directory-configuration"><a href="#directory-configuration" aria-hidden="true" class="header-anchor">#</a> Directory Configuration</h4>
                            <p>Laravel should always be served out of the root of the "web directory" configured for your web server. You should not attempt to serve a Laravel application out of a subdirectory of the
                                "web directory". Attempting to do so could expose sensitive files present within your application.</p>

                            <h4 class="h6" id="pretty-urls-apache"><a href="#pretty-urls-apache" aria-hidden="true" class="header-anchor">#</a> Pretty URLs in Apache</h4>
                            <p>Laravel includes a <code class="language-php">public/.htaccess</code> file that is used to provide URLs without the <code class="language-php">index.php</code> front controller in the path.
                                Before serving Laravel with Apache, be sure to enable the <code class="language-php">mod_rewrite</code> module so the <code class="language-php">.htaccess</code> file will be honored by
                                the server.</p>
                            <p>If the <code class="language-php">.htaccess</code> file that ships with Laravel does not work with your Apache installation, try this alternative:</p>
                            <pre class="language-other">
                                <code>Options +FollowSymLinks -Indexes
RewriteEngine On

RewriteCond %{HTTP:Authorization} .
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]</code>
                            </pre>

                            <h4 class="h6" id="pretty-urls-nginx"><a href="#pretty-urls-nginx" aria-hidden="true" class="header-anchor">#</a> Pretty URLs in Nginx</h4>
                            <p>If you are using Nginx, the following directive in your site configuration will direct all requests to the <code class="language-php">index.php</code> front controller:</p>
                            <pre class="language-other">
                                <code>location / {
    try_files $uri $uri/ /index.php?$query_string;
}</code>
                            </pre>
                        </div>
                        <div class="content">

                            <h3 class="h5" id="installing-godesk"><a href="#installing-godesk" aria-hidden="true" class="header-anchor">#</a> Installing CMS GoDesk</h3>
                            <div class="alert alert-danger">
                                <h6 class="p-0 mt-0">Forbidden</h6>
                                <p class="m-0">It’s not necessary to change anything other than the specified one, this may affect the system.</p>
                            </div>
                            <div class="alert alert-primary">
                                <h6 class="p-0 mt-0">Required</h6>
                                <p class="m-0">Initially, you need to be registered on <a href="https://spacecode.dev">spacecode.dev</a> and need to had the License to download files with CMS GoDesk.</p>
                            </div>
                            <h4 class="h6" id="godesk-database-config"><a href="#godesk-database-config" aria-hidden="true" class="header-anchor">#</a> Database Config</h4>
                            <p>Verify that your <a href="#database-config">database configurations</a> in <code class="language-php">config/database.php</code> are correct.</p>

                            <h4 class="h6" id="godesk-database-env"><a href="#godesk-database-env" aria-hidden="true" class="header-anchor">#</a> Database Environments</h4>
                            <p>Check your database environments in <code class="language-php">.env</code>: <code class="language-php">DB_CONNECTION</code> <code class="language-php">DB_HOST</code> <code
                                        class="language-php">DB_PORT</code> <code class="language-php">DB_DATABASE</code> <code class="language-php">DB_USERNAME</code> <code class="language-php">DB_PASSWORD</code></p>

                            <h4 class="h6" id="godesk-redis"><a href="#godesk-redis" aria-hidden="true" class="header-anchor">#</a> Redis Required</h4>
                            <p>Check your environments in <code class="language-php">.env</code>: <code class="language-php">CACHE_DRIVER</code> <code class="language-php">QUEUE_CONNECTION</code> <code
                                        class="language-php">SESSION_DRIVER</code>. They need to be <code class="language-php">redis</code></p>

                            <h4 class="h6" id="godesk-install"><a href="#godesk-install" aria-hidden="true" class="header-anchor">#</a> Installing Process</h4>
                            <p>Download one of the <code class="language-php">GoDesk Release</code> and unpack it to the root path in <code class="language-php">godesk</code> folder.</p>
                            <p>Add <code class="language-php">laravel/nova</code> and <code class="language-php">spacecode/godesk</code> to the require section of your <code class="language-php">composer.json</code> file:</p>
                            <pre class="language-json">
                                <code>"require": {
    ...
    "laravel/nova": "*",
    "spacecode/godesk": "*"
},</code>
                            </pre>
                            <p>Add <code class="language-php">repositories</code> as a separate section of your <code class="language-php">composer.json</code> file:</p>
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
                            <p>After your <code class="language-php">composer.json</code> file has been updated, run the <code class="language-php">composer update</code> command in your console terminal:</p>
                            <p>Finally, run the <code class="language-php">godesk:install</code> Artisan commands. The <code class="language-php">godesk:install</code> command will install GoDesk's service provider and
                                public assets within your application:</p>
                            <pre class="language-bash">
                                <code>php artisan godesk:install</code>
                            </pre>
                            <h4 class="h6" id="godesk-update"><a href="#godesk-update" aria-hidden="true" class="header-anchor">#</a> Keeping GoDesk's Assets Up-to-date</h4>
                            <p>To ensure GoDesk's assets are updated when a new version is downloaded, you may add a Composer hook inside your project's <code class="language-php">composer.json</code> file to
                                automatically publish GoDesk's latest assets:</p>
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