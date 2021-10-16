<aside>
    <nav class="navbar navbar-expand navbar-dark flex-column align-items-start py-2">
        <div class="collapse navbar-collapse">
            <ul class="flex-column navbar-nav w-100 justify-content-between">
                @if($entity->locale === 'en')
                    <li class="nav-item active"><a class="nav-link pl-0 text-nowrap" href="#installing"><span class="font-weight-bold">Installing</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#installing-laravel"><span class="font-weight-bold">Installing Laravel</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#public-directory"><span>Public Directory</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#configuration-files"><span>Configuration Files</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#database-config"><span>Database Config</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#directory-permissions"><span>Directory Permissions</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#application-key"><span>Application Key</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#additional-configuration"><span>Additional Configuration</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#directory-configuration"><span>Directory Configuration</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#pretty-urls-apache"><span>Pretty URLs in Apache</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#pretty-urls-nginx"><span>Pretty URLs in Nginx</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#installing-godesk"><span class="font-weight-bold">Installing GoDesk</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#godesk-database-config"><span>Database Config</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#godesk-database-env"><span>Database Environments</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#godesk-redis"><span>Redis Required</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#godesk-install"><span>Installing Process</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#godesk-update"><span>Keeping Assets Up-to-date</span></a></li>
                @elseif ($entity->locale === 'ru')
                    <li class="nav-item active"><a class="nav-link pl-0 text-nowrap" href="#installing"><span class="font-weight-bold">Установка</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#installing-laravel"><span class="font-weight-bold">Установка Laravel</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#public-directory"><span>Публичный каталог</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#configuration-files"><span>Файлы конфигурации</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#database-config"><span>Конфигурация базы данных</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#directory-permissions"><span>Разрешения каталога</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#application-key"><span>Ключ приложения</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#additional-configuration"><span>Доп конфигурация</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#directory-configuration"><span>Конфигурация каталога</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#pretty-urls-apache"><span>Красивые адреса в Apache</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#pretty-urls-nginx"><span>Красивые адреса в Nginx</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#installing-godesk"><span class="font-weight-bold">Установка GoDesk</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#godesk-database-config"><span>Конфигурация базы данных</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#godesk-database-env"><span>Среды баз данных</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#godesk-redis"><span>Требуется Redis</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#godesk-install"><span>Процесс установки</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#godesk-update"><span>Поддержание активов</span></a></li>
                @elseif ($entity->locale === 'uk')
                    <li class="nav-item active"><a class="nav-link pl-0 text-nowrap" href="#installing"><span class="font-weight-bold">Установка</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#installing-laravel"><span class="font-weight-bold">Установка Laravel</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#public-directory"><span>Публічний каталог</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#configuration-files"><span>Файли конфігурації</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#database-config"><span>Конфігурація бази даних</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#directory-permissions"><span>Дозволи каталогу</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#application-key"><span>Ключ додатку</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#additional-configuration"><span>Дод конфігурація</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#directory-configuration"><span>Конфігурація каталогу</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#pretty-urls-apache"><span>Красива адреса в Apache</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#pretty-urls-nginx"><span>Красива адреса в Nginx</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#installing-godesk"><span class="font-weight-bold">Установка GoDesk</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#godesk-database-config"><span>Конфігурація бази даних</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#godesk-database-env"><span>Середовища баз даних</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#godesk-redis"><span>Потрібен Redis</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#godesk-install"><span>Процес установки</span></a></li>
                    <li class="nav-item"><a class="nav-link pl-0 text-nowrap" href="#godesk-update"><span>Підтримка активів</span></a></li>
                @endif
            </ul>
        </div>
    </nav>
    <svg class="arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
        <polygon points="79.093,0 48.907,30.187 146.72,128 48.907,225.813 79.093,256 207.093,128"></polygon>
    </svg>
</aside>